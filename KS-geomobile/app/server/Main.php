<?php
use Ksike\ksl\filter\control\App; 
use Ksike\ksl\base\helpers\Assist;
use Ksike\ksl\filter\iface\Security;
class Main extends App implements Security
{
	public function __construct($mate) 
	{
		parent::__construct($mate);
		$this->linker->load();
	}

	public function index($params)
	{
		$window = Assist::driver('WDOM');
		$this->callthem("buildGUI", $window);
		$window->document->appendChild("width: " .$window->document->width);
		$window->document->appendChild(new WBr);
		$window->document->appendChild("height: ".$window->document->height);
		$this->save("gui", $window);	
	}

	public function in($params)
	{
		echo "<h3> Application Test on Movile Dev </h3> <br>";
	}

	public function out($params)
	{
		$this->get("gui")->render();
		Assist::package("error")->supply("MyError", "BugHandler");
		Assist::package("error")->supply("MyExeption", "ExceptHandler");
	}

	public function accessAllow($certy, $acction){
		return true;
	}
	public function accessRefuse($certy, $acction){
		echo "<h1> Access Refuse to:</h1> $acction <br>";
	}
}
