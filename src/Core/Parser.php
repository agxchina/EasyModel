<?php

namespace Agxmaster\EasyModel\Core;

use Agxmaster\EasyModel\Core\ParserArgs;
use Agxmaster\EasyModel\Exception\EasyModelException;

class Parser {
	private $model = null;
	private $container = null;
	private $whereTable = '';
	private $argsIndex = 0;
	private $whereIndex = 0;
	private $limitIndex = 0;
	private $lastKey = [ 
			'T' => 'Tree',
			'K' => 'IndexBeKey',
			'R' => 'Row',
			'F' => 'Field',
			'L'	=>	'ListArray'
	];
	public function __construct($model, $container) {
		$this->model = $model;
		$this->container = $container;
	}
	
	/**
	 * 解析方法字符串
	 * 
	 * @param unknown $method        	
	 */
	private function getPregResult($method) {
		preg_match_all ( '/([a-z]+|[A-Z][a-z]*[_]?[a-z]*|[_\d]+)/', $method, $pregResult );
		return $pregResult [1];
	}
	
	/**
	 * 解析请求
	 * 
	 * @param unknown $method        	
	 * @param unknown $args        	
	 */
	public function parserRequest($method, $args) {
		$resultArr = $this->getPregResult ( $method );
		
		if (true !== $lastKey = $this->setLastKey ( array_pop ( $resultArr ) )) {
			$resultArr [] = $lastKey;
		}

		if ($this->model->table)
			$this->container->tables [] = $this->model->table;
		
		if (! isset ( $resultArr [0] )) {
			throw new EasyModelException ( 'error!' );
		}
		switch ($resultArr [0]) {
			
			case 'get' :
				$this->container->action = 'select';
				unset ( $resultArr [0] );
				$this->setSelectKeyWord ( $resultArr, $args )->setDefaultColumn ()->setDefaultWhere ( $args )->showTable ();
				
				break;
			case 'set' :
				$this->checkArgsError ( $args );
				$this->container->type = 'simple';
				unset ( $resultArr [0] );
				$this->container->action = isset ( $args [0] ['where'] ) ? 'update' : 'insert';
				$this->setSimpleKeyWord ( array_values ( $resultArr ), $args );
				break;
			case 'drop' :
				unset ( $resultArr [0] );
				$this->checkArgs ( $args );
				$this->setDefaultWhere ( $args );
				$this->container->type = 'simple';
				$this->container->action = 'delete';
				$this->setSimpleKeyWord ( array_values ( $resultArr ), $args );
				break;
			case 'replace' :
				unset ( $resultArr [0] );
				$this->checkArgs ( $args );
				$this->container->type = 'simple';
				$this->container->action = 'replace';
				$this->container->tables [] = isset ( $resultArr [1] ) ? strtolower ( $resultArr [1] ) : '';
				break;
			default :
				throw new EasyModelException ( 'first keyword error!' );
		}
		
		if ($this->container->type !== 'single') {
			$this->fetchColumns ();
		}
		
		if ($args && is_array ( $args [count ( $args ) - 1] )) {
			(new ParserArgs ( $this->container ))->parserRequest ( array_pop ( $args ) );
		}
	}
	private function setSimpleKeyWord($resultArr, $args) {
		$this->setSingleTable ( $resultArr );
		$this->setSingleWhere ( array_values ( $resultArr ), $args );
		$this->setPrimaryKeyWhere ( $args );
	}
	private function setSingleTable(&$resultArr) {
		if (! $this->model->table) {
			$this->container->tables [] = strtolower ( $resultArr [0] );
			unset ( $resultArr [0] );
		}
		
		return $this;
	}
	private function setSingleWhere($resultArr, $args) {
		foreach ( $resultArr as $index => $keyWord ) {
			if (is_array ( $args [$index] )) {
				$this->container->whereIn [strtolower ( $keyWord )] = $args [$index];
			} else {
				$this->container->where [strtolower ( $keyWord )] = $args [$index];
			}
		}
	}
	private function setPrimaryKeyWhere($args) {
		if (! empty ( $this->model->primaryKey ) && ! empty ( $args [0] )) {
			if (is_array ( $args [0] )) {
				$this->container->whereIn [$this->model->primaryKey] = $args [0];
			} else {
				$this->container->where [$this->model->primaryKey] = $args [0];
			}
		}
	}
	private function checkArgs($args, $key = 0) {
		if (empty ( $args [$key] ))
			return false;
		return true;
	}
	private function checkArgsError($args, $key = 0) {
		if (empty ( $args [$key] ))
			throw new EasyModelException ( 'args error' );
		return true;
	}
	private function showTable() {
		foreach ( $this->container->showTable as $showTable ) {
			if (! isset ( $this->container->columns [$showTable] ))
				$this->container->columns [$showTable] = [ 
						'*' 
				];
		}
		return $this;
	}
	private function setLastKey($keyWord) {
		if (isset ( $this->lastKey [$keyWord] )) {
			$this->container->format = $this->lastKey [$keyWord];
			if ($keyWord === 'T') {
				$this->container->treeConfig = $this->model->config;
				$this->container->key = isset($this->model->config['id']) ? $this->model->config['id'] : 'id';
			}elseif($keyWord === 'K'){
				$this->container->key = $this->model->primaryKey ? $this->model->primaryKey : 'id';
			}
			return true;
		}
		return $keyWord;
	}
	/**
	 * 设置默认的column条件
	 */
	private function setDefaultColumn() {
		if (! $this->container->columns) {
			if ($this->container->type === 'single') {
				$this->container->columns = [ 
						'*' 
				];
			} else {
				foreach ( $this->container->tables as $table ) {
					$this->container->columns [$table] = [ 
							'*' 
					];
				}
			}
		}
		return $this;
	}
	
