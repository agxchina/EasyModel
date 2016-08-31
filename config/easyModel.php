<?php
return [
		'siblings'	=> [
				't_student,t_enrollment,t_enrollqueue' => [
						['t_student'=>'studentid','t_enrollment'=>'studentid'],
						['t_enrollment'=>'enrollment','t_enrollqueue'=>'enrollqueueid'],	
				]
		],
		'subbing'	=> [
				't_student,t_enrollment' => [
					'keys' =>[
							['t_student'=>'studentid','t_enrollment'=>'studentid', 'J' => 'left']
					],
					'last' => 'enrollmentid'
			]
				
		]
		
];