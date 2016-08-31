<?php
namespace Agxmaster\EasyModel;

use Agxmaster\EasyModel\Exception\EasyModelException;
use Agxmaster\EasyModel\Handle\AbstractHandle;
use Agxmaster\EasyModel\Core\Parser;
use Agxmaster\EasyModel\Database\LaravelModel;

class EasyModel{
	
	//表名
	public $table = '';
	//主键
	public $primaryKey = '';
	
	//数据操作模型
	public $model = null;
	
	//数据容器
	public $container = null;
	
	public $handleNamespace = 'Agxmaster\EasyModel\Handle';
	
	public $parser = null;
		
	public function __construct(){
		$this-> model = new LaravelModel();
	}
	
	public static function __callStatic($method,$args){
		
	}
	
	public function __call($method,$args){
		$this->model->table = $this->table;
		$this->model->primaryKey = $this->primaryKey;
		
		if(property_exists($this,'config')){
			$this->model->config = $this->config;
		}else{
			$this->model->config = [];
		}
		
		if(in_array($method, $this->model->keyWords)){
			return $this->model->{$method}($args);
		}else{
			$this->container = new Container();
		}
		
		if(!$this->container){
			$this->container = new Container();
		}
		
		(new Parser($this->model,$this->container))->parserRequest($method,$args);
		
		$result = $config = [];
		
		$handle = $this->handleNamespace . '\\' . ucwords($this->container->action) . '\\' . ucwords($this->container->type ) . 'Handle';
		if(!class_exists($handle)){
			throw new EasyModelException('handle not found');
		}
		
		if(!($handleClass = new $handle($this->container)) instanceof AbstractHandle){
			throw new EasyModelException('handle not implement handleInterface');
		}
	
		return $handleClass -> handle();
	}
}
