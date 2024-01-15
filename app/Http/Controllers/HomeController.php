<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function storeImage(Request $request) {
        if ($request->hasFile('upload')) {
            $card = new Card();
            $card->user_id = auth()->id();
            $card->column_id = $request->column_id;
            $card->save();
            $image = $card->addMediaFromRequest('upload')->toMediaCollection('images');
            return response()->json(['url' => $image->getUrl('thumb')]);
        }
    }

}
