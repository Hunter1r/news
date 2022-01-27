<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return view('index');
    }

    public function getCategories($news) {
        $categories = [];

        foreach ($news as $item) {
            
            if (!in_array($item['category'], $categories, true)) {
                $categories[] = $item['category'];
            }
        }
        return $categories;
    }

    public function getNews() {

        $news[] = ['category'=>'sport',
        'id'=>1,
        'title'=>'Novak Djokovic: Tennis star detained ahead of deportation appeal',
        'description'=>'Novak Djokovic has been detained in Australia ahead of a court hearing that will determine whether the unvaccinated tennis star can stay in the country.',
        'author'=>'Novak Djokovic',
        'date'=>'14/01/2022'];
        $news[] = ['category'=>'sport',
        'id'=>2,
        'title'=>'Australian Open: Emma Raducanu\'s preparation \'not ideal\' after Covid-19 case',
        'description'=>'Britain\'s Emma Raducanu says her limited preparation for the Australian Open after testing positive for coronavirus has been \"far from ideal\".',
        'author'=>'Jonathan Jurejko',
        'date'=>'15/01/2022'];
        $news[] = ['category'=>'sport',
        'id'=>3,
        'title'=>'Lea Campos: The Brazilian who battled prejudice & patriarchy to become a referee',
        'description'=>'In 1971 Brazil, most people would think long and hard before going anywhere near General Emilio Garrastazu Medici. The country\'s then-president was a fearsome figure whose brutally repressive military rule relied on systematic torture and the assassination of dissenters. But Lea Campos was about to go and see him.',
        'author'=>'Fernando Duarte',
        'date'=>'13/01/2022'];
        $news[] = ['category'=>'sport',
        'id'=>4,
        'title'=>'Andy Murray loses Sydney final to Aslan Karatsev',
        'description'=>'Andy Murray\'s bid for a first ATP title since October 2019 ended in a straight-set defeat by Russian top seed Aslan Karatsev in the Sydney Classic final.',
        'author'=>'Andy Murray',
        'date'=>'15/01/2022'];

        $news[] = ['category'=>'travel',
        'id'=>5,
        'title'=>'The UK village that lost its cheese',
        'description'=>'Cheddar has conquered the world, but it wasn\'t produced in its namesake English town for years. Now, an award-winning dairy is putting Cheddar, England back on the map.',
        'author'=>'Lizzie Enfield',
        'date'=>'11/11/2021'];
        $news[] = ['category'=>'travel',
        'id'=>6,
        'title'=>'Nowa Huta: The city that went from communism to capitalism',
        'description'=>'Once a failed post-WW2 utopia, Krakow\'s Nowa Huta neighbourhood has found a new lease on life and is slowly emerging as a tourist destination.',
        'author'=>'Luka Jukic',
        'date'=>'14/01/2022'];
        $news[] = ['category'=>'travel',
        'id'=>7,
        'title'=>'Can Taiwan become Asia\'s next great hiking destination?',
        'description'=>'By mapping trails, leading ascents and introducing locals to the beauty of their own backyard, one mountaineer has been working tirelessly to put Taiwan on the trekking map.',
        'author'=>'Joe Henley',
        'date'=>'15/12/2021'];
        $news[] = ['category'=>'travel',
        'id'=>8,
        'title'=>'The Canadian city to visit this winter',
        'description'=>'After some of the longest and strictest restaurant lockdowns of any city of the world, Toronto is moving towards lifting all pandemic restrictions by March 2022.',
        'author'=>'Lindsey Galloway',
        'date'=>'08/12/2021'];

        $news[] = ['category'=>'future',
        'id'=>9,
        'title'=>'The benefits of intermittent fasting the right way',
        'description'=>'Intermittent fasting offers the tantalising promise that changing mealtimes, and not the meals, can be good for you. But what are the dos and don’ts of eating less frequently?',
        'author'=>'William Park',
        'date'=>'11/01/2022'];
        $news[] = ['category'=>'future',
        'id'=>10,
        'title'=>'Why Nasa is exploring the deepest oceans on Earth',
        'description'=>'Could our understanding of the deep ocean help unlock the mysteries of outer space? Nasa\'s space mission is leading us to unexplored depths of our own planet.',
        'author'=>'Isabelle Gerretsen',
        'date'=>'13/01/2022'];
        $news[] = ['category'=>'future',
        'id'=>11,
        'title'=>'Is the UK poised to return to space launches?',
        'description'=>'The UK could have space launch capability as soon as this summer. What will these spaceports look like and how will they operate?',
        'author'=>'Peter Ray Allison',
        'date'=>'14/01/2022'];
        $news[] = ['category'=>'future',
        'id'=>12,
        'title'=>'Why we are in \'the age of artificial islands\'',
        'description'=>'We are building more islands than ever before. In the latest edition of our photographic series Anthropo-Scene, we explore the striking results of humanity\'s attempts to colonise the world\'s lakes and oceans with new land.',
        'author'=>'Richard Fisher and Javier Hirschfeld',
        'date'=>'07/01/2022'];

        $news[] = ['category'=>'culture',
        'id'=>13,
        'title'=>'The sci-fi genre offering radical hope for living better',
        'description'=>'In these times of cynicism and despair, is \'hopepunk\' the perfect antidote? David Robson explores radical optimism, and why it matters.',
        'author'=>'David Robson',
        'date'=>'14/01/2022'];
        $news[] = ['category'=>'culture',
        'id'=>14,
        'title'=>'Why the tiny house is perfect for now',
        'description'=>'Just as minimalism found its moment, now it\'s the turn of the tiny house movement. Beverley D\'Silva explores why, when it comes to dwellings, small is beautiful.',
        'author'=>'Beverley D\'Silva',
        'date'=>'04/01/2022'];
        $news[] = ['category'=>'culture',
        'id'=>15,
        'title'=>'The film changing how we see the internet',
        'description'=>'Writers and filmmakers often take doomy views of the web. But new animation Belle, by Japanese director Mamoru Hosoda, shows off its beautiful possibilities, writes Kambole Campbell.',
        'author'=>'Kambole Campbell',
        'date'=>'13/01/2022'];
        $news[] = ['category'=>'culture',
        'id'=>16,
        'title'=>'Nine TV shows to watch this January',
        'description'=>'From the glitzy The Gilded Age to a James Gunn prequel series to The Suicide Squad and a darkly comic psychological thriller, Amy Charles picks the series not to miss this January.',
        'author'=>'Amy Charles',
        'date'=>'05/01/2022'];


        $news[] = ['category'=>'worklife',
        'id'=>17,
        'title'=>'Why a wide-scale return to the office is a myth',
        'description'=>'For two years, employees have been waiting for ‘the day’ when everyone goes back to the office. But it’s probably never coming.',
        'author'=>'Alex Christian',
        'date'=>'14/01/2022'];
        $news[] = ['category'=>'worklife',
        'id'=>18,
        'title'=>'The \'cannamoms\' parenting with cannabis',
        'description'=>'An increasing number of mothers are using cannabis to help them parent. As they come out of the \'green closet\', they\'re hoping to shift the stigma.',
        'author'=>'Jesse Staniforth',
        'date'=>'19/11/2021'];
        $news[] = ['category'=>'worklife',
        'id'=>19,
        'title'=>'Why presenteeism wins out over productivity',
        'description'=>'If the pandemic has taught us anything about work, it\'s that we don\'t need to be pulling long hours in an office to be productive. So, why is presenteeism still so important?',
        'author'=>'Bryan Lufkin',
        'date'=>'07/06/2021'];
        $news[] = ['category'=>'worklife',
        'id'=>20,
        'title'=>'Family estrangement: Why adults are cutting off their parents',
        'description'=>'Polarised politics and a growing awareness of how difficult relationships can impact our mental health are fuelling family estrangement, say psychologists.',
        'author'=>'Maddy Savage',
        'date'=>'01/12/2021'];

        return $news;
    }
}
