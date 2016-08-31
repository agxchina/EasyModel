<?php
namespace Agxmaster\EasyModel\Handle;

use Agxmaster\EasyModel\Database\LaravelModel;
use Agxmaster\EasyModel\Format\AbastractFormat;
use Agxmaster\EasyModel\Exception\EasyModelException;

abstract  class AbstractHandle{
	
	protected $container = null;
	
	protected $model = null;
	
	protected $formatNamespace = 'Agxmaster\EasyModel\Format';
	
	public function  __construct($container){
		$this->container = $container;
		$this-> model = new LaravelModel();
	}
	
	public abstract  function handle();
	
	public function format($result){
		
		if($this->container->format && $result){
			$formatClassName = $this->formatNamespace . '\\' . $this->container->format;
			if(!class_exists($formatClassName)){
				throw new EasyModelException('format not exists');
			}
			$class = new $formatClassName($this->container);
			if(!$class instanceof AbastractFormat){
				throw new EasyModelException('format class error');
			}
			return $class -> format($result);
		}
		return $result;
	}
}