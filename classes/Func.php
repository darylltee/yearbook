<?php


class Func
{

	public static function print_pre($array)
	{
		$return = "<pre>".print_r($array,true)."</pre>";
		return $return;
	}

	public static function not_set($var)
	{	
		if(!isset($var))
			return "";
		else
			return $var;
		
	}

	public static function multi_word_search($fieldname, $values = array())
	{
		$add_query = "(`$fieldname` LIKE '%". implode("%' OR `$fieldname` LIKE '%",$values) ."%')";
		
		return $add_query;
	}

	
}