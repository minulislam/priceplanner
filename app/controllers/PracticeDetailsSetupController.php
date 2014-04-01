<?php

class PracticeDetailsSetupController extends PracticeDetailsController {
	protected $current_tab = "setup";
	
	public function index() 
	{
		if ($this->user->accountant) {
			$accountant = $this->user->accountant;

			$form_data = [
					'accountant' => $accountant->getAttributes(),
					'edit'	=> TRUE,
					'has_fee_levels' => $accountant->hasOne('AccountantBusinessType')->getResults(),
					'route' => 'practicedetails.setup.update',
					'accountant_id' => $accountant->id
			];
		}
		else {
			$form_data = [
					'accountant' => [],
					'edit'	=> FALSE,
					'route' => 'practicedetails.setup.store',
			];
		}
		
		$this->layout->content = View::make("pages.practicedetails.setup", $form_data);
	}
	
	public function store()
	{
		$input = Input::all();
		
		$validation = Validator::make($input, Accountant::$rules);
		if ($validation->passes()) {
			$input['user_id']  = $this->user->id;
			$input['last_tab'] = 'setup';

			$accountant = new Accountant;
			$accountant = $accountant->create($input);

			if ($input['logo_filename']) { 
				//Upload the file
				$filename = $input['accountant_name'] . '_logo_' . $accountant->id;
				$input['logo_filename']->move(public_path() . '/uploads', $filename);
				$accountant->update(['logo_filename' => $filename]);
			}

		}
		else {
			return Redirect::route('practicedetails.setup')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}
		
		$route = isset($input['save_next_page']) ? 'practicedetails/businesstypes' : 'practicedetails/setup';

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully started setting up your account details.');

		
	}

	public function update()
	{
		$input = Input::all();

		$validation = Validator::make($input, Accountant::$rules);
		if ($validation->passes()) {
			
			$accountant = Accountant::find($input['id']);

			if ($input['logo_filename']) { 
				//Upload the file
				$filename = $input['accountant_name'] . '_logo_' . $accountant->id;
				$input['logo_filename']->move(public_path() . '/uploads', $filename);
				$input['logo_filename'] = $filename;
			}
			else {
				unset($input['logo_filename']);
			}
		
			$accountant->update($input);
		}
		else {

			return Redirect::route('practicedetails.setup')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.' . $validation->errors());

		}

		$route = isset($input['save_next_page']) ? 'practicedetails/businesstypes' : 'practicedetails/setup';

		return Redirect::to($route)
			->withInput()
			->with('message', 'You have successfully updated your account details.');
	}

}