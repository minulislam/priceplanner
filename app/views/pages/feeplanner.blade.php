@section('title')
Fee Planner
@stop

@section('page_title')
Fee Planner
@stop

@section('app_nav')
	<nav id="app-nav" class="navbar navbar-default" role="navigation">
	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
	      <li class=""><a href="{{ url('setup/edit/' . $client_id) }}">Setup</a></li>
	      <li class="active"><a href="#">Fee Planner</a></li>
	    </ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
@stop

@section('content')
    <div class="panel panel-default">
	<div class="panel-heading">
		Fee Planner
	</div>
	<div class="panel-body" ng-app="PPApp">
	{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'bs-example form-horizontal', 'ng-controller' => 'PPCtrl')) }}
		{{  Form::hidden('pricing[client_id]', $client_id) }}
		@if ($edit)
			{{  Form::hidden('pricing[id]', $pricing['id']) }}
		@endif	
		<table class="table table-striped">
			<tr>
				<td class="text-right col-legend emphasize">
					Type of Business
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[business_type_id]', $select_data['business_types'], $pricing['business_type_id'], [
						'class' => 'form-control input-sm',
						//'ng-model' 	=> 'E5', 
						//'ng-init' 	=> "E5='{$pricing['business_type_id']}'", 
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Turnover
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::text('pricing[turnovers]', $pricing['turnovers'], array(
						'class' => 'form-control input-sm',
						'required' => 'required',
						'ng-model' 	=> 'E7', 
						'ng-init' 	=> "E7='{$pricing['turnovers']}'", 
						'numbers-only'	=> 'numbers-only',
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Type of Records
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[accounting_type_id]', $select_data['record_types'], $pricing['accounting_type_id'], [
						'class' => 'form-control input-sm',
						//'ng-model' 	=> 'E7', 
						//'ng-init' 	=> "E7='{$pricing['turnover']}'", 
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Quality of Records
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[record_quality_id]', $select_data['record_qualities'], $pricing['record_quality_id'], [
						'class' => 'form-control input-sm',
						//'ng-model' 	=> 'E9', 
						//'ng-init' 	=> "E9='{$pricing['record_quality_id']}'", 
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Requirements
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[audit_requirement_id]', $select_data['audit_requirements'], $pricing['audit_requirement_id'], [
						'class' => 'form-control input-sm',
						//'ng-model' 	=> 'E13', 
						//'ng-init' 	=> "E13='{$pricing['audit_requirement_id']}'", 
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Audit Risk
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select(
						'pricing[audit_risk_id]', $select_data['audit_risks'], $pricing['audit_risk_id'], [
						'class' => 'form-control input-sm',
						//'ng-model' 	=> 'E15', 
						//'ng-init' 	=> "E15='{$pricing['audit_risk_id']}'", 
					]);
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Corporate Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select('pricing[corporate_tax_return]', [1 => 'Yes', 0 => 'No'], $pricing['corporate_tax_return'], array(
						'class' => 'form-control input-sm', 
						//'ng-model' 	=> 'E18', 
						//'ng-init' 	=> "E18='{$pricing['corporate_tax_return']}'", 
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Partnership Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::select('pricing[partnership_tax_return]', [1 => 'Yes', 0 => 'No'], $pricing['partnership_tax_return'], array(
						'class' => 'form-control input-sm', 
						//'ng-model' 	=> 'E19', 
						//'ng-init' 	=> "E19='{$pricing['partnership_tax_return']}'", 
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend">
					Self-Assessment Tax Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::text('pricing[self_assessment_tax_return]',$pricing['self_assessment_tax_return'], array(
						'class' => 'form-control input-sm', 
						'ng-model' 	=> 'E20', 
						'ng-init' 	=> "E20='{$pricing['self_assessment_tax_return']}'", 
						'numbers-only'	=> 'numbers-only',
						'required'	=> 'required',
						'placeholder'	=> 'qty',
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					VAT Returns
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				{{   
					Form::text('pricing[vat_return]',$pricing['vat_return'], array(
						'class' => 'form-control input-sm', 
						'ng-model' 	=> 'E22', 
						'ng-init' 	=> "E22='{$pricing['vat_return']}'", 
						'numbers-only'	=> 'numbers-only',
						'required'	=> 'required',
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Book Keeping <br>
					<em style="font-weight: normal;">if we do the book keeping don't forget to adjust the quality of records</em>
				</td>
				<td class="col-extra">
				<div class="pull-right">
					{{   
						Form::text('pricing[bookkeeping_hours]',$pricing['bookkeeping_hours'], array(
							'class' => 'form-control input-sm', 
							'ng-model' 	=> 'C24', 
							'ng-init' 	=> "C24='{$pricing['bookkeeping_hours']}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
							'style'	=> 'width: 50px;',
							'placeholder' => 'hrs'
						));
						
					}}
				</div>
				<br>
				<br>
				&nbsp;
				<div class="pull-right">
					{{   
						Form::text('pricing[bookkeeping_days]',$pricing['bookkeeping_days'], array(
							'class' => 'form-control input-sm', 
							'ng-model' 	=> 'C25', 
							'ng-init' 	=> "C25='{$pricing['bookkeeping_days']}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
							'style'	=> 'width: 50px;',
							'placeholder' => 'days'
						));
						
					}}
				</div>
				</td>
				<td class="col-val">
				<div class="">
					{{   
						Form::text('pricing[bookkeeping_hour_val]',$pricing['bookkeeping_hour_val'], array(
							'class' => 'form-control input-sm', 
							'ng-model' 	=> 'E24', 
							'ng-init' 	=> "E24='{$pricing['bookkeeping_hour_val']}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
							'placeholder' => 'amount'
						));
						
					}}
				</div>
				<div style="padding-top: 10px;">
					{{   
						Form::text('pricing[bookkeeping_day_val]',$pricing['bookkeeping_day_val'], array(
							'class' => 'form-control input-sm', 
							'ng-model' 	=> 'E25', 
							'ng-init' 	=> "E25='{$pricing['bookkeeping_day_val']}'", 
							'numbers-only'	=> 'numbers-only',
							'required'	=> 'required',
							'placeholder' => 'amount'
						));
						
					}}
				</div>
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Payroll
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Employee
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<?php $num = 30; ?>
			@foreach($periods as $id => $period)
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td class="col-extra">
					{{ $period }}
				</td>
				<td class="col-val">
				<?php $num = $num + 1; ?>
				{{   
					Form::select("employee_payroll_pricings[{$id}][range_id]", $select_data['ranges'], $employee_period_ranges[$id]['range_id'], array(
						'class' => 'form-control input-sm', 
						//'ng-model' 	=> 'E' . $num, 
						//'ng-init' 	=> "E{$num}='{$employee_period_ranges[$id]['range_id']}'", 
					));
					
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			@endforeach
			<tr>
				<td class="text-right col-legend emphasize">
					Subcontractors
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<?php $num = 38; ?>
			@foreach($periods as $id => $period)
			@if ($period == 'Weekly' || $period == 'Monthly')
			<tr>
				<td class="text-right col-legend emphasize">
				</td>
				<td class="col-extra">
					{{ $period }}
				</td>
				<td class="col-val">
				<?php $num = $num + 1; ?>
				{{   
					
					Form::select("sc_payroll_pricings[{$id}][range_id]", $select_data['ranges'], $sc_period_ranges[$id]['range_id'], array(
						'class' => 'form-control input-sm', 
						//'ng-model' 	=> 'E' . $num, 
						//'ng-init' 	=> "E{$num}='{$sc_period_ranges[$id]['range_id']}'", 
					));
					
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			@endif
			@endforeach
			<tr>
				<td class="text-right col-legend emphasize">
					Modules
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<?php $num = 41; ?>
			@foreach($modules as $id => $module)
			<tr>
				<td class="text-right col-legend">
					{{ $module }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				<?php $num = $num + 1; ?>
				{{   
					Form::select("module_pricings[{$id}]", [1 => 'Yes', 0 => 'No'], $module_pricings[$id], array(
						'class' => 'form-control input-sm', 
						//'ng-model' 	=> 'E' . $num, 
						//'ng-init' 	=> "E{$num}=''", 
					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			@endforeach
			<tr>
				<td class="text-right col-legend emphasize">
					Other Services
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<?php $num = 47; ?>
			@foreach($other_services as $id => $other_service)
			<tr>
				<td class="text-right col-legend">
					{{ $other_service }}
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				<?php $num = $num + 1; ?>
				{{   
					Form::text("other_service_pricings[{$id}]", $other_service_pricings[$id], array(
						'class' => 'form-control input-sm', 
						'ng-model' 	=> 'E' . $num, 
						'numbers-only'	=> 'numbers-only',
						'required'	=> 'required',
						'placeholder'	=> 'qty',

					));
				}}
				</td>
				<td class="col-total">
				</td>
			</tr>
			@endforeach
			<tr>
				<td class="text-right col-legend emphasize">
					Annual Fee
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Monthly Cost
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Discount
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Total Annual Fee
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
			<tr>
				<td class="text-right col-legend emphasize">
					Total Monthly Cost
				</td>
				<td class="col-extra">
				</td>
				<td class="col-val">
				</td>
				<td class="col-total">
				</td>
			</tr>
		</table>
		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-info btn-save" type="submit" name="save_next_page" id="save_next_page">Save & Download</button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
    </div>
@stop
