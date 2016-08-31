# EasyModel

* Automatic query generation <br>
* 目前只支持laravel 框架 后续可通过扩展 ModelInterface 进行各种支持 <br>


##example 文档细节繁琐可以直接看例子

定义一个model 继承EasyModel
```php
namespace App\Models;

use Agxmaster\EasyModel\EasyModel;
class Pirates extends EasyModel
{
    public $table  = 'pirates';
    public $primaryKey = 'piratesid';
}
```

定义仓库
```php

namespace App\Repositories;
use Agxmaster\EasyModel\EasyModel;
use App\Models\Menu;
use App\Models\Pirates;

class PiratesRepository
{
	function test(){
		$menu = new Menu();
		$pirates = new Pirates();
		$easy = new EasyModel();
	}
}
```
以下实例都在仓库中

##查询示例

#### 1.使用model单表根据主键查询
	所有的查询开头必须是get后面接各种参数
	get后面不接参数但是方法传参会用model里面primaryKey属性查询
```php
$r = $pirates->get(1);
```
output:

```php
 Array
 (
	 [0] => Array
	 (
	 [piratesid] => 1
	 [name] => 路飞
	 [order] => 1
	 [reward] => 2147483647
	 [devilnutid] => 1
	 [position] => 船长
	 [sword] => 999999
	 [fight] => 橡胶jet、橡胶图章
	 )
 )
```
### 2.单表查询全部
	get后面不接参数方法不传参查全表数据
```php
$r = $pirates->get();
```
output:

```php
Array
(
    [0] => Array
        (
            [piratesid] => 1
            [name] => 路飞
            [order] => 1
            [reward] => 2147483647
            [devilnutid] => 1
            [position] => 船长
            [sword] => 999999
            [fight] => 橡胶jet、橡胶图章
        )

    [1] => Array
        (
            [piratesid] => 2
            [name] => 索罗
            [order] => 2
            [reward] => 2000000000
            [devilnutid] => 0
            [position] => 武士、杂工
            [sword] => 888888
            [fight] => 三刀流
        ),
        ...
)
```

### 3.单表查询全部返回一维数组数据
	方法的最后一个字母用来代表格式
	方法名大写字母R结尾代表取一维数组
```php
$r = $pirates->getR(2);
```
output:

```php
 Array
(
    [piratesid] => 2
    [name] => 索罗
    [order] => 2
    [reward] => 2000000000
    [devilnutid] => 0
    [position] => 武士、杂工
    [sword] => 888888
    [fight] => 三刀流
)
```

### 4.单表查询返回二维数组用主键做数组下标
	方法名大写字母K结尾代表这种数据结构
```php
$r = $pirates->getK(2);
```
output:

```php
 Array
(
    [2] => Array
        (
            [piratesid] => 2
            [name] => 索罗
            [order] => 2
            [reward] => 2000000000
            [devilnutid] => 0
            [position] => 武士、杂工
            [sword] => 888888
            [fight] => 三刀流
        )

)
```

### 5.单表查询获取一个字段
	方法名大写字母F结尾代表这种数据结构
	在用model做查询时必须定义两个属性primaryKey、table 例如上面的 Pirates
	在用model做查询时get后面直接想接的是字段比如 要查询 name、age两个字段 getNameAge()

```php
$r = $pirates->getNameF(2);
```
output:

```php
索罗
```

### 6.单表查询带limit
	L关键字代表limit L2_2 代表 limit 2,2, L2 代表 limit 2
```php
$r = $pirates->getNamePositionL2_2();
```
output:

```php
Array
(
    [0] => Array
        (
            [name] => 娜美
            [position] => 航海士
        )

    [1] => Array
        (
            [name] => 罗宾
            [position] => 历史学家
        )

)
```
### 7.单表带where条件查询
	By关键字后面接的是查询条件
```php
$r = $pirates->getNamePositionByDevilnutidL2_1(1);
```
output:

```php
Array
(
    [0] => Array
        (
            [name] => 乔巴
            [position] => 船医
        )

)
```

