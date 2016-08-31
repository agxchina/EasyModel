<?php
namespace Agxmaster\EasyModel\Handle\Select;
use Agxmaster\EasyModel\Handle\AbstractHandle;
use Agxmaster\EasyModel\Exception\EasyModelException;
class SiblingsHandle extends AbstractHandle{
	
	public function __construct($container){
		parent::__construct($container);
	}
	
	public function handle(){
		$sqlTable = [];
		$config = [];
		foreach($this->container->tables as $index => $table){
			if($index == 0){
				$sqlTable[] = $config['table'] = $table;
			}else{
				$join = [];
				$joinTable = '';
				$joinType = '';
				foreach($this->container->join[$index-1] as $joink => $joinv){
					if($joink == 'J'){
						$joinType = $joinv;
						continue;
					}
					$join[] = $joink . '.' . $joinv;
					if(count($join) == 1){
						$join[] = '=';
					}
					if(!in_array($joink, $sqlTable)){
						$sqlTable[] = $joinTable = $joink;
					}
					
				}
				$config['join'][$joinTable] = $join;
				$config['join'][$joinTable]['J'] = $joinType;
			}
// 			if(!$this->container->where){
// 				throw new EasyModelException('join must has where');
// 			}
			
			if(isset($this->container->where[$table])){
				foreach($this->container->where[$table] as $tablek => $tablev){
					$config['where'][$table.'.'.$tablek] = $tablev;
				}
			}
			
			if(isset($this->container->whereIn[$table])){
				foreach($this->container->whereIn[$table] as $tablek => $tablev){
					$config['whereIn'][$table.'.'.$tablek] = $tablev;
				}
			}
			
			if(isset($this->container->columns[$table])){
				foreach($this->container->columns[$table] as $column){
					$config['column'][] = $table . '.' . $column;
				}
			}
			
			if(isset($this->container->order[$table])){
				foreach($this->container->order[$table] as $column){
					$config['order'][] = $table . '.' . $column;
				}
			}
			
			if(isset($this->container->group[$table])){
				foreach($this->container->group[$table] as $column){
					$config['group'][] = $table . '.' . $column;
				}
			}
			
			if(isset($this->container->count[$table])){
				foreach($this->container->count[$table] as $column){
					$config['count'] = $table . '.' . $column;
					break;
				}
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