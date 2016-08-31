<?php
namespace Agxmaster\EasyModel\Format;

use Agxmaster\EasyModel\Format\AbastractFormat;
use Agxmaster\EasyModel\Format\IndexBeKey;

class Tree extends AbastractFormat{
	
	private $id = 'id';
	
	private $parentid = 'parentid';
	
	private $child = 'child';
	
	private $top = '0';
	
	private $indexBeKey = null;
	
	public function __construct($container){
		$this->indexBeKey = new IndexBeKey($container);
		parent::__construct($container);
	}
	
	public function format($result){
		
		$this->setKeyWord();
		$result = $this->indexBeKey->format($result);
		foreach ($result as $item)
			$result[$item[$this->parentid]][$this->child][$item[$this->id]] = &$result[$item[$this->id]];
		return isset($result[$this->top][$this->child]) ? $result[$this->top][$this->child] : array();
	}
	
	public function setKeyWord(){
		$this->id = isset($this->container->treeConfig['id']) ? $this->container->treeConfig['id'] : $this->id;
		$this->parentid = isset($this->container->treeConfig['parentid']) ? $this->container->treeConfig['parentid'] : $this->parentid;
		$this->child = isset($this->container->treeConfig['child']) ? $this->container->treeConfig['child'] : $this->child;
		$this->top = isset($this->container->treeConfig['top']) ? $this->container->treeConfig['top'] : $this->top;
	}
	
}