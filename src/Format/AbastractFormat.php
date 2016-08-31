<?php
namespace Agxmaster\EasyModel\Format;

abstract class AbastractFormat{
	
	protected $container = null;
	
	public function __construct($container){
		$this->container = $container;
	}
	
	public abstract function format($result);
}