<?php
namespace App\Repositories;
use Agxmaster\EasyModel\EasyModel;

use App\Models\Menu;

use App\Models\Pirates;

class PiratesRepository {
		
	public function __construct(){
		
	}
	
	
	public function test(){
		
		
		
		
		
		$menu = new Menu();
		$pirates = new Pirates();
		$easy = new EasyModel();
	
		//单表查询示例
// 		$r = $pirates->get(1);
		
		/**
		 * out put
		 * Array
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
			 )
		 )
		 *
		 */
		
// 		$r = $pirates->get(1);
		/**
		 * Array
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
		 */
// 		$r = $pirates->get();
		/**
		 * Array
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
		        )
		
		    [2] => Array
		        (
		            [piratesid] => 3
		            [name] => 娜美
		            [order] => 3
		            [reward] => 20000000
		            [devilnutid] => 0
		            [position] => 航海士
		            [sword] => 1000
		            [fight] => 大棍子
		        )
		
		    [3] => Array
		        (
		            [piratesid] => 4
		            [name] => 罗宾
		            [order] => 4
		            [reward] => 80000000
		            [devilnutid] => 1
		            [position] => 历史学家
		            [sword] => 666666
		            [fight] => 手
		        )
		
		    [4] => Array
		        (
		            [piratesid] => 5
		            [name] => 乔巴
		            [order] => 5
		            [reward] => 20000000
		            [devilnutid] => 1
		            [position] => 船医
		            [sword] => 222222
		            [fight] => 变身
		        )
		
		)
		 */
// 		$r = $pirates->getR(2);
		/**
		 * Array
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
		 */
		
		/**
		 * 用key 做数组下标数据格式
		 * @var unknown
		 */
// 		$r = $pirates->getK(2);
		/**
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
		 */
// 		$r = $pirates->getNameF(2);
		/**
		 * 索罗
		 */
// 		$r = $pirates->getNamePositionL2_2();
		/**
		 * 
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
		 */
// 		$r = $pirates->getNamePositionByDevilnutidL2_1(1);
		/**
		 Array
		(
		    [0] => Array
		        (
		            [name] => 乔巴
		            [position] => 船医
		        )
		
		)
		 */
		
		//多表一对一关系数据结构 需要配置文件
		/**
		 * return [
			'siblings'	=> [
					'pirates,devilnut,devilnuttype' => [
							['pirates'=>'piratesid','devilnut'=>'owner'],
							['devilnuttype'=>'devilnuttypeid','devilnut'=>'devilnuttypeid'],	
					]
			],
			
			'subbing'	=> [
		
			]
		
		];
		 * @var unknown
		 */
// 		$r = $easy->getPiratesDevilnutDevilnuttype();
		/**
		 * Array
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
		 */
		
		/**
		 * 一对多关系数据结构配置
		 * return [
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
		 * @var unknown
		 */
// 		$r = $easy->getPiratesDevilnutDevilnuttype();
		/**
		 * Array
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
		 */
		
		/**
		 * 多表查询带where
		 * @var unknown
		 */
// 		$r = $easy->getPiratesDevilnutDevilnuttypeByPiratespiratesid(1);
		/**
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
		 */
		
		/**
		 * 多表查询指定列并带where条件
		 * @var unknown
		 */
// 		$r = $easy->getPiratesDevilnutDevilnuttypePiratesPiratesidNameDevilnutDevilnuttypeByPiratespiratesid(1);
		/**
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
		 */
		/**
		 * 多表查询 带where条件 带指定列 带limit
		 * @var unknown
		 */
// 		$r = $easy->getPiratesDevilnutDevilnuttypePiratesPiratesidNameDevilnutDevilnuttypeByPiratespiratesidL0_1(1);
		/**
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
		 */
		
		/**
		 * 配置文件可以继承 列前匹配规则
		 * @var unknown
		 */
// 		$r = $easy ->getPiratesDevilnutL0_1();
		/**
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
		 */
		
		
		print_r($r);
		//无限分类格式数据 示例 1
// 		$r = $menu -> getMenuidParentidMenu_nameT();
		//无限分类格式数据 示例 2
// 		$r = $menu -> getT();
		
		/**
		 * out put
		 * Array
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
		 */
		
		
		
		
	}
	
	
	public function test1(){	
		
		$menu = new Menu();
		
		$r = $menu -> getMenuidParentidMenu_nameT();
	
		$easyModel = new EasyModel();
		$easyModel->setT_enrollment(['enrollmentid' => null]);
		$easyModel->setT_enrollment(
			['data' => [
					'studentid'	=>	1	
				],
				'where'	=>	[
						'enrollmentid' => 1,
						['studentid' , '>' , 1]
				],
				'in'	=>	[
						'enrollmentid' => [1,2]
				]
			
			]
		);
		
		$easyModel->dropT_enrollment([
				'enrollmentid' => 1
		]);
		
// 		$easyModel->dropT_enrollmentEnrollmentid(1);
		$this->queueModel -> dropEnrollmentid(1);
		
		// 		//通过主键获取一个表全部字段
// 		$r = $this->queueModel -> getEnrollmentidL1F();
// 		$r = $this->queueModel -> getEnrollmentidL1R();
// 		print_r($r);
// 		//通过主键获取一个表全部字段
// 		$r = $this->queueModel -> get(5043);
// 		print_r($r);
// 		//通过主键获取一个表多个字段
// 		$r= $this->queueModel -> getStudentidEnrollmentid(5043);
// 		print_r($r);
// 		//通过某个字段获取一个表多个字段
// 		$r = $this->queueModel -> getStudentidEnrollmentidByStudentidL0_10(251021);
// 		print_r($r);
// 		//查询T_student join T_enrollment 表  id = 2 limit 0,2
// 		$r = $easyModel->getT_studentT_enrollmentL0_1(2,[
// 				'table'		=>	[
// 						't_student','t_enrollment'
// 				],
// 				'column'	=>	[
// 						't_student'		=>	['studentid'],
// 						't_enrollment'	=>	['enrollmentid'],
// 				],
// 				'where'		=>	[
// 						't_student'	=>	['studentname'	=>	'0']
// 				],
// 				'whereIn'		=>	[
// 						't_student'	=>	['studnetid' =>	'0']
// 				],
// 				'join'		=>	[
// 						['t_student' => 'studentid','t_enrollment'=>'studentid']		
// 				],
// 				'order' 	=>	[
// 						't_student'		=> 	['studnetid'],
// 						't_enrollment'	=>	['studentid']
// 				],
// 				'order' 	=>	[
// 						't_student'		=> 	['studnetid']
// 				],
// 				'limit'		=>	[1,3],
// 				'count'		=>	[
// 						't_studnetid'	=>	[]
// 				]
// 		]);
		
		$r = $easyModel->getT_studentT_enrollmentL0_1(2,[
				'table'		=>	[
						't_student','t_enrollment'
				],
				'column'	=>	[
						't_student'		=>	['studentid'],
						't_enrollment'	=>	['enrollmentid'],
				],
				'where'		=>	[
						't_student'	=>	['studentname'	=>	'0']
				],
				'whereIn'		=>	[
						't_student'	=>	['studentid' =>	'0']
				],
				'join'		=>	[
						['t_student' => 'studentid','t_enrollment'=>'studentid' ,'J' => 'left']
				],
				'order' 	=>	[
						't_student'		=> 	['studentid'],
						't_enrollment'	=>	['studentid']
				],
				'group' 	=>	[
						't_student'		=> 	['studentid']
				],
				'limit'		=>	[1,3],
				'count'		=>	[
						't_studnet'	=>	['studentid']
				]
		]);

// 		$r = $easyModel->get(1,[
// 				'table'	=>	't_student',
// 				'column'	=>	['*'],
// 				'where'		=>	['studentid' => '2'],
// 				'order'		=>	['studentid'=>'desc'],
// 				'group'		=>	['studentid'],
// 				'limit'		=>	[1,2]
// 		]);
// 		print_r($r);
// 		$r = $easyModel->getT_studentT_enrollmentT_enrollqueueL0_1(2);
// 		print_r($r);
		
// 		$r = $easyModel->getT_studentT_enrollmentByT_enrollmentEnrollmentidL0_1(5190);
// 		print_r($r);
// 		$r = $easyModel->getT_studentT_enrollmentT_enrollmentStudentidEnrollmentidClazzidT_studentByT_enrollmentClazzidL0_2(4017);
// 		print_r($r);
// 		$r = $easyModel->getT_studentT_enrollmentT_enrollmentStudentidEnrollmentidClazzidT_studentStudentidByT_enrollmentClazzidL0_3(4017);
		print_r($r);
	}
}