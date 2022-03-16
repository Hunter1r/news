<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Models\News;
use App\Models\Category;
use Faker\Factory;

class ParserController extends Controller
{
    public function index() {
        $xml = XmlParser::load('https://news.yandex.ru/sport.rss');
        $faker = Factory::create();
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
