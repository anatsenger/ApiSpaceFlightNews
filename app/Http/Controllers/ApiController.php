<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;




class ApiController extends Controller{

    public function add(){
            $total = Http::get('https://api.spaceflightnewsapi.net/v3/articles/count');
            $limit= 30;
            $response = Http::get("https://api.spaceflightnewsapi.net/v3/articles?_limit=$limit");
            $data = json_decode($response);
    
            for($i = 0; $i < count($data); $i++) {
    
                $existe = Articles::where('title', $data[$i]->title)->first();
    
                if(is_null($existe)) {
                    $article = new Articles();
                    
                    $article -> featured = $data[$i]->featured;
                    $article-> title = $data[$i]->title;
                    $article-> url = $data[$i]->url;
                    $article-> imageUrl = $data[$i]->imageUrl;
                    $article-> newsSite = $data[$i]->newsSite;
                    $article-> summary = $data[$i]->summary;
                    $article-> publishedAt = $data[$i]->publishedAt;

                    $article -> save();
                    
                }
            }
    
            return 'Artigos armazenados com sucesso';
        }

    }

