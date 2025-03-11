<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use function Laravel\Prompts\select;
/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     required={"id", "name", "description", "aisle_id", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Coca-Cola"),
 *     @OA\Property(property="description", type="string", example="Beverage"),
 *     @OA\Property(property="aisle_id", type="integer", example=2),  // ID du rayon auquel le produit appartient
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-09T12:34:56"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-09T12:34:56")
 * )
 */


class productController extends Controller
{
    use Searchable;
    public function product(request $request)
    {
        $data = $request->validate([
            'rayon_id' => 'required',
            'cateigorie_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'prace' => 'required',
            'rating' => 'required',
            'sale_price' => 'required'




        ]);

        $aisle = product::create([
            'rayon_id' => $data['rayon_id'],
            'cateigorie_id' => $data['cateigorie_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'prace' => $data['prace'],
            'rating' => $data['rating'],
            'sale_price' => $data['sale_price'],


        ]);



        return [
            "message" => "Produits créés avec succès!",
            'aisle' => $aisle
        ];
    }

    public function liste_produits($id)
    {
        $liste_produits = DB::table('rayons as a')
            ->join('products as p', 'p.rayon_id', '=', 'a.id')
            ->join('stocks as s', 's.product_id', '=', 'p.id')
            ->select('a.*', 'p.*', 's.*')
            ->where('p.id', '=', $id)
            ->get();

        return [
            'liste_produits' => $liste_produits
        ];

    }

    public function searchProduit(request $request)
    {
        if ($request->has('cateigorie')) {
            $cateigorie = $request->cateigorie;

            $produit = DB::table('products as p')
                ->join('cateigories as c', 'p.cateigorie_id', '=', 'c.id')
                ->where('c.name', 'like', '%' . $cateigorie . '%')
                ->select('p.*', 'c.*')
                ->get();

        } elseif ($request->has('name')) {
            $name = $request->name;
            $produit = product::where('name', 'like', '%' . $name . '%')
                ->get();
        } else {
            return [
                'message' => 'dont found any things'
            ];
        }

        return [
            'message' => 'found',
            'produit' => $produit
        ];



    }
    public function produits_populaires($id)
    {
        $produits_populaire = DB::table('rayons as a')
            ->join('products as p', 'p.rayon_id', '=', 'a.id')
            ->join('stocks as s', 's.product_id', '=', 'p.id')
            ->select('a.*', 'p.*', 's.*')
            ->where('a.id', '=', $id)
            ->orderBy('rating', 'desc')
            ->take(5)
            ->get();

        return [
            'produits_populaires' => $produits_populaire
        ];
    }
    public function produits_promotion($id)
    {
        $produits_populaire = DB::table('rayons as a')
            ->join('products as p', 'p.rayon_id', '=', 'a.id')
            ->join('stocks as s', 's.product_id', '=', 'p.id')
            ->select('a.*', 'p.*', 's.*')
            ->where('a.id', '=', $id)
            ->whereColumn('p.prace', '>', 'p.sale_price')
            ->orderBy('p.sale_price', 'desc')
            ->take(5)
            ->get();

        return [
            'produits_populaires' => $produits_populaire
        ];

    }

    public function deleteproduit($id)
    {
        $rayon = product::find($id);
        $rayon->delete();
        return [
            'message' => 'product deleted successfully'
        ];
    }

    public function updateproduct(request $request, $id)
    {

        $product = product::find($id);

        $product->rayon_id = $request->rayon_id;
        $product->cateigorie_id = $request->cateigorie_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->prace = $request->prace;
        $product->rating = $request->rating;
        $product->sale_price = $request->sale_price;
        $product->save();

        return [
            'message' => 'product update successfully'
        ];
    }
}
