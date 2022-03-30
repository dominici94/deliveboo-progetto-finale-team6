<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::with(['dishes'])->get();
        $ordine = array();
        foreach($orders as $order){
            if($order->dishes[0]->restaurant_id == $id) {
                array_push($ordine, $order);
            }
        }
        $date = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($ordine as $single_order){
            switch (date_format($single_order->created_at, 'm/y')){
                case "01/22":
                    $date[0] += 1;
                    break;
                case "02/22":
                    $date[1] += 1;
                    break;
                case "03/22":
                    $date[2] += 1;
                    break;
                case "04/22":
                    $date[3] += 1;
                    break;
                case "05/22":
                    $date[4] += 1;
                    break;
                case "06/22":
                    $date[5] += 1;
                    break;
                case "07/22":
                    $date[6] += 1;
                    break;
                case "08/22":
                    $date[7] += 1;
                    break;
                case "09/22":
                    $date[8] += 1;
                    break;
                case "10/22":
                    $date[9] += 1;
                    break;
                case "11/22":
                    $date[10] += 1;
                    break;
                case "12/22":
                    $date[11] += 1;
                    break;
            }
        }

        return view("admin.statistics.index", compact('date', 'id'));
    }
}
