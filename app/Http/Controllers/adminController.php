<?php

namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmailNotification;
class adminController extends Controller
{
    use Notifiable;
    public function notificationStock()
    {
        $stocks = DB::table('stocks as s')
            ->join('products as p', 'p.id', '=', 's.product_id')
            ->get();
        foreach ($stocks as $stock) {

            if ($stock->quantity < 3) {
                
                Mail::to('itsmoustir@gmail.com')->send(new WelcomeEmailNotification($stocks));

                return [
                    "message" => "stock is empty",
                    'name product' => $stock->name,
                    'stock' => $stock->quantity,
                ];
            } else {
                return [
                    "message" => "stock is found ",
                    'name product' => $stock->name,
                    'stock' => $stock->quantity,
                ];
            }
        }
    }

}
