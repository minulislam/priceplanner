<?php

class Accountant extends \Eloquent {

	protected $fillable = [
		'user_id',
		'accountant_name',
		'accountancy_name',
		'address',
		'logo_filename',
		'last_tab'
	];

	public static $rules = array(
		'accountant_name' => 'required',
		'accountancy_name' => 'required',
		'address'	=> 'required',
		'logo_filename'	=> 'image|max:1500'
	);
	
	public function accountantBusinessTypes ()
	{
		return $this->hasMany('AccountantBusinessType');
	}
	
	public function accountantTurnoverRanges ()
	{
		return $this->hasMany('AccountantTurnoverRange');
	}
	
	public function accountantRecordQualities ()
	{
		return $this->hasMany('AccountantRecordQuality');
	}
	
	public function accountantAuditRequirements ()
	{
		return $this->hasMany('AccountantAuditRequirement');
	}
	
	public function accountantAuditRisks ()
	{
		return $this->hasMany('AccountantAuditRisk');
	}
	
	public function accountantTaxReturns ()
	{
		return $this->hasMany('AccountantTaxReturn');
	}
	
	public function accountantEmployeePeriodRanges() 
	{
		return $this->hasMany('AccountantEmployeePeriodRange');
	}
	
	public function accountantModules() 
	{
		return $this->hasMany('AccountantModule');
	}

	public function accountantBookkeeping() 
	{
		return $this->hasMany('AccountantBookkeeping');
	}
}
