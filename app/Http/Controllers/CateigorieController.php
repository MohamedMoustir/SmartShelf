<?php

namespace App\Http\Controllers;

use App\Models\Cateigorie;
use Illuminate\Http\Request;

class CateigorieController extends Controller
{
    
    public function Cateigorie(request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $Cateigorie = Cateigorie::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        
        return [
            "message" => "Rayons créés avec succès!",
            'Cateigorie' => $Cateigorie
        ];
    }
    public function showCateigorie()
    {
        $Cateigorie = Cateigorie::all();
        return [
            "all Cateigorie" => $Cateigorie,
        ];
    }
    public function deleteCateigorie($id)
    {
        $Cateigorie = Cateigorie::find($id);
        $Cateigorie->delete();
        return [
           'message' => 'Cateigorie deleted successfully'
        ];
    }
    public function updateCateigorie(request $request,$id)
    {
        $Cateigorie = Cateigorie::find($id);
        $Cateigorie->name = $request->name;
        $Cateigorie->description = $request->description;
        $Cateigorie->save();
        return [
            'message' => 'Cateigorie update successfully'
         ];
    }
    public function searchCateigorie($search)
    {
        if ($search) {
           
            $Cateigorie = Cateigorie::where('name', 'like', '%' . $search . '%')
                ->get();
        } 
        return [
            'message' => ' found',
            'Cateigorie' => $Cateigorie
        ];



    }
}
