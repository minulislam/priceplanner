<?php

class BaseController extends Controller {

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;

	protected $layout = 'layout.base';
	protected $user = NULL;

	/**
	 * Initializer.
	 *
	 */
	public function __construct()
	{
		$this->session = App::make('session');
		$this->redirect = App::make('redirect');
		$this->view = App::make('view');
		$this->request = App::make('request');
		$this->validator = App::make('validator');
		$this->user = Sentry::getUser();

		// @todo: move this to config, start or global
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->messageBag = new Illuminate\Support\MessageBag;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		/** Start adding styles  **/
		Asset::container('header')->add('bootstrap-css', 'plugins/bootstrap/css/bootstrap.min.css');
		Asset::container('header')->add('fontawesome-css', 'plugins/font-awesome/css/font-awesome.min.css');
		Asset::container('header')->add('sb-admin-css', 'css/base/sb-admin.css');
		Asset::container('header')->add('notify-css', 'css/base/notify.css');
	
		if ($this->layout != 'layout.auth' && $this->layout != 'layout.subscribe') {
			Asset::container('header')->add('datepicker-css', 'plugins/datepicker/css/datepicker.css');
			Asset::container('header')->add('bootstrap-notify-master-css', 'plugins/bootstrap-notify-master/css/bootstrap-notify.css');
			Asset::container('header')->add('datatables-css', 'plugins/datatable/media/css/demo_table.css');
			Asset::container('header')->add('custom-datatable-css', 'plugins/datatable/media/css/custom_datatable.css');
			Asset::container('header')->add('jquery-ui-css', 'plugins/jquery-ui/css/jquery-ui.css');
		}
		else {
			Asset::container('header')->add('auth-css', 'css/auth/auth.css');
			Asset::container('header')->add('the-big-picture-css', 'css/auth/the_big_picture.css');
		}

		/** End adding styles  **/



		/** Start adding javascripts  **/
		Asset::container('footer')->add('jquery', 'js/core/jquery-1.10.2.min.js');
		Asset::container('footer')->add('jquery-ui-1.9.2-js', 'plugins/jquery-ui/js/jquery-ui-1.9.2.custom.min.js');
		Asset::container('footer')->add('bootstrap-js', 'plugins/bootstrap/js/bootstrap.min.js');

		if ($this->layout != 'layout.auth') {
			Asset::container('footer')->add('angular-js', 'js/core/angular.js');
			Asset::container('footer')->add('datepicker-js', 'plugins/datepicker/js/bootstrap-datepicker.js');
			Asset::container('footer')->add('bootstrap-notify-master-js', 'plugins/bootstrap-notify-master/js/bootstrap-notify.js');
			Asset::container('footer')->add('jquery-dataTables-js', 'plugins/datatable/media/js/jquery.dataTables.js');
			Asset::container('footer')->add('numeric-input-js', 'js/core/numericInput.min.js');
		}
		/** End adding javascripts  **/

		if (Sentry::check()) {
			View::share('current_clients', PracticeProClient::getAllCurrentClients());
		}

		View::share('user', $this->user);

		$this->layout = View::make($this->layout);
	}
	
	protected function getDefaultCountryId() 
	{
		$result = DB::connection('practicepro_users')->select("SELECT id as country_id FROM countries WHERE country_code='GB'");
		return $result[0]->country_id;
	}

	public function sendEmailSupport()
	{
		$data = Input::all();
		$user = $this->user->practiceProUser();
		$subject = $data['subject'];
		Mail::send('emails.support', ['msg' => $data['msg']], function($message) use ($user, $subject)
		{
			$message->to(
				//'dixie.atay@gmail.com', 
				'support@practicepro.co.uk', 
				'Support Team'
			)->subject('Price Planner Pro - ' . $subject);

			$message->from($user->mh2_email, sprintf("%s %s", $user->mh2_fname, $user->mh2_lname));
		});
		
		return Redirect::back()->with(['msg', 'You have successfully sent your message to support team.']);
	}

}
