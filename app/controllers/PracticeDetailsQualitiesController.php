<?php

class PracticeDetailsQualitiesController extends PracticeDetailsController {
	protected $current_tab = "qualities";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_record_qualities->count()) {
			$form_data = [
					'record_qualities' => RecordQuality::getRecordQualities(),
					'accountant_record_qualities' => [ 
								1 => DB::table('accountant_record_qualities')
									->where('accountant_id', $accountant->id)
									->where('accounting_type_id', 1)
									->lists('percentage', 'record_quality_id'),

								2 => DB::table('accountant_record_qualities')
									->where('accountant_id', $accountant->id)
									->where('accounting_type_id', 2)
									->lists('percentage', 'record_quality_id'),
					],
					'edit'	=> TRUE,
					'route' => 'practicedetails.qualities.update',
					'accountant_id' => $accountant->id,
					'defaults' => $this->getDefaultValues()
			];
		}
		else {
			$form_data = [
					'record_qualities' => RecordQuality::getRecordQualities(),
					'edit'	=> FALSE,
					'route' => 'practicedetails.qualities.store',
					'accountant_id' => $accountant->id,
					'defaults' => $this->getDefaultValues()
			];
		}
			
		$this->layout->content = View::make("pages.practicedetails.qualities", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));
		
		// saving client record_qualities
        if (isset($input['record_qualities'])) {
            foreach ($input['record_qualities'] as $atid => $rq) {
                foreach ($rq as $id => $val) {
                    $data = [
                        'percentage' => $val,
                        'accountant_id' => $accountant->id,
                        'record_quality_id' => $id,
                        'accounting_type_id' => $atid
                    ];

                    $model = new AccountantRecordQuality;
                    $model->create($data);
                }
            }
        }
		
		$route = isset($input['save_next_page']) ? 'practicedetails/audit' : ('practicedetails/' . $this->current_tab);

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Record Qualities.');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		
		AccountantRecordQuality::where('accountant_id', $accountant->id)->delete();
		
		// saving client record_qualities
		foreach ($input['record_qualities'] as $atid => $rq) {
			foreach ($rq as $id => $val) {
				$data = [
					'percentage' => $val,
					'accountant_id' => $accountant->id,
					'record_quality_id' => $id,
					'accounting_type_id' => $atid
				];

				$model = new AccountantRecordQuality;
				$model->create($data);
			}
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/audit' : ('practicedetails/' . $this->current_tab);

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Record Qualities.');
	}

	public function reset($accountant_id)
	{
		AccountantRecordQuality::where('accountant_id', $accountant_id)->delete();
		$defaults = $this->getDefaultValues();

		foreach ($defaults['accounting_types'] as $name => $rq) {
			foreach ($rq as $id => $val) {
				$data = [
						'accountant_id' => $accountant_id,
						'record_quality_id' => RecordQuality::getId($name),
						'accounting_type_id' => $id,
						'percentage' => $val
				];

				$model = new AccountantRecordQuality;
				$model->create($data);
			}
		}
		
		return Redirect::to('practicedetails/qualities')
			->withInput()
			->with('message', 'Accounting System Qualities were reset.');
	}

}
