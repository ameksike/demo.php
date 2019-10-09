<?php
/**
 * @author     Antonio Membrides Espinosa
 * @email      tonykssa@gmail.com
 * @date       04/10/2019
 * @version    1.0
 */
class SpinnerTool
{
	//.....................................................................
	public static $__this = false;
	public static function instance()
	{
		if(!static::$__this) static::$__this = new self();
		return static::$__this;
	}
	
	protected $data; 
	public function __construct()
	{
		$this->data = null;
	}
	//.....................................................................	
	public function format($pattern){
		if(preg_match('#\{(.+?)\}#is', $pattern, $sub))
		{
			if(($i=strpos($sub[1],'{'))>-1)
				$sub[1]=substr($sub[1], $i+1);
			$store = explode('|', $sub[1]);
			$pattern = preg_replace("+\{".preg_quote($sub[1])."\}+is", $store[array_rand($store)], $pattern, 1);
			return $this->format($pattern);
		}
		return $pattern;
	}
	
	public function formatDb($pattern){
		if(preg_match('#\{(.+?)\}#is', $pattern, $sub))
		{
			if(($i=strpos($sub[1],'{'))>-1)
				$sub[1]=substr($sub[1], $i+1);
			$pattern = preg_replace("+\{".preg_quote($sub[1])."\}+is", $this->getRandValue($sub[1]), $pattern, 1);
			return $this->formatDb($pattern);
		}
		return $pattern;
	}
	
	protected function getRandValue($key){
		$out = "";
		if(isset($this->data[$key])){
			if(is_array($this->data[$key])){
				$i = array_rand($this->data[$key]);
				$out = $this->data[$key][$i];
			}
		}
		return $out;
	}
	
	public function load($path){
		$json = file_get_contents($path);
		$this->data = @json_decode($json, true);
		return $this;
	}
}