@extends('admin.layouts.admin')
@section('content')
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="">
				<div class="">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">

						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject"> User Payment Details </span>
							</div>
						</div>


						<div class="portlet-body" id="user-section">
							<span class="response_status"></span>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<tbody>
										<tr>
											<th>Name</th>
											<td>{{$payment_details->name}}<td>
										</tr>
										<tr>
											<th>Email</th>
											<td>{{$payment_details->email}}<td>
										</tr>
										<tr>
											<th>Phone</th>
											<td>+91 {{$payment_details->phone}}<td>
										</tr>
										<tr>
											<th>State</th>
											<td>{{$payment_details->state}}<td>
										</tr>
										<tr>
											<th>City</th>
											<td>{{$payment_details->city}}<td>
										</tr>
										<tr>
											<th>Gender</th>
											<td>{{$payment_details->Gender}}<td>
										</tr>
										<tr>
											<th colspan="2"><strong>Payment Details</strong></th>
										</tr>
										<tr>
											<th>Amount</th>
											<td>{{$payment_details->amount}}<td>
										</tr>
										<tr>
											<th>Payment Method</th>
											<td>{{$payment_details->payment_method}}<td>
										</tr>
										<tr>
											<th>Order ID</th>
											<td>{{$payment_details->order_id}}<td>
										</tr>
										<tr>
											<th>Payment ID</th>
											<td>{{$payment_details->paymentDetails['razorpay_payment_id']}}<td>
										</tr>
										<tr>
											<th>Payment Method</th>
											<td>{{$payment_details->paymentDetails['payment_method']}}<td>
										</tr>
										<tr>
											<th>Card ID</th>
											<td>{{$payment_details->paymentDetails['card_id']}}<td>
										</tr>
										<tr>
											<th>Bank</th>
											<td>{{$payment_details->paymentDetails['bank']}}<td>
										</tr>
										<tr>
											<th>Wallet</th>
											<td>{{$payment_details->paymentDetails['wallet']}}<td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>



			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END CONTENT -->


@endsection