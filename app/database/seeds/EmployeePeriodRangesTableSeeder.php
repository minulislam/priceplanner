<?php

class EmployeePeriodRangesTableSeeder extends Seeder {

	public function run()
	{
		$periods = [
			'weekly' => 1,
			'forthnightly' => 2,
			'four_weekly' => 3,
			'monthly' => 4,
			'annually' => 5,
		];

		$ranges = [
			'0' => 1,
			'1' => 2,
			'2-5' => 3,
			'6-10' => 4,
			'11-19' => 5,
			'20-24' => 6,
			'25-29' => 7,
			'30-34' => 8,
			'35-39' => 9,
			'40-49' => 10,			
			'50+' => 11
		];

		$values = [
			'weekly' => [ 
				'0' => 0,
				'1' => 25,	
				'2-5' => 35,
				'6-10' => 45,	
				'11-19' => 55,
				'20-24' => 65,
				'25-29' => 75,
				'30-34' => 85,
				'35-39' => 100,
				'40-49' => 125,
				'50+' => 'POA',
			],
			'forthnightly' => [ 
				'0' => 0,
				'1' => 25,	
				'2-5' => 35,
				'6-10' => 45,	
				'11-19' => 55,
				'20-24' => 65,
				'25-29' => 75,
				'30-34' => 85,
				'35-39' => 100,
				'40-49' => 125,
				'50+' => 'POA',
			],
			'four_weekly' => [ 
				'0' => 0,
				'1' => 35,	
				'2-5' => 45,
				'6-10' => 55,	
				'11-19' => 65,
				'20-24' => 75,
				'25-29' => 85,
				'30-34' => 100,
				'35-39' => 125,
				'40-49' => 150,
				'50+' => 'POA',
			],
			'monthly' => [ 
				'0' => 0,
				'1' => 35,	
				'2-5' => 45,
				'6-10' => 55,	
				'11-19' => 65,
				'20-24' => 75,
				'25-29' => 85,
				'30-34' => 100,
				'35-39' => 125,
				'40-49' => 150,
				'50+' => 'POA',
			],
			'annually' => [ 
				'0' => 0,
				'1' => 50,	
				'2-5' => 100,
				'6-10' => 250,	
				'11-19' => 500,
				'20-24' => 1000,
				'25-29' => 1500,
				'30-34' => 2500,
				'35-39' => 3000,
				'40-49' => 4000,
				'50+' => 'POA',
			],
		];
		
		$data = [];

		foreach ($values as $pid => $pval) {
			foreach ($pval as $rid => $val) {
				$data[] = [
					'range_id' => $ranges[$rid],
					'period_id' => $periods[$pid],
					'value'	=> $val
				];
			}
		}
		DB::table('employee_period_ranges')->insert($data);
		
	}

}