	/**
	 * 设置默认的where条件
	 */
	private function setDefaultWhere($args) {
		if (! $this->container->where) {
			if ($this->container->type == 'single') {
				if (isset ( $args [0] ) && $this->model->primaryKey)
					$this->container->where = [ 
							$this->model->primaryKey => $args [0] 
					];
			} else {
				
				foreach ( $this->container->tables as $index => $table ) {
					if (isset ( $args [0] ) && $index == 0)
						$this->container->where [$table] = [ 
								$this->container->join [0] [$table] => $args [0] 
						];
				}
			}
		}
		
		return $this;
	}
	
	/**
	 * 设置查询语句
	 * 
	 * @param unknown $resultArr        	
	 * @param unknown $args        	
	 */
	private function setSelectKeyWord($resultArr, $args) {
		$flag = $lastflag = 'get';
		$tempTable = '';
		$getIndex = 0;
		$gets = [ ];
		$lastKeyWord = '';
		
		$config = ( array ) config ( 'easyModel' );
		
		foreach ( $resultArr as $keyWord ) {
			
			if ($keyWord === '')
				continue;
			
			$keyWord = strtolower ( $keyWord );
			
			if ($flag != 'get' && $lastflag == 'get') {
				
				$this->checkGet($gets, $config);
			}
			
			if ($keyWord === 'l') {
				$flag = 'limit';
				continue;
			}
			
			if ($keyWord === 'by') {
				$flag = 'by';
				continue;
			}
			
			if ($flag == 'limit') {
				$this->setLimit ( $keyWord );
			}
			
			if ($flag == 'by') {
				if (! $this->setWhere ( $keyWord, $args )) {
					continue;
				}
			}
			
			if ($flag == 'column') {
				$columnTable = empty ( $columnTable ) ? '' : $columnTable;
				if (! $this->setComplexColumn ( $keyWord, $columnTable )) {
					continue;
				}
			}
			
			if ($flag == 'get') {
				if (! $this->model->table) {
					$gets [] = $keyWord;
					$tempTable = $tempTable ? $tempTable . ',' . strtolower ( $keyWord ) : strtolower ( $keyWord );
					if ($this->getComplexTable ( $tempTable, $config )) {
						$flag = 'column';
					}
				} else {
					$this->container->columns [] = $keyWord;
				}
			}
			$lastflag = $flag;
			$lastKeyWord = $keyWord;
		}
		
		$this->checkGet($gets, $config);
		return $this;
	}
	
	private function checkGet($gets, $config){
		$columns = $this->getComplexTablePice ( $gets, $config );

		if (count ( $columns ) !== count ( $gets )) {
			foreach ( $columns as $col ) {
				$columnTable = empty ( $columnTable ) ? '' : $columnTable;
				if (! $this->setComplexColumn ( $col, $columnTable )) {
					continue;
				}
			}
		} elseif ($this->container->type == 'single') {
			$this->setSingleTableColumn ( $gets );
		}
	}
	
