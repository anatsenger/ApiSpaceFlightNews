<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DailyArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AddArticles:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds new articles to the database daily at 9am.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        $articles = DB::table('new_articles')->get();

        if($articles){

            foreach ($articles as $article){
        
             DB::connection('mysql')->insert('insert into articles (featured, title, url, imageUrl, newsSite, summary, publishedAt) values (?,?,?,?,?,?,?)',  array($article->featured , $article->title,   $article->url, $article->imageUrl,  $article->newsSite, $article->summary, $article->publishedAt));
            }
            DB::table('new_articles')->delete();

        $this->info('New articles have been added.');
        }else{
        $this->info('No articles have been added today.');
    }
}
}
