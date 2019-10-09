<?php 
//....................................................................................
/**
 * @author     Antonio Membrides Espinosa
 * @email      tonykssa@gmail.com
 * @date       04/10/2019
 * @version    1.0
 */
class SpinnerTool
{
	public static function format($pattern){
		if(preg_match('#\{(.+?)\}#is', $pattern, $sub))
		{
			if(($i=strpos($sub[1],'{'))>-1)
				$sub[1]=substr($sub[1], $i+1);
			$store = explode('|', $sub[1]);
			$pattern = preg_replace("+\{".preg_quote($sub[1])."\}+is", $store[array_rand($store)], $pattern, 1);
			return self::format($pattern);
		}
		return $pattern;
	}
}
//....................................................................................
$pattern = "{Hola Alberto|Buenos días Alberto|Hola señor Fernández} soy {Ramón|Consultor SEO|Consultor de Marketing}";
$pattern = isset($_REQUEST['btnSend']) ? $_REQUEST['pattern'] : $pattern;
//....................................................................................
$out = SpinnerTool::format($pattern);
//....................................................................................
?> 

<style>
	textarea {
		width: 50%;
		height: 100px;
		margin: 4px;
	}
</style>

<form id="form1" name="form1" method="post" action="">
	<textarea name="pattern" id="pattern"><?php echo $pattern; ?></textarea>
	</br>
	<textarea name="out" id="out"><?php echo $out; ?></textarea>
	</br>
	<input type="submit" name="btnSend" value="Send"/> 
</form>
