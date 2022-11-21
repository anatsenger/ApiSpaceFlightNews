<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Articles;

class EventsController extends Controller{
    public function store(Request $request){
        try {
            $event = Events::create([
                'id' => $request->id,
                'provider' => $request->provider
            ]);
    
            return response()->json($event, 201);
        } catch (\Exception $e) {
            return['retorno' => 'erro', 'details'=>$e];
        }
        
    }

    public function list(){
        $event = Events::all();
        return $article;
    }
}