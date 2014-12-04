<?php

/**
 * Create a menu item and handling active menu 
 * from http://forumsarchive.laravel.io/viewtopic.php?id=827
 */
HTML::macro('nav_link', function($url, $text) 
{
	$class = ( Request::is($url) || Request::is($url.'/*') ) ? ' class="active"' : '';
	return '<li'.$class.'><a href="'.URL::to($url).'">'.$text.'</a></li>';
});