##多表查询示例
	写easymodel的目的有几个
	1.方便查询数据可以避开建立model和写简单sql这种枯燥无味的工作
	2.最求书写的流畅，写一段代码很不情愿停下来去做另一段代码
	多表查询会有点变态方法名略长，如果不喜欢文档后面有传参方式替代

###建立多表配置文件config/easyModel.php
	silbings 表示一对一的关联关系这种配置查询出的数据没有层级关系
	subbing  表示一对多的关联关系这种配置有层级关系 last为生成最后一层数据的key
	先看一对一关系的查询
```php
return [
	'siblings'	=> [
 			'pirates,devilnut,devilnuttype' => [
 					['pirates'=>'piratesid','devilnut'=>'owner'],
 					['devilnuttype'=>'devilnuttypeid','devilnut'=>'devilnuttypeid'],
 			]
	]
];
```

### 1.一对一关系多表查询
	get后面直接接多个表名 如果多个表在配置文件中能找到怎返回结果
```php
$r = $easy->getPiratesDevilnutDevilnuttype();
```
output:

```php
Array
(
    [0] => Array
        (
            [piratesid] => 1
            [name] => 路飞
            [order] => 1
            [reward] => 2147483647
            [devilnutid] => 1
            [position] => 船长
            [sword] => 999999
            [fight] => 橡胶jet、橡胶图章
            [devilnuttypeid] => 1
            [devilnutname] => 橡胶果实
            [color] => 橡胶果实..
            [owner] => 1
            [devilnutdescript] => 黄色
            [devilnuttyptename] => 超人系
            [devilnuttypedescript] => 超人系....
        )

    [1] => Array
        (
            [piratesid] => 4
            [name] => 罗宾
            [order] => 4
            [reward] => 80000000
            [devilnutid] => 2
            [position] => 历史学家
            [sword] => 666666
            [fight] => 手
            [devilnuttypeid] => 1
            [devilnutname] => 花花果实
            [color] => 花花果实..
            [owner] => 4
            [devilnutdescript] => 黄色
            [devilnuttyptename] => 超人系
            [devilnuttypedescript] => 超人系....
        )
)
```

### 一对多数据查询修改config/easyModel.php
```php
return [
		'siblings'	=> [
// 				'pirates,devilnut,devilnuttype' => [
// 						['pirates'=>'piratesid','devilnut'=>'owner'],
// 						['devilnuttype'=>'devilnuttypeid','devilnut'=>'devilnuttypeid'],
// 				]
		],

		'subbing'	=> [
				'pirates,devilnut,devilnuttype' => [
					'keys' =>[
							['pirates'=>'piratesid','devilnut'=>'owner'],
							['devilnuttype'=>'devilnuttypeid','devilnut'=>'devilnuttypeid']
					],
					'last' => 'devilnuttypeid'
			]

		]

];
```

### 2.一对多关系多表查询
	get后面直接接多个表名如果多个表在配置文件中能找到怎返回结果
