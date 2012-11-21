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

namespace Jquerycdn;

class Jquerycdn
{
	protected static function validate_version($version)
	{
		$pattern = '/^[1-9][0-9]*(\.[0-9]+)*$/';
		if (preg_match($pattern,$version))
		{ 
			return true;
		} else {
			return false;
		}
	}
	public static function getcdn($place)
	{
		$format = \Config::get('jquerycdn.cdn.'.$place);
		$version = \Config::get('jquerycdn.version');
		if (self::validate_version($version))
		{
			return \Asset::js(sprintf($format,$version));
		} else {
			return false;
		}

	}
	public static function getfallback()
	{
		$format = \Config::get('jquerycdn.fallback');
		$version = \Config::get('jquerycdn.version');
		if (self::validate_version($version))
		{
			$fallbackurl = \Asset::js(sprintf($format,$version));
			return self::addscript($fallbackurl);
		} else {
			return false;
		}

	}
	protected static function addscript($fallbackurl)
	{
		$fallbackurl = trim($fallbackurl);
		$fallbackformat = "<script>window.jQuery || document.write('%s')</script>";
		return sprintf($fallbackformat,$fallbackurl);
	}

}
