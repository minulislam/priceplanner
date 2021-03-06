<?php

class PracticeDetailsBusinessTypeController extends PracticeDetailsController {
	protected $current_tab = "businesstypes";
	
	public function index() 
	{
		Asset::container('footer')->add('pages-feeplanner-js', 'js/pages/feeplanner.js');
		$accountant = $this->user->accountant;
		
		if ($accountant->accountant_business_types->count()) {
			$form_data = [
					'business_types' => BusinessType::getBusinessTypes(),
					'accountant_business_types' => DB::table('accountant_business_types')
									->where('accountant_id', $accountant->id)
									->lists('base_fee', 'business_type_id'),
					'edit'	=> TRUE,
					'route' => 'practicedetails.businesstypes.update',
					'accountant_id' => $accountant->id,
					'defaults' => $this->getDefaultValues()
			];
		}
		else {
			$form_data = [
					'business_types' => BusinessType::getBusinessTypes(),
					'edit'	=> FALSE,
					'route' => 'practicedetails.businesstypes.store',
					'accountant_id' => $accountant->id,
					'defaults' => $this->getDefaultValues()
			];
		}
			
		$this->layout->content = View::make("pages.practicedetails.businesstypes", $form_data);
	}

	public function store()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;
		$accountant->update(array('last_tab' => $this->current_tab));
		
		// saving accountant business_types
		foreach ($input['business_types'] as $id => $val) {
			$data = [
				'base_fee' => $val,
				'accountant_id' => $accountant->id,
				'business_type_id' => $id
			];
			$model = new AccountantBusinessType;
			$model->create($data);
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/ranges' : 'practicedetails/businesstypes';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Types of Business.');
	}

	public function update()
	{
		$input = Input::all();
		$accountant = $this->user->accountant;

		AccountantBusinessType::where('accountant_id', $accountant->id)->delete();

		// saving accountant business_types
		foreach ($input['business_types'] as $id => $val) {
			$data = [
				'base_fee' => $val,
				'accountant_id' => $accountant->id,
				'business_type_id' => $id
			];
			$model = new AccountantBusinessType;
			$model->create($data);
		}
 			

		$route = isset($input['save_next_page']) ? 'practicedetails/ranges' : 'practicedetails/businesstypes';

		return Redirect::to($route)
			->withInput()
			->with('message', 'Successfully saved Types of Business.');
	}

	public function reset($accountant_id)
	{
		AccountantBusinessType::where('accountant_id', $accountant_id)->delete();
		$defaults = $this->getDefaultValues();

		// saving accountant business_types
		foreach ($defaults['business_types'] as $id => $val) {
			$data = [
				'base_fee' => $val,
				'accountant_id' => $accountant_id,
				'business_type_id' => $id
			];
			$model = new AccountantBusinessType;
			$model->create($data);
		}
		
		return Redirect::to('practicedetails/businesstypes')
			->withInput()
			->with('message', 'Types of Business were reset.');
	}

}