```php
$r = $easy->getPiratesDevilnutDevilnuttype();
```
output:
```php
Array
(
    [1] => Array
        (
            [piratesid] => 1
            [name] => 路飞
            [order] => 1
            [reward] => 2147483647
            [devilnutid] => 4
            [position] => 船长
            [sword] => 999999
            [fight] => 橡胶jet、橡胶图章
            [child] => Array
                (
                    [1] => Array
                        (
                            [devilnutid] => 1
                            [devilnuttypeid] => 1
                            [devilnutname] => 橡胶果实
                            [color] => 橡胶果实..
                            [owner] => 1
                            [devilnutdescript] => 黄色
                            [child] => Array
                                (
                                    [1] => Array
                                        (
                                            [devilnuttypeid] => 1
                                            [devilnuttyptename] => 超人系
                                            [devilnuttypedescript] => 超人系....
                                            [child] =>
                                        )

                                )

                        )

                    [3] => Array
                        (
                            [devilnutid] => 4
                            [devilnuttypeid] => 3
                            [devilnutname] => 火火果实
                            [color] => 火火果实..
                            [owner] => 1
                            [devilnutdescript] => 红色
                            [child] => Array
                                (
                                    [3] => Array
                                        (
                                            [devilnuttypeid] => 3
                                            [devilnuttyptename] => 自然系
                                            [devilnuttypedescript] => 自然系....
                                            [child] =>
                                        )

                                )

                        )

                )

        )

    [4] => Array
        (
            [piratesid] => 4
            [name] => 罗宾
            [order] => 4
            [reward] => 80000000
            [devilnutid] => 2
            [position] => 历史学家
            [sword] => 666666
            [fight] => 手
            [child] => Array
                (
                    [1] => Array
                        (
                            [devilnutid] => 2
                            [devilnuttypeid] => 1
                            [devilnutname] => 花花果实
                            [color] => 花花果实..
                            [owner] => 4
                            [devilnutdescript] => 黄色
                            [child] => Array
                                (
                                    [1] => Array
                                        (
                                            [devilnuttypeid] => 1
                                            [devilnuttyptename] => 超人系
                                            [devilnuttypedescript] => 超人系....
                                            [child] =>
                                        )

                                )

                        )

                )

        )

    [5] => Array
        (
            [piratesid] => 5
            [name] => 乔巴
            [order] => 5
            [reward] => 20000000
            [devilnutid] => 3
            [position] => 船医
            [sword] => 222222
            [fight] => 变身
            [child] => Array
                (
                    [2] => Array
                        (
                            [devilnutid] => 3
                            [devilnuttypeid] => 2
                            [devilnutname] => 人人果实
                            [color] => 人人果实..
                            [owner] => 5
                            [devilnutdescript] => 蓝色
                            [child] => Array
                                (
                                    [2] => Array
                                        (
                                            [devilnuttypeid] => 2
                                            [devilnuttyptename] => 动物系
                                            [devilnuttypedescript] => 动物系....
                                            [child] =>
                                        )

                                )

                        )

                )

        )

)
```

### 3.多表带where条件
	By后面接表名然后接表的字段
	如有User、Group两张表 User表有Name、age字段则可写为 getUserGroupByUserNameAge('agx','28')
```php
$r = $easy->getPiratesDevilnutDevilnuttypeByPiratespiratesid(1);
```
output:
```php
 Array
(
    [1] => Array
        (
            [piratesid] => 1
            [name] => 路飞
            [order] => 1
            [reward] => 2147483647
            [devilnutid] => 4
            [position] => 船长
            [sword] => 999999
            [fight] => 橡胶jet、橡胶图章
            [child] => Array
                (
                    [1] => Array
                        (
                            [devilnutid] => 1
                            [devilnuttypeid] => 1
                            [devilnutname] => 橡胶果实
                            [color] => 橡胶果实..
                            [owner] => 1
                            [devilnutdescript] => 黄色
                            [child] => Array
                                (
                                    [1] => Array
                                        (
                                            [devilnuttypeid] => 1
                                            [devilnuttyptename] => 超人系
                                            [devilnuttypedescript] => 超人系....
                                            [child] =>
                                        )

                                )

                        )

                    [3] => Array
                        (
                            [devilnutid] => 4
                            [devilnuttypeid] => 3
                            [devilnutname] => 火火果实
                            [color] => 火火果实..
                            [owner] => 1
                            [devilnutdescript] => 红色
                            [child] => Array
                                (
                                    [3] => Array
                                        (
                                            [devilnuttypeid] => 3
                                            [devilnuttyptename] => 自然系
                                            [devilnuttypedescript] => 自然系....
                                            [child] =>
                                        )

                                )

                        )

                )

        )

)
```

### 4.多表查询指定列
	get后面接多表然后接需要查询的表然后接该表的多个字段
	如果查某表全部字段则可只写表名后面不接该表字段
	虽然很长但是写着很爽
	如有User、Group两张表User表有Name、age字段Group表有 groupid字段则可写为 getUserGroupUserNameAgeGroupGroupid('agx','28')
