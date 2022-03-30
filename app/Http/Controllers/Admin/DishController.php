<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Category;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    protected $validationRule = [
        "name" => "required|string|max:100",
        "description" => "required",
        "price"=> "numeric|min:0|max:999",
        "visible" => "sometimes|accepted",
        "category_id" => "nullable|exists:categories,id",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();

        return view("admin.dishes.index", compact("dishes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view("admin.dishes.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazione dei dati
        $request->validate($this->validationRule);
        $request->validate([
            "image" => "required|image|mimes:jpeg,bmp,png|max:2048",
        ]);

        $piatto = $request->all();

        $newPiatto = new Dish();
        $newPiatto->restaurant_id = $piatto['restaurant_id'];
        $newPiatto->category_id = $piatto['category_id'];
        $newPiatto->name = $piatto['name'];
        $newPiatto->description = $piatto['description'];
        $newPiatto->price = $piatto['price'];
        $newPiatto->visible = isset($piatto["visible"]);
        $path_image = Storage::put("uploads", $piatto['image']); // uploads
        $newPiatto->image = $path_image;
        $newPiatto->save();

        //redirect al piatto
        return redirect()->route("dishes.show", $newPiatto->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view("admin.dishes.show", compact("dish"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $categories = Category::all();

        return view("admin.dishes.edit", compact("dish", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        // validazione dei dati
        $request->validate($this->validationRule);
        $request->validate([
            "image" => "nullable|image|mimes:jpeg,bmp,png|max:2048",
        ]);

        $piatto = $request->all();

        $dish->restaurant_id = $piatto['restaurant_id'];
        $dish->category_id = $piatto['category_id'];
        $dish->name = $piatto['name'];
        $dish->description = $piatto['description'];
        $dish->price = $piatto['price'];
        $dish->visible = isset($piatto["visible"]);
        if(isset($data['image'])){
            Storage::delete($dish->image);
            $path_image = Storage::put("uploads", $piatto['image']); // uploads
            $dish->image = $path_image;
        }
        $dish->save();

        //redirect al piatto
        return redirect()->route("dishes.show", $dish->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        if($dish->image) {
            // cancello l'immagine
            Storage::delete($dish->image);
        }
        
        $dish->delete();

        return redirect()->route("dishes.index");
    }
}
