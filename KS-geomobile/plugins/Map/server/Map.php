<?php
use Ksike\ksl\filter\control\Plugin; 
use Ksike\ksl\base\helpers\Router;
class Map extends Plugin 
{
	public function buildGUI($params) {
		$url = Router::this("relative").'client/img/inicial1.png';
		$params->document->body->add(new WImg($url), "map");
		$params->document->appendChild(new WBr);
	}

	public function update($params) {
		$url = Router::this("relative").'client/img/'.$this->get("img");
		$window = $this->get("gui");
		$window->document->body->items["map"]->src = $url;
		$this->save("gui", $window);
	}
}