```php
$r = $easy->getPiratesDevilnutDevilnuttypePiratesPiratesidNameDevilnutDevilnuttypeByPiratespiratesid(1);
```
output:
```php
  Array
(
    [1] => Array
        (
            [piratesid] => 1
            [name] => 路飞
            [child] => Array
                (
                    [1] => Array
                        (
                            [devilnutid] => 1
                            [devilnuttypeid] => 1
                            [devilnutname] => 橡胶果实
                            [color] => 橡胶果实..
                            [owner] => 1
                            [devilnutdescript] => 黄色
                            [child] => Array
                                (
                                    [1] => Array
                                        (
                                            [devilnuttypeid] => 1
                                            [devilnuttyptename] => 超人系
                                            [devilnuttypedescript] => 超人系....
                                            [child] =>
                                        )

                                )

                        )

                    [3] => Array
                        (
                            [devilnutid] => 4
                            [devilnuttypeid] => 3
                            [devilnutname] => 火火果实
                            [color] => 火火果实..
                            [owner] => 1
                            [devilnutdescript] => 红色
                            [child] => Array
                                (
                                    [3] => Array
                                        (
                                            [devilnuttypeid] => 3
                                            [devilnuttyptename] => 自然系
                                            [devilnuttypedescript] => 自然系....
                                            [child] =>
                                        )

                                )

                        )

                )

        )

)
```
### 5.多表查询带limit
```php
$r = $easy->getPiratesDevilnutDevilnuttypePiratesPiratesidNameDevilnutDevilnuttypeByPiratespiratesidL0_1(1);
```
output:
```php
Array
(
    [1] => Array
        (
            [piratesid] => 1
            [name] => 路飞
            [child] => Array
                (
                    [1] => Array
                        (
                            [devilnutid] => 1
                            [devilnuttypeid] => 1
                            [devilnutname] => 橡胶果实
                            [color] => 橡胶果实..
                            [owner] => 1
                            [devilnutdescript] => 黄色
                            [child] => Array
                                (
                                    [1] => Array
                                        (
                                            [devilnuttypeid] => 1
                                            [devilnuttyptename] => 超人系
                                            [devilnuttypedescript] => 超人系....
                                            [child] =>
                                        )

                                )

                        )

                )

        )

)
```

### 5.多表查询配置继承
	比如配置里面有 a,b,c 则对 a b表查询则可用该项配置
```php
$r = $easy ->getPiratesDevilnutL0_1();
```
output:
```php
 Array
(
    [1] => Array
        (
            [piratesid] => 1
            [name] => 路飞
            [order] => 1
            [reward] => 2147483647
            [devilnutid] => 1
            [position] => 船长
            [sword] => 999999
            [fight] => 橡胶jet、橡胶图章
            [child] => Array
                (
                    [1] => Array
                        (
                            [devilnutid] => 1
                            [devilnuttypeid] => 1
                            [devilnutname] => 橡胶果实
                            [color] => 橡胶果实..
                            [owner] => 1
                            [devilnutdescript] => 黄色
                            [child] =>
                        )

                )

        )

)
```

###无限分类数据查询
	需要在model里面定义 config属性

###定义model Menu.php
```php
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
```
### 1.获取无限分类数据
	尾字母大写T代表这种数据格式
```php
$r = $easy ->getMenuidParentidMenu_nameT();
```
output:
```php
 Array
(
    [9bc0436b-ee7d-30a1-b691-8d940a6d4d2c] => Array
        (
            [menuid] => 9bc0436b-ee7d-30a1-b691-8d940a6d4d2c
            [parentid] => 000
            [menu_name] => 咨询管理
            [child] => Array
                (

                    [44817bcc-06a1-3d35-ada2-897e530980de] => Array
                        (
                            [menuid] => 44817bcc-06a1-3d35-ada2-897e530980de
                            [parentid] => 9bc0436b-ee7d-30a1-b691-8d940a6d4d2c
                            [menu_name] => 添加反馈
                        )

                    [6b7eb83a-5c67-30ff-a1a9-28f943abbd11] => Array
                        (
                            [menuid] => 6b7eb83a-5c67-30ff-a1a9-28f943abbd11
                            [parentid] => 9bc0436b-ee7d-30a1-b691-8d940a6d4d2c
                            [menu_name] => 审批流程
                            [child] => Array
                                (
                                    [95382146-c970-32cd-b6fb-fcbb1eb1dfda] => Array
                                        (
                                            [menuid] => 95382146-c970-32cd-b6fb-fcbb1eb1dfda
                                            [parentid] => 6b7eb83a-5c67-30ff-a1a9-28f943abbd11
                                            [menu_name] => 我的审批流程
                                        )

                                    [e837d650-692b-3725-bb58-51f2c4808957] => Array
                                        (
                                            [menuid] => e837d650-692b-3725-bb58-51f2c4808957
                                            [parentid] => 6b7eb83a-5c67-30ff-a1a9-28f943abbd11
                                            [menu_name] => 我发起的流程
                                        )

                                )

                        )

       		 )

		)
)
```


