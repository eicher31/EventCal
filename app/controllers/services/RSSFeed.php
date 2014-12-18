<?php

namespace EventCal\Controllers\Services;

use EventCal\Controllers\BaseController;
use EventCal\Models\Event;
use Carbon\Carbon;
use Roumen\Feed\Feed;


class RSSFeed extends BaseController {

	/**
	 *  SRC : https://github.com/RoumenDamianoff/laravel-feed/wiki/basic-feed
	 * @return \Roumen\Feed\view
	 */
	public function getFeed()
	{
		$feed = new Feed();
		
		// cache the feed for 1 minute (second parameter is optional)
    	//$feed->setCache(1, 'EventCal');

	    // check if there is cached feed and build new only if is not
	    //if (!$feed->isCached())
	    {
			$posts = Event::getEvents(Carbon::today());
	
			// set your feed's title, description, link, pubdate and language
			$feed->title = \Lang::get('message.titleEventCal');
			$feed->description = \Lang::get('message.rssDescription');
			$feed->link = \URL::to('/');
			$feed->setDateFormat('carbon'); // 'datetime', 'timestamp' or 'carbon'
			$feed->pubdate = Carbon::now();
			$feed->lang = 'fr';
			$feed->setShortening(false); // true or false
			//$feed->setTextLimit(100); // maximum length of description text
			
			foreach ($posts as $post)
			{
				$desc = \Lang::get('message.showDate') . ": " . $post->getDayWeek() . " " . $post->getDate() . " " . $post->getTime();
				$desc .= '<br /><br />' . $post['description'];
				
				// set item's title, author, url, pubdate, description and content
				$feed->add($post['name'], $post->society->name, \URL::to('event',$post['id']), $post['updated_at'],$desc,'');
			}
	    }
	
	    // first param is the feed format
	    // optional: second param is cache duration (value of 0 turns off caching)
	    // optional: you can set custom cache key with 3rd param as string
	    return $feed->render('atom');
	
	    // to return your feed as a string set second param to -1
	    // $xml = $feed->render('atom', -1);
		}
	
}
