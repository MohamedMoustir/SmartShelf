<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rayon;


/**
 * @OA\Schema(
 *     schema="Aisle",
 *     type="object",
 *     required={"id", "name", "description", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Boissons"),
 *     @OA\Property(property="description", type="string", example="Rayon contenant toutes les boissons"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-09T12:34:56"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-09T12:34:56")
 * )
 */
class RayonController extends Controller
{

    public function rayon(request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $rayon = Rayon::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return [
            "message" => "Rayons créés avec succès!",
            'aisle' => $rayon
        ];
    }

    public function showRayon()
    {
        $rayon = Rayon::all();
        return [
            "all rayon" => $rayon,
        ];
    }
    public function deleteRayon($id)
    {
        $rayon = Rayon::find($id);
        $rayon->delete();
        return [
           'message' => 'Rayon deleted successfully'
        ];
    }
    public function updateRayon(request $request,$id)
    {
        $rayon = Rayon::find($id);
        $rayon->name = $request->name;
        $rayon->description = $request->description;
        $rayon->save();
        return [
            'message' => 'Rayon update successfully'
         ];
    }
    public function searchRayon($search)
    {
        if ($search) {
           
            $Rayon = Rayon::where('name', 'like', '%' . $search . '%')
                ->get();
        } 
        return [
            'message' => ' found',
            'Rayon' => $Rayon
        ];



    }
}