#### 通过参数生成sql

#### 单表查询
```php
$r = $easy->get([
						'table'	=>	'pirates',
						'column'	=>	['*'],
						'where'		=>	['piratesid' => '2'],
						'order'		=>	['piratesid'=>'desc'],
						'group'		=>	['piratesid'],
						'limit'		=>	[1,2]
				]);
```

#### 多表查询
```php
$r = $easy->get([
				'table'		=>	[
						'pirates','devilnut'
				],
				'column'	=>	[
						'pirates'		=>	['piratesid','name'],
						'devilnut'		=>	['devilnutid','devilnutname'],
				],
				'where'		=>	[
						'pirates'	=>	['piratesid'	=>	'1']
				],
				'in'		=>	[
						'pirates'	=>	['piratesid' => [1,2]]
				],
				'join'		=>	[
						['pirates' => 'piratesid','devilnut'=>'owner' ,'J' => 'left']
				],
				'order' 	=>	[
						'pirates'		=> 	['piratesid'],
						'devilnut'	=>	['devilnutid']
				],
				'group' 	=>	[
						'pirates'		=> 	['piratesid']
				],
				'limit'		=>	[1,3],
				'count'		=>	[
						'pirates'	=>	['piratesid']
				]
		]);
```

#### 删除操作
```php
$easy->dropPirates([
		'piratesid' => 5
]);

$pirates->dropPiratesid(5);
$pirates->drop(5);
```

#### update操作
* update 的时候set后面必须接表名

```php
$easy->setPirates(
		['data' => [
				'Piratesid'	=>	8
		],
				'where'	=>	[
						'Piratesid' => 6,
						['Piratesid' , '>' , 5]
				],
				'in'	=>	[
						'Piratesid' => [5]
				]
					
]);

```

#### insert操作
```php
$pirates->set(['Piratesid' => null]);
$easy->setPirates(['Piratesid' => null]);
```
## 接口文档

### 获取实例

    1. 直接获取实例:
        $easyModel = new EasyModel();

    2. model继承EasyModel
        class Queue extends EasyModel

        在model 里面可以定义属性
            pulbic $table           //表名
            public $primaryKey      //主键名

        * 这种方式如果定义了属性table则只能进行单表操作

###关键字

####操作类型关键字 get/set/drop

    * 操作类型关键字必须在方法的开头
    * get 代表查询
    * set 代表update/insert
    * drop 代表删除

####表关键字

    1.通过继承的并且定义了table属性的方法中不能包含表名
    2.需要多表操作的需要在配置文件中定义 config/easyModel.php

####列关键字
    1.在表名后面和查询关键字By前面首字母大写

####条件关键字

    1.如果有By关键字会优先使用By之后首字母大写的字符串作为查询条件
    2.如果没有By则使用parmaryKey属性
    3.如果没有parmaryKey属性则使用table属性+id作为条件
    4.多表的where是By之后Table1 +Column1+Column2 + Table2+Column3...
    5.多表的whereBy之后Table1 没有跟Column则去此表全部数据

####limit关键字
    1.L1_2/L1

####数据格式关键字
    * 关键字位于方法最后
    1.T 无限分类结构
    2.K
####配置文件


```PHP
<?php
array(
		'siblings' => array(

				//a,b,c代表三个表关联操作
				//getABC()/getAB()都可以匹配到该条配置 getBC()/getAC/getBAC无法匹配

				'a,b,c'	=>	array(
						array('a'	=>	'id' , 'b'	=>	'aid'),
						array('b'	=>	'id' , 'c'	=>	'bid')
				)
		)
);

```
