<?php

namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Stock",
 *     type="object",
 *     required={"id", "product_id", "quantity", "created_at", "updated_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="product_id", type="integer", example=1),  // ID du produit (référence à l'entité Product)
 *     @OA\Property(property="quantity", type="integer", example=150),  // Quantité en stock
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-09T12:34:56"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-03-09T12:34:56")
 * )
 */

class stockesController extends Controller
{
    public function stock(request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $stock = stock::create([
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity']
        ]);



        return [
            "message" => "Stocks créés avec succès!",
            'stock' => $stock
        ];
    }
}
