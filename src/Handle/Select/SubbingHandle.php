<?php
namespace Agxmaster\EasyModel\Handle\Select;
use Agxmaster\EasyModel\Handle\AbstractHandle;

use Agxmaster\EasyModel\Format\SubFormat;

class SubbingHandle extends AbstractHandle{
	
	public function __construct($container){
		parent::__construct($container);
	}
	
	public function handle(){
		
		foreach($this->container->tables as $index => $table){
			if($index == 0){
				$config['table'] = $table;
			}else{
				$config['join'][$table] = [$table . '.' . $this->container->join[$table] , '=' , $config['table'] . '.' . $this->container->join[$config['table']]];
			}
			if(!$this->container->where){
				$this->setError('join must has where');
			}
			
			foreach($this->container->where as $tablek => $tablev){
				foreach($tablev as $tk => $tv){
					$config['where'][$tablek.'.'.$tk] = $tv;
				}
			}
			
			foreach($this->container->columns[$table] as $column){
				$config['column'][] = $tablek . '.' . $column; 
			}

			$config['skip'] = $this->container->skip;
			if($this->container->take){
				$config['take']	= $this->container->take;
			}
		}
		$result = $this->model->formselect($config);
		
		return $this->format($result);
		
	}
	
	
	
}