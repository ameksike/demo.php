<?php
use Ksike\ksl\filter\control\Plugin;
class Navigation extends Plugin 
{
	public function buildGUI($params) {
		$params->document->appendChild(new WForm(array(
				'action' => 'index.php',
				'method' => 'post',
				'enable_wml' => 'true',
				'name' => 'Navigation'
			),array(
				new WInput("action", "zoomIn"),
				new WInput("action", "zoomOut"),
				new WInput("controller", "Navigation", "hidden")
		)));
	}

	public function zoomIn($params) {
		$this->save("img", 'inicial.png');
	}

	public function zoomOut($params) {
		$this->save("img", 'inicial1.png');
	}
}
