@extends('admin.layouts.master')
@section('content')



<div class="container">
			<div class="d-flex justify-content-between mb-3 flex-wrap">
				<div class="d-flex">
						<h2 class="heading mb-0">Email Builder</h2>
				</div>
				<div class="s-box">
					<div class="search-wrapper">
					<input type="search" class="form-control ticket-search" placeholder="Search Here..">
					<button type="submit" class="btn btn-search">Search</button>
				</div>
				</div>
			</div>


			




			<!-- Tickets Table -->
			<div class="row">
				<div class="col-md-12">
					<div class="table-scroller">

										<table class="table table-hover tickets-table email-builder-table">
											<thead>
												<tr>
													<th>#</th>
													<th>Name</th>
													<th>Last Updated on</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<tr>
													<td>1</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>2</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>3</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>4</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>5</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>1</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>6</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>7</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>8</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
													</div>
													</td>
												</tr>
												<tr>
													<td>9</td>
													<td>John</td>
													<td>03 Jun 2022 04:31:13</td>
													<td>
							                        	<div class="dropdown ticket-option">
													    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													      <div class="dot-three"></div>
													    </button>
													    <div class="dropdown-menu">
													      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View</a>
													      <a class="dropdown-item" href="{{ url('/admin/edit-email') }}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sampleMailModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/sample_email.svg')}}"> Sample Email</a>
													      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shootCampaignModal"><img class="cal-icon" src="{{ asset('public/admin/assets/images/shoot_campaign.svg')}}"> Shoot Campaign</a>
													  </div>
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


