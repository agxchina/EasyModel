<?php
namespace Agxmaster\EasyModel\Handle\Delete;
use Agxmaster\EasyModel\Handle\AbstractHandle;
use Agxmaster\EasyModel\Exception\EasyModelException;

class SimpleHandle extends AbstractHandle{
	
	public function __construct($container){
		parent::__construct($container);
	}
	
	public function handle(){
		
		$config = [];
		if(empty($this->container->where)){
			throw new EasyModelException('drop no where');
		}
		foreach($this->container->tables as $index => $table){
			$config = [
					'table'		=>	$table,
					'where'		=>	$this->container->where,
					'whereIn'		=>	$this->container->whereIn
			];
		}
		return $this->model->formDelete($config);
	}
	
}