<?php
namespace Agxmaster\EasyModel\Database;

interface ModelInterface
{
	public function getPdo();
	
	/**
	 * 执行查询sql
	 * @param unknown $sql
	 * @param array $params
	 */
	public function getRecords($sql , $params = []);
	
	/**
	 * 查询
	 * @param unknown $config
	 */
	public function formselect($config);
	
	/**
	 * 插入
	 * @param unknown $config
	 */
	public function formInsert($config);
	
	/**
	 * 插入返回id
	 * @param unknown $config
	 */
	public function formInsertGetId($config);
	
	/**
	 * 更新
	 * @param unknown $config
	 */
	public function formUpdate($config);
	
	/**
	 * 删除
	 * @param unknown $config
	 */
	public function formDelete($config);
	
}
