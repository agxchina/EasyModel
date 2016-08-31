<?php
namespace Agxmaster\EasyModel\Handle\Insert;
use Agxmaster\EasyModel\Handle\AbstractHandle;

class SimpleHandle extends AbstractHandle{
	
	public function __construct($container){
		parent::__construct($container);
	}
	
	public function handle(){
		
		$config = [];
		foreach($this->container->tables as $index => $table){
			$config = [
					'table'		=>	$table,
					'data'		=>	$this->container->data
			];
		}
		return $this->model->formInsert($config);
	}
	
}