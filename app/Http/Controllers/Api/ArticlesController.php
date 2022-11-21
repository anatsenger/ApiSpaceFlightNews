<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Articles;
use App\Models\NewArticles;

class ArticlesController extends Controller
{
    public function teste(){
        return ['Teste' => 'Back-end Challenge 2021 🏅 - Space Flight News'];
    }

    public function add(Request $request){
        try{
            $article = new NewArticles();
            $article -> id = $request->id;
            $article -> featured = $request->featured;
            $article-> title = $request->title;
            $article->url = $request->url;
            $article-> imageUrl = $request->imageUrl;
            $article-> newsSite = $request->newsSite;
            $article->summary = $request->summary;
            $article->publishedAt = $request->publishedAt;

            $article -> save();

            return response()->json($article, 201);

        }catch(\Exception $e){
            return['retorno' => 'erro', 'details'=>$e];
        }
    }

    public function list(){
        $article = Articles::all();
        return $article;
    }

    public function select($id){
        $article = Articles::find($id);
        if ($article) {
            return $article;
        } else {
            return ['retorno'=> 'artigo não encontrado!'];
        }
    }

    public function update(Request $request, $id){
        try{
            $article = Articles::find($id);
            $article->id = $request->id;
            $article -> featured = $request->featured;
            $article-> title = $request->title;
            $article->url = $request->url;
            $article-> imageUrl = $request->imageUrl;
            $article-> newsSite = $request->newsSite;
            $article->summary = $request->summary;
            $article->publishedAt = $request->publishedAt;

            $article->save();

            return response()->json($article, 201);


        }catch(Exception $e){
            return ['retorno'=> 'erro', 'details'=>$e];
        }
    }

    public function delete($id){
            DB::table('articles')->where('id', $id)->delete();
            return ['retorno'=> 'artigo excluído com sucesso!!'];
        
    }
}
