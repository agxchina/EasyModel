<?php
namespace Agxmaster\EasyModel\Format;

use Agxmaster\EasyModel\Format\AbastractFormat;

class IndexBeKey extends AbastractFormat{
	
	private $id = 'id';
		
	public function __construct($container){
		parent::__construct($container);
	}
	
	public function format($result){
		$this->setKeyWord();
		$newFormat = [];
		foreach($result as $value)
			$newFormat[$value[$this->id]] = $value;
		return $newFormat;
	}
		
	public function setKeyWord(){
		$this->id = $this->container->key ? $this->container->key : $this->id;
	}
}