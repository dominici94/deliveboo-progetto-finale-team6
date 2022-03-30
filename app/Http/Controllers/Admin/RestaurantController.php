<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Typology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return view("admin.home", compact("restaurants"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typologies = Typology::all();
        
        return view("admin.restaurants.create", compact("typologies"));
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
        $request->validate([
            "name" => "required|string|max:100",
            "description" => "required",
            "address" => "required|string|max:150",
            "vat" => "required|numeric|digits:11",
            "telephone" => "required|numeric|digits:10",
            "typologies" => "required|exists:typologies,id",
            "image" => "nullable|mimes:jpg,png,bmp|max:2048"
        ]);

        $data = $request->all();
        // dd($data);
        $newRestaurant = new Restaurant();
        $newRestaurant->name = $data['name'];
        $newRestaurant->description = $data['description'];
        $newRestaurant->address = $data['address'];
        $newRestaurant->vat = $data['vat'];
        $newRestaurant->telephone = $data['telephone'];
        $newRestaurant->user_id = $data['user_id'];

        // Aggiunta slug
        $slug = Str::of($newRestaurant->name)->slug('-');
        $var = 1;
        while( Restaurant::where("slug", $slug)->first()){
            $slug = Str::of($newRestaurant->name)->slug('-')."-{$var}";
            $var++;
        }
        $newRestaurant->slug = $slug;

        // Aggiunta foto
        $path = Storage::put("uploads", $data['image']);
        $newRestaurant->image = $path;

        $newRestaurant->save();

        // Aggiunta categorie
        $newRestaurant->typologies()->attach($data['typologies']);

       
        return view("admin.home");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if($restaurant->image) {
            // cancello l'immagine
            Storage::delete($restaurant->image);
        }
        
        $restaurant->delete();
    }
}
