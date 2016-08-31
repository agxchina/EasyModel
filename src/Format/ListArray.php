<?php
namespace Agxmaster\EasyModel\Format;

use Agxmaster\EasyModel\Format\AbastractFormat;

class ListArray extends AbastractFormat{
	
	public function __construct($container){
		$this->indexBeKey = new IndexBeKey($container);
		parent::__construct($container);
	}
	
	public function format($result){
		$newFormat = [];
		if(is_array($result) && $result){
			foreach($result as $v){
				$newFormat[] = array_values($v)[0];
			}
			return $newFormat;
		}else{
			return $result;
		}
	}
	
}