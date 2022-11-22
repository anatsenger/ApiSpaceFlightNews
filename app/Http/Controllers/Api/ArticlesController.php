<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Articles;
use App\Models\NewArticles;
use App\Models\Events;
use App\Models\Launches;

class ArticlesController extends Controller
{
    public function teste(){
        return ['Teste' => 'Back-end Challenge 2021 🏅 - Space Flight News'];
    }

    public function add(Request $request){
        try{
            $article = new NewArticles();
            $launche = new Launches();
            $event = new Events();
            $article -> featured = $request->featured;
            $article-> title = $request->title;
            $article->url = $request->url;
            $article-> imageUrl = $request->imageUrl;
            $article-> newsSite = $request->newsSite;
            $article->summary = $request->summary;
            $article->publishedAt = $request->publishedAt;
            
            $launche->provider = $request->provider;
        
            $event->provider = $request->provider;
            
            
            $article -> save();
            $launche -> save();
            $event -> save();

            $tables = array('article' => $article,'Launche' => $launche,  'event' => $event);

            return response()->json($tables);

        }catch(\Exception $e){
            return['retorno' => 'erro', 'details'=>$e];
        }
    }

    public function list(){
        $article = Articles::all();
        $launche = Launches::all();
        $event = Events::all();
        if ($article) {
            $tables = array('article' => $article,'Launche' => $launche,  'event' => $event);
            return response()->json($tables);
        } else {
            return ['retorno'=> 'nenhum artigo encontrado!'];
        }
    }

    public function select($id){
        $article = Articles::find($id);
        $launche = Launches::find($id);
        $event = Events::find($id);
        if ($article) {
            $tables = array('article' => $article,'Launche' => $launche,  'event' => $event);
            return response()->json($tables);
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

            return response()->json($article);


        }catch(Exception $e){
            return ['retorno'=> 'erro', 'details'=>$e];
        }
    }

    public function delete($id){
            
            DB::table('articles')->where('id', $id)->delete();
            DB::table('launches')->where('id', $id)->delete();
            return ['retorno'=> 'artigo excluído com sucesso!!'];
        
    }
    public function index(){
      
 
        return Articles::paginate(10);
    }
}
