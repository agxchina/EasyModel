<?php
namespace Agxmaster\EasyModel\Format;

use Agxmaster\EasyModel\Format\AbastractFormat;

class Field extends AbastractFormat{
	
	public function __construct($container){
		$this->indexBeKey = new IndexBeKey($container);
		parent::__construct($container);
	}
	
	public function format($result){
		if(is_array($result) && $result){
			$v = array_values($result)[0];
			if(is_array($v) && $v){
				return array_values($v)[0];
			}else{
				return $v;
			}
		}else{
			return $result;
		}
	}
	
}