	private function getComplexTablePice($gets, $config) {
		$pops = [ ];
		while ( count($gets) > 1 ) {
			$pic = join ( ',', $gets );
			foreach ( $config as $k => $v ) {
				foreach ( $v as $ka => $va ) {
					if (strpos ( $ka, $pic ) === 0) {
						$this->setComplexTable ( $pic, $config, $k, $v, $ka );
						break 3;
					}
				}
			}
			$pops [] = array_pop ( $gets );
		}
		if(!empty($gets))	
			array_unshift($pops, $gets[0]);
		return $pops;
	}
	
	/**
	 * 设置where
	 * 
	 * @param unknown $keyWord        	
	 * @param unknown $args        	
	 */
	private function setWhere($keyWord, $args) {
		if ($this->container->type == 'single') {
			$this->container->where [$keyWord] = $args [$this->whereIndex];
		} else {
			if (in_array ( $keyWord, $this->container->tables )) {
				$this->whereTable = $keyWord;
				return false;
			}
			if ($this->whereTable) {
				$this->container->where [$this->whereTable] [$keyWord] = $args [$this->argsIndex];
				$this->argsIndex ++;
			}
		}
		$this->whereIndex ++;
		return true;
	}
	
	/**
	 * 设置limit
	 * 
	 * @param unknown $keyWord        	
	 */
	private function setLimit($keyWord) {
		if ($this->limitIndex == 0) {
			$la = explode ( '_', $keyWord );
			if (count ( $la ) == 2) {
				$this->container->skip = $la [0];
				$this->container->take = $la [1];
			} elseif (count ( $la ) == 1) {
				$this->container->take = $la [0];
			}
		}
		$this->limitIndex ++;
	}
	
	/**
	 * 设置复合表列
	 * 
	 * @param unknown $keyWord        	
	 */
	private function setComplexColumn($keyWord, &$columnTable) {
		if (in_array ( $keyWord, $this->container->tables )) {
			$this->container->showTable [] = $columnTable = $keyWord;
			return false;
		}
		if ($columnTable) {
			$this->container->columns [$columnTable] [] = $keyWord;
		}
		return true;
	}
	
	/**
	 * 设置单表的表和列
	 * 
	 * @param unknown $gets        	
	 */
	private function setSingleTableColumn($gets) {
		foreach ( $gets as $gk => $keyWord ) {
			if ($gk == 0) {
				$this->container->tables [] = $keyWord;
			} else {
				$this->container->columns [] = $keyWord;
			}
		}
	}
	
	/**
	 * 检测复合表
	 * 
	 * @param unknown $tempTable        	
	 */
	private function getComplexTable($tempTable, $config) {
		foreach ( $config as $k => $v ) {
			// 检测复合表
			if (isset ( $v [$tempTable] )) {
				return $this->setComplexTable ( $tempTable, $config, $k, $v );
			}
		}
		return false;
	}
	private function setComplexTable($tempTable, $config, $k, $v, $ck = '') {
		$this->container->tables = explode ( ',', $tempTable );
		if ($ck) {
			$this->container->join = array_slice ( $v [$ck], 0, count ( $this->container->tables ) - 1 );
		} else {
			$this->container->join = $v [$tempTable];
		}
		$this->container->type = 'siblings';
		
		if ($k === 'subbing') {
			if ($ck) {
				$this->container->lastKey = $config ['subbing'] [$ck] ['last'];
				$this->container->join = $v [$ck] ['keys'];
			} else {
				$this->container->lastKey = $config ['subbing'] [$tempTable] ['last'];
				$this->container->join = $v [$tempTable] ['keys'];
			}
			$this->container->format = 'SubFormat';
		}
		return true;
	}
	
	/**
	 * 获取表列关系
	 */
	private function fetchColumns() {
		foreach ( $this->container->tables as $table ) {
			$tableInfo = $this->model->getRecords ( "desc {$table}" );
			foreach ( $tableInfo as $info ) {
				$this->container->tableMap [$table] [] = $info ['Field'];
			}
		}
	}
}