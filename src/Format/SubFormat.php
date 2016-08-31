<?php
namespace Agxmaster\EasyModel\Format;

use Agxmaster\EasyModel\Format\AbastractFormat;

class SubFormat extends AbastractFormat{
	
	public function __construct($container){
		parent::__construct($container);
	}
	
	public function format($result){
		
		$returnData = $keys = [];	
		foreach($this->container->tables as $index => $table){
			if($index == 0) continue;
			$keys[] = array_values($this->container->join[$index -1])[1];
		}
		if($this->container->lastKey){
			$keys[] = $this->container->lastKey;
		}
		foreach($result as $record){
			$this->getTreeResult($record, $keys, count($keys), $returnData);
		}
		return $returnData;
	}
	
	public function getTreeResult($record,$keys,$count,&$returnData,$i = 0){
		if ($i < ($count)){
			
			if(in_array('*',$this->container->columns[$this->container->tables[$i]])){
				$this->container->columns[$this->container->tables[$i]] = $this->container->tableMap[$this->container->tables[$i]];
			}
			
			foreach($record as $k => $v){
				if(in_array($k,$this->container->columns[$this->container->tables[$i]])){
					$returnData[$record[$keys[$i]]][$k] = $v;
				}
			}
			$this->getTreeResult($record, $keys, $count, $returnData[$record[$keys[$i]]]['child'], $i + 1);
		}
	}
	
}