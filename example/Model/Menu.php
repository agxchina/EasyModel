<?php
namespace App\Models;

use Agxmaster\EasyModel\EasyModel;
class Menu extends EasyModel
{
    public $table  = 't_menu';
    
   	public $config = [
   			'top' 	=> 		'000',
   			'id'	=>		'menuid',
   			'parentid'	=>	'parentid',
   			'sort'		=>	'sort',
   	];   
}