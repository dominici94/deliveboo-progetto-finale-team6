<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Braintree;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderMail;
use App\Mail\CheckoutMail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function getToken(){
        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'jngyvjsyfbg53g7w',
            'publicKey' => 'khfzckqj3679mcpt',
            'privateKey' => 'd67e264174210f40d39f6fc43039c9fd'
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return response()->json($clientToken);

    }

    public function checkout(Request $request) {
        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'jngyvjsyfbg53g7w',
            'publicKey' => 'khfzckqj3679mcpt',
            'privateKey' => 'd67e264174210f40d39f6fc43039c9fd'
        ]);
    
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $request->totalPrice,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $request->name,
                'lastName' => $request->surname,
                'email' => $request->email,
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // DATABASE
        $newOrder = new Order();
        $newOrder->price = $request->totalPrice;
        $newOrder->name = $request->name;
        $newOrder->surname = $request->surname;
        $newOrder->address = $request->address;
        $newOrder->email = $request->email;
        $newOrder->telephone = $request->telephone;
        $newOrder->notes = $request->notes;
        if ($result->success){
            $newOrder->is_paid = true;
        }

        // $newRestaurant->typologies()->attach($data['typologies']);

        $newOrder->save();
        $orderid = $newOrder->id;

        for($i = 0; $i < count($request->dishId); $i++){
            $dishid = $request->dishId[$i];
            $dishqt = $request->dishQt[$i];
            DB::insert('insert into dish_order (id, dish_id, order_id, quantity, created_at, updated_at) values (NULL, ?, ?, ?, NULL, NULL)', [$dishid, $orderid, $dishqt]);
        }

        Mail::to("ristorante@gmail.com")->send(new OrderMail($newOrder->id));
        Mail::to("cliente@gmail.com")->send(new CheckoutMail($newOrder->id));

        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
    
            // return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
            return response()->json($transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            // return back()->withErrors('An error occurred with the message: '.$result->message);
            return response()->json($result->message);
        }
    }
}
