<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\CategoryNews;
use App\Models\News;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Pars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = "https://lenta.ru/rss/news";

        $response = Http::withoutVerifying()->get($url); //нет сертификата
        if ($response->failed()) {
            $error = $response->body();
            dd($error);
        }

        $news = simplexml_load_string($response->body());
        foreach ($news->channel->item as $item) {
            $guid = $item->guid;
            $category = $item->category;

            $newNews = News::firstOrCreate( //первый параметр - критерий поиска
                ['guid' => $guid],
                [
                    'author' => $item->author,
                    'title' => $item->title,
                    'description' => (string) $item->description,
                    'enclosure' => $item->enclosure['url'], //цепляю ссылку на пикчу
                    'photo' => file_get_contents($item->enclosure['url']),//пикча бинарным файлом, мб в b64
                    'pubDate' => DateTime::createFromFormat('D, d M Y H:i:s O', $item->pubDate)
                ]
            );

            $newCategory = Category::firstOrCreate(['name' => $category]);

            $newNews->categories()->syncWithoutDetaching([$newCategory->id]);
        }

        //кекв, но ничего лучше не придумал
        $newRecordsCount = News::where('created_at', '>=', now()->subSeconds(10))->count();
        if ($newRecordsCount == 0) {
            echo "Новых новостей нет";
        } else {
            echo "Кол-во добавленных новостей: $newRecordsCount";
        }

    }
}
