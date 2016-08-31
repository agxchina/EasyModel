<?php
namespace Agxmaster\EasyModel\Handle\Select;
use Agxmaster\EasyModel\Handle\AbstractHandle;

class SingleHandle extends AbstractHandle{
	
	public function __construct($container){
		parent::__construct($container);
	}
	
	public function handle(){
		
		$config = [];
		foreach($this->container->tables as $index => $table){
			$config = [
					'where'		=>	$this->container->where,
					'whereIn'		=>	$this->container->whereIn,
					'column'	=>	$this->container->columns
			];
			$config['table'] = $table;
			
			
			if($this->container->order){
				$config['order'] = $this->container->order;
			}
			
			if($this->container->group){
				$config['group'] = $this->container->group;
			}
			
			if($this->container->count){
				$config['count'] = $this->container->count;
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