<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Sale;
use App\Models\stock;
use Illuminate\Http\Request;

class clientController extends Controller
{

    public function Achter(request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required'
        ]);

        $product = product::findOrFail($request->product_id);
        $stock = stock::where('product_id', $product->id)->first();

        if ($stock->quantity > $data['quantity']) {
            $quantity = $data['quantity'];

            $total_price = 0;
            for ($i = 0; $i < $quantity; $i++) {
                $total_price += $product->prace;
            }

            $stock->quantity = $stock->quantity - $data['quantity'];
            $stock->save();
            $achter = Sale::create([
                'product_id' => $data['product_id'],
                'user_id' => $data['user_id'],
                'quantity' => $data['quantity'],
                'total_price' => $total_price,
            ]);


        } else {
            return response()->json([
                "message" => "Achat not exite",
            ], 200);
        }

        return response()->json([
            "message" => "Achat créé avec succès!",
            'product_name' => $product->name,
            'total_price' => $total_price,
        ], 201);
    }
    

}
