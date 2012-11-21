<?php
/**
 * Jquery CDN and fallback
 *
 * @package		Jquerycdn
 * @version		1.0
 * @author		Fumito MIZUNO (ounziw)
 * @license		MIT License
 * @copyright	2012 ounziw
 * @link		http://ounziw.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(
	'cdn' => array(
		'google' => 'https://ajax.googleapis.com/ajax/libs/jquery/%s/jquery.min.js',
	),
	'fallback' => 'jquery-%s.min.js',
	'version' => '1.7.2',
);
