@extends('admin.layouts.master')
@section('content')



		
<div class="container">
			<div class="d-flex justify-content-between mb-3 flex-wrap">
				<div class="d-flex">
					<div class="arw-back">
						<a href="{{ url('/admin/sales-report') }}"><span class="fas fa-chevron-left"></span></a>
					</div>
					<div class="tkt-heading-wrapper">
						<h2 class="heading mb-0">VIP Tickets</h2>
						<div>
							<span class="med-14 tkt-sold">Ticket Sold : 500</span>
							<span class="med-14 tkt-sales">Total Sales : 1.5 Lacs</span>
						</div>
					</div>
				</div>
				<div class="s-box">
					<div class="search-wrapper">
						<input type="search" class="form-control ticket-search" placeholder="Search Here..">
						<button type="submit" class="btn btn-search">Search</button>
					</div>
				</div>
			</div>


			<div class="card p-3 mb-3">
				<div class="d-flex justify-content-between mb-2 flex-wrap">
					<div class="toggle-btn-text d-flex align-items-center">
						<span class="med-14">Search Emails by</span>
						<div class="button-switch">
							<input type="checkbox" id="switch-blue" class="switch" checked />
							<label for="switch-blue" class="lbl-off">Any</label>
							<label for="switch-blue" class="lbl-on">All</label>
						</div>
						<span class="med-14">Of the following</span>
					</div>
					<div class="btns-box">
						<button type="button" class="btn btn-light"><span class="fas fa-times"></span> Clear</button>
						<button type="button" class="btn btn-main">Search</button>
					</div>
				</div>
				<div class="d-flex filter-drops flex-wrap">
					<div class="dropdown dropdown-date">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							Dates
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> Till Date</a>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Day</a>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Week</a>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Month</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Custom</a>
						</div>
					</div>
					<div class="dropdown dropdown-date">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							Between
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> Till Date</a>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Day</a>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Week</a>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Month</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Custom</a>
						</div>
					</div>
					<div class="dropdown dropdown-date show-date">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							2022/06/21 - 2022/06/24 <img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg">
						</button>
					</div>
				</div>
				<div class="btn-add-filter pt-3">
					<button type="button" class="btn btn-transparent">+ Add Filter</button>
				</div>
			</div>




			<!-- Tickets Table -->
			<div class="row">
				<div class="col-md-12">
					<div class="table-scroller">

										<table class="table table-hover tickets-table">
											<thead>
												<tr>
													<th>#</th>
													<th>Parent Attendee</th>
													<th>Total Qty</th>
													<th>Amount Collected</th>
													<th>Payment Gateway</th>
													<th>Order ID from Gateway</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
													<td><button class="btn btn-default btn-chev"><span class="fas fa-caret-down"></span></button></td>
													<td>Himanshu</td>
													<td>2</td>
													<td>1000</td>
													<td>Razorpay</td>
													<td>#854785</td>
													<td><span class="completed">Completed</span></td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/send_icon.svg')}}"> Send</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/deactivate_icon.svg')}}"> Refund</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/download_icon.svg')}}"> Download</a>
													  </div>
													</div>
													</td>
												</tr>

												<tr class="accordion-row">
													<td class="hiddenRow"></td>
													<td colspan="12" class="hiddenRow">
														<div class="accordian-body collapse" id="demo1"> 
															<table class="table table-inner">
																<tbody>
															<tr>
																<td><strong>Ticket Type:</strong> Free</td>
																<td><strong>Ticket Name:</strong> Basic</td>
																<td><strong>Quantity Purchased:</strong> 1</td>
																<td><strong>Amount:</strong> 0</td>
															</tr>
															<tr>
																<td><strong>Ticket Type:</strong> Free</td>
																<td><strong>Ticket Name:</strong> Basic</td>
																<td><strong>Quantity Purchased:</strong> 1</td>
																<td><strong>Amount:</strong> 0</td>
															</tr>
													</tbody>
												</table>
											</div> 
										</td>
									</tr>
									<tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
													<td><button class="btn btn-default btn-chev"><span class="fas fa-caret-down"></span></button></td>
													<td>Himanshu</td>
													<td>2</td>
													<td>1000</td>
													<td>Razorpay</td>
													<td>#854785</td>
													<td><span class="failed">Failed</span></td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/send_icon.svg')}}"> Send</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/deactivate_icon.svg')}}"> Refund</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/download_icon.svg')}}"> Download</a>
													  </div>
													</div>
													</td>
												</tr>

												<tr class="accordion-row">
													<td class="hiddenRow"></td>
													<td colspan="12" class="hiddenRow">
														<div class="accordian-body collapse" id="demo2"> 
															<table class="table table-inner">
																<tbody>
															<tr>
																<td><strong>Ticket Type:</strong> Free</td>
																<td><strong>Ticket Name:</strong> Basic</td>
																<td><strong>Quantity Purchased:</strong> 1</td>
																<td><strong>Amount:</strong> 0</td>
															</tr>
															<tr>
																<td><strong>Ticket Type:</strong> Free</td>
																<td><strong>Ticket Name:</strong> Basic</td>
																<td><strong>Quantity Purchased:</strong> 1</td>
																<td><strong>Amount:</strong> 0</td>
															</tr>
													</tbody>
												</table>
											</div> 
										</td>
									</tr>


									<tr data-toggle="collapse" data-target="#demo3" class="accordion-toggle">
													<td><button class="btn btn-default btn-chev"><span class="fas fa-caret-down"></span></button></td>
													<td>Himanshu</td>
													<td>2</td>
													<td>1000</td>
													<td>Razorpay</td>
													<td>#854785</td>
													<td><span class="pending">Pending</span></td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/send_icon.svg')}}"> Send</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/deactivate_icon.svg')}}"> Refund</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/download_icon.svg')}}"> Download</a>
													  </div>
													</div>
													</td>
												</tr>

												<tr class="accordion-row">
													<td class="hiddenRow"></td>
													<td colspan="12" class="hiddenRow">
														<div class="accordian-body collapse" id="demo3"> 
															<table class="table table-inner">
																<tbody>
															<tr>
																<td><strong>Ticket Type:</strong> Free</td>
																<td><strong>Ticket Name:</strong> Basic</td>
																<td><strong>Quantity Purchased:</strong> 1</td>
																<td><strong>Amount:</strong> 0</td>
															</tr>
															<tr>
																<td><strong>Ticket Type:</strong> Free</td>
																<td><strong>Ticket Name:</strong> Basic</td>
																<td><strong>Quantity Purchased:</strong> 1</td>
																<td><strong>Amount:</strong> 0</td>
															</tr>
													</tbody>
												</table>
											</div> 
										</td>
									</tr>


									<tr data-toggle="collapse" data-target="#demo4" class="accordion-toggle">
													<td><button class="btn btn-default btn-chev"><span class="fas fa-caret-down"></span></button></td>
													<td>Himanshu</td>
													<td>2</td>
													<td>1000</td>
													<td>Razorpay</td>
													<td>#854785</td>
													<td><span class="refunded">Refunded</span></td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/send_icon.svg')}}"> Send</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/deactivate_icon.svg')}}"> Refund</a>
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/download_icon.svg')}}"> Download</a>
													  </div>
													</div>
													</td>
												</tr>

												<tr class="accordion-row">
													<td class="hiddenRow"></td>
													<td colspan="12" class="hiddenRow">
														<div class="accordian-body collapse" id="demo4"> 
															<table class="table table-inner">
																<tbody>
															<tr>
																<td><strong>Ticket Type:</strong> Free</td>
																<td><strong>Ticket Name:</strong> Basic</td>
																<td><strong>Quantity Purchased:</strong> 1</td>
																<td><strong>Amount:</strong> 0</td>
															</tr>
															<tr>
																<td><strong>Ticket Type:</strong> Free</td>
																<td><strong>Ticket Name:</strong> Basic</td>
																<td><strong>Quantity Purchased:</strong> 1</td>
																<td><strong>Amount:</strong> 0</td>
															</tr>
													</tbody>
												</table>
											</div> 
										</td>
									</tr>



									
								</tbody>
							</table>


		</div>
	</div>
</div>




</div>





@endsection


