<?php
namespace Agxmaster\EasyModel;

class Container{
	
	//查询的相关表
	public $tables = [];
	
	//查询的列
	public $columns = [];
	
	//where条件
	public $where = [];
	
	//主键
	public $primaryKey = '';
	
	//从第几条开始取
	public $skip = 0;
	
	//取数长
	public $take = 0;
	
	//表和字段映射关系
	public $tableMap = null;

	public $type = 'single';
	
	//多表操纵的相应配置信息
	public $join = [];
	
	//是否执行成功
	public $status = true;
	
	//错误信息
	public $errorMessage = '';
	
	//多表时查询的表
	public $showTable = [];
	
	public $lastKey = '';
	
	//数据操作类型
	public $action = 'select';
	
	//格式化类
	public $format = '';
	
	public $order = [];
	
	public $group = [];
	
	public $count = '';
	
	public $data = [];
	
	public $whereIn = [];
	
	//树形结构配置文件
	public $treeConfig = [];
	
	public $key = [];

	public $tempPicTable = [];
		
}