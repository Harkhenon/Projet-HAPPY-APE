<?php 

namespace App\Utils;

class Slugger
{
    public static function slugify(string $str): string
    {
		$separator = '-';

		$q_separator = preg_quote($separator, '#');

		$trans = array(
			'&.+?;'			=> '',
			'[^\w\d _-]'		=> '',
			'\s+'			=> $separator,
			'('.$q_separator.')+'	=> $separator
		);

		$str = strip_tags($str);
		foreach ($trans as $key => $val)
		{
			$str = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $str);
		}

		$str = strtolower($str);

		return trim(trim($str, $separator));
    }
}
