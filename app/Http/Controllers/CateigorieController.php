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
}
