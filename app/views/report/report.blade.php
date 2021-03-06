<table style="border: 1px solid white;">
	<tr>
		@if ($accountant->logo_filename  && file_exists('uploads/' . $accountant->logo_filename))
		<td width="200px;">
			<img style="width: 150px; height: 60px; float: left;" src="{{ asset('uploads/' . $accountant->logo_filename) }}"/>
		</td>
		<td width="680px;">
			<p style="float:right;" class="text-right"><h4>{{ $accountant->accountancy_name }}</h4></p>
		</td>
		@else
		<td width="650px;">
			<h4>{{ $accountant->accountancy_name }}</h4>
		</td>
		@endif
	</tr>
	<tr>
		<td width="650px;"></td>
	</tr>
	<tr>
		<td width="650px;">
			<div class="header text-center">Fixed Price Fee Quotation</div>
		</td>
	</tr>
</table>
<div class="report-container">
	<p>
		<b>Business Name:</b> {{ $client->business_name }}
	</p>
	<p>
		<b>Proprietors/Owners:</b> {{ $client->client_name }}
	</p>
	<p>
		<b>Accounting Period:</b> {{ $client->accounting_period }}
	</p>
	<p>
		<b>Anticipated Turnover:</b> {{ NumFormatter::money($pricing->turnovers, '&pound;') }}
	</p>
		<p>
			To prevent any misunderstanding, this Fixed Price Fee Quotation defines the services <span class="emphasize">{{ $accountant->accountancy_name }}</span> will perform for you.
			Your current service level will be <span class="num-val">{{ NumFormatter::money($calc->total_monthly_cost, '£') }} + VAT per month</span>.
		</p>
		<p>
			This includes:
			<ol>
				<li>All general accountancy compliance work as requested</li>
				@foreach ($calc->modules as $module)
					@if ($module->value)
						<li>{{ $module->name }} will be {{ NumFormatter::money($module->value, '£') }} + VAT per month</li>
					@endif
				@endforeach
				<li>
					Additional Services
					<ul>
					@foreach ($calc->other_services as $other_service)
						@if ($other_service->value)
							<li>{{ $other_service->name }} will be at {{ NumFormatter::money($other_service->value, '£') }} + VAT per month.</li>
						@endif
					@endforeach
					</ul>
				</li>
			</ol>
		</p>
		<table class="table" style="line-height: 21.4333px">
			<tbody>
				<tr>
					<td>Net Fee</td><td class="num-val">{{ NumFormatter::money($calc->total_annual_fee, '£') }}</td>
				</tr>
				<tr>
					<td>VAT at current rates ~ 20%</td><td class="num-val">{{ NumFormatter::money($calc->total_annual_fee_tax, '£') }}</td>
				</tr>
				<tr style="background-color: #ECF0F1; color: black;">
					<td>Total Annual Professional Services stated above</td>
					<td class="num-val">{{ NumFormatter::money($calc->taxed_total_annual_fee, '£') }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div>
		<p>In order to assist with your business cash flow, we have the following payment option available:
			<ul>
				<li>
					Option 1 – Monthly standing order: <span class="num-val">{{ NumFormatter::money($calc->taxed_total_monthly_cost, '£') }}</span>
				</li>
			</ul>
		</p>
		<p>
			This quotation is valid for 21 days. The minimum fee payable under this agreement will be an amount equal to 25% of the annual charge.
		</p>
	</div>
	<div>
		Guarantees and Safeguards
		<p>
			To make sure that our arrangement continues to be fair to both parties, we will meet throughout the year and, if necessary, change the scope of services to be provided and the prices to be charged in light of mutual experience.
		</p>
		<p>
			In addition, either party may terminate the Agreement at any time, for any reason, by giving 10 days written notice. Any services that have not been paid for at that time will then be settled in full within 10 days.
		</p>
		<p>
			If you are in agreement to this quotation please sign, date and return this agreement.
		</p>
		<p>
		</p>
		<p>
			Signed: ________________________<br><br>
			Date: __________
		</p>
	</div>

</div>
</div> {{-- .header --}}
