<?php 
/**
 * @author     Antonio Membrides Espinosa
 * @email      tonykssa@gmail.com
 * @date       04/10/2019
 * @version    1.0
 */
include "SpinnerTool.php";

$pattern = "{regards} {customer} soy {salesman}";
$pattern = isset($_REQUEST['btnSend']) ? $_REQUEST['pattern'] : $pattern;

$out = SpinnerTool::instance()->load("database.json")->formatDb($pattern);
?> 

<style>
	textarea {
		width: 50%;
		height: 100px;
		margin: 4px;
	}
</style>

<pre>
JSON DATABASE {
	"regards": ["Hola", "Buenos Dias", "Buenas Noches" ],
	"customer": ["Alberto", "Fernandez"],
	"salesman": ["Ramon", "Consultor SEO", "Consultor de Marketing"]
}
</pre>

<form id="form1" name="form1" method="post" action="">
	<textarea name="pattern" id="pattern"><?php echo $pattern; ?></textarea>
	</br>
	<textarea name="out" id="out"><?php echo $out; ?></textarea>
	</br>
	<input type="submit" name="btnSend" value="Send"/> 
</form>
