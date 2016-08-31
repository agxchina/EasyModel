<?php
namespace Agxmaster\EasyModel\Database;

use Illuminate\Database\Eloquent\Model;
use Agxmaster\EasyModel\Database\ModelInterface;

class LaravelModel extends Model implements ModelInterface
{
	protected 	$table = '';

	private 	$pdo = null;
	
	public 		$keyWords = ['select'];
	
	public 	$timestamps = false;
	
	public function __construct(){
		$this->pdo = self::getConnection()->getPdo();
		parent::__construct();
	}
	
	public function getPdo(){
		return  $this->pdo;
	}
	
	public function getRecords($sql , $params = []){
	
		$pdo = $this->getPdo();
		$records = $this->getPdo()->prepare($sql);
		$records->execute($params);
		return $records->fetchAll($pdo::FETCH_ASSOC);
	}
	
	public function getWhereIn($query,$config,$key = 'whereIn'){
		if(!empty($config[$key]) && is_array($config[$key])){
			foreach($config[$key] as $wherek => $wherev){
				$query->whereIn($wherek,$wherev);
			}
		}
		return $query;
	}

	public function getOrder($query,$config,$key = 'order'){
		if(!empty($config[$key]) && is_array($config[$key])){
			foreach($config[$key] as $orderk => $orderv){
				if(is_int($orderk)){
					$query->orderBy($orderv);
				}else
					$query->orderBy($orderk,$orderv);
			}
		}
		return $query;
	}
	
	public function getGroup($query,$config,$key = 'group'){
		if(!empty($config[$key]) && is_array($config[$key])){
			foreach($config[$key] as $groupk => $groupv){
					$query->groupBy($groupv);
			}
		}
		return $query;
	}
	
	public function getWhere($query,$config,$key = 'where'){
		if(!empty($config[$key]) && is_array($config[$key])){
			foreach($config[$key] as $wherek => $wherev){
				if(count($wherev) === 3){
					$query->where($wherev[0],$wherev[1],$wherev[2]);
				}else{
					$query->where($wherek,$wherev);
				}
	
			}
		}
		return $query;
	}
	
	public function getColumns($columns){
		$result = [];
		foreach($columns as $key => $value){
			if(is_int($key)){
				$result[] = $value;
			}else{
				$result[] = $key .' as '.$value;
			}
		}
		return $result;
	}
	
	public function getJoin($query,$config,$key){
	
		if(!empty($config[$key]) && is_array($config[$key])){
			foreach($config[$key] as $joink => $joinv){
				$joinType = '';
				if(isset($joinv['J'])){
					$joinType = $joinv['J'];
					unset($joinv['J']);
				}
				if(count($joinv) === 3){
					$join = $joinType ? $joinType . 'Join' : 'join';
					$query = $query -> $join($joink,$joinv[0],$joinv[1],$joinv[2]);
				}
			}
			return $query;
		}else{
			return null;
		}
	
	}
	
	public function formselect($config = []){
		
		$result = [];
		$this->timestamps = false;
		$this->table = $config['table'];
		
		$columns = isset($config['column']) ? $this->getColumns($config['column']) : ['*'];
		$query = null;
		
		if(isset($config['join'])){
			$query = $this->getJoin($this->select($columns,$this),$config, 'join');
		}else{
			$query = $this->select($columns);
		}
		
		$query = $this->getWhere($query, $config, 'where');
		$query = $this->getWhereIn($query, $config, 'whereIn');
		
		if(!isset($config['count']))
			$query = $this->getOrder($query, $config, 'order');
		
		$query = $this->getGroup($query, $config, 'group');
		
		if(!empty($config['skip']))
			$query->skip($config['skip']);
		
		if(!empty($config['take']))
			$query->take($config['take']);
		
		if(isset($config['count'])){
			$result = $query->count($config['count']);
		}else{
			$result = $query->get()->toarray();
		}
		return $result;
	}
	
	public function formInsert($config){
		$this->table = $config['table'];
		return self::insert($config['data']);
	}
	
	public function formInsertGetId($config){
		$this->table = $config['table'];
		return self::insertGetId($config['data']);
	}
	
	public function formUpdate($config){
		$this->table = $config['table'];
		return $this->getWhere(self::where(array()), $config, 'where')->update($config['data']);
	}
	
	public function formDelete($config){
		$this->table = $config['table'];
		return $this->getWhere(self::where(array()), $config, 'where')->delete();
	}
	
}
