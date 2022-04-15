<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Models\News;
use App\Models\Category;
use Faker\Factory;
use App\Jobs\NewsParsing;
use Illuminate\Support\Facades\Redis;

class ParserController extends Controller
{
    public function index() {

        $links = [
            'https://news.yandex.ru/auto.rss',
            'https://news.yandex.ru/auto_racing.rss',
            'https://news.yandex.ru/army.rss',
            'https://news.yandex.ru/gadgets.rss',
            'https://news.yandex.ru/index.rss',
            'https://news.yandex.ru/martial_arts.rss',
            'https://news.yandex.ru/communal.rss',
            'https://news.yandex.ru/health.rss',
            'https://news.yandex.ru/games.rss',
            'https://news.yandex.ru/internet.rss',
            'https://news.yandex.ru/cyber_sport.rss',
            'https://news.yandex.ru/movies.rss',
            'https://news.yandex.ru/cosmos.rss',
            'https://news.yandex.ru/culture.rss',
            'https://news.yandex.ru/championsleague.rss',
            'https://news.yandex.ru/music.rss',
            'https://news.yandex.ru/nhl.rss',
        ];

        foreach($links as $link) {
            dispatch(new NewsParsing($link));
		}

		return "Parsing completed!";
        
    }

    public function parse($link) {


        $xml = XmlParser::load($link);
        $data = $xml->parse([
            'title' => [
                'uses' => 'channel.title'
            ],
            'link' => [
                'uses' => 'channel.link'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[title,link,guid,description,pubDate]'
            ],

        ]);
  
        // dump($data);
        echo date('c'). ' ' . $link;

        $this->loadDataToDB($data);

    }

    public function loadDataToDB($data) {

        $faker = Factory::create();
        $nameCategory = $data['title'];
        $category = Category::where('name', '=', $nameCategory)->firstOrCreate([
            'name' => $nameCategory,
        ]);

        if($category){
            foreach($data['news'] as $item) {
                News::where('slug', '=', $item['guid'])->firstOrCreate([
                    'date' =>  date("Y-m-d", strtotime($item['pubDate'])),
                    'title' => $item['title'],
                    'slug' => $item['guid'],
                    'author' => $faker->name(),
                    'active' => 1,
                    'description' => $item['description'],
                    'category_id' => $category->id,
                ]);
            }
        }

    }
}
