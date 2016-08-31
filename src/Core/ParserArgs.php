<?php

namespace Agxmaster\EasyModel\Core;

use Agxmaster\EasyModel\Exception\EasyModelException;

class ParserArgs {
	private $container = null;
	private $args = [ ];
	public function __construct($container) {
		// $this->model = $model;
		$this->container = $container;
	}
	public function parserRequest($args) {
		$this->args = $args;
		$this->setTable ()->setColumn ()->setJoin ()->setWhere ()->setWhereIn ()->setOrder ()->setGroup ()->setLimit () -> setCount()->setData ();
	}
	private function setTable() {
		if (isset ( $this->args ['table'] )) {
			$this->container->type = count ( $this->args ['table'] ) == 1 ? 'single' : 'siblings';
			$this->container->tables = ! is_array ( $this->args ['table'] ) ? [ 
					$this->args ['table'] 
			] : $this->args ['table'];
		}
		return $this;
	}
	private function setColumn() {
		if (isset ( $this->args ['column'] )) {
			$this->container->columns = $this->args ['column'];
		}
		return $this;
	}
	private function setData() {
		if (isset ( $this->args ['data'] )) {
			$this->container->data = $this->args ['data'];
		} else {
			$this->container->data = $this->args;
		}
		return $this;
	}
	private function setWhere() {
		if (isset ( $this->args ['where'] ) && is_array ( $this->args ['where'] )) {
			foreach ( $this->args ['where'] as $table => $where ) {
				$this->container->where [$table] = isset ( $this->container->where [$table] ) ? $where + $this->container->where [$table] : $where;
			}
		} elseif ($this->container->action == 'delete') {
			$this->container->where = $this->args;
		}
		return $this;
	}
	private function setWhereIn() {
		if (isset ( $this->args ['in'] ) && is_array ( $this->args ['in'] )) {
			foreach ( $this->args ['in'] as $table => $where ) {
				$this->container->whereIn [$table] = isset ( $this->container->whereIn [$table] ) ? $where + $this->container->whereIn [$table] : $where;
			}
		} elseif ($this->container->action == 'delete') {
			$this->container->whereIn = $this->args;
		}
		return $this;
	}
	private function setOrder() {
		if (isset ( $this->args ['order'] )) {
			$this->container->order = $this->args ['order'];
		}
		return $this;
	}
	private function setGroup() {
		if (isset ( $this->args ['group'] )) {
			$this->container->group = $this->args ['group'];
		}
		return $this;
	}
	private function setCount() {
		if (isset ( $this->args ['count'] )) {
			$this->container->count = $this->args ['count'];
		}
		return $this;
	}
	private function setJoin() {
		if (isset ( $this->args ['join'] )) {
			$this->container->join = $this->args ['join'];
		}
		return $this;
	}
	private function setLimit() {
		if (isset ( $this->args ['limit'] )) {
			if (count ( $this->args ['limit'] ) == 1) {
				$this->container->take = $this->args ['limit'] [0];
			} elseif (count ( $this->args ['limit'] ) >= 2) {
				$this->skip = $this->args ['limit'] [0];
				$this->container->take = $this->args ['limit'] [1];
			}
		}
		return $this;
	}
}