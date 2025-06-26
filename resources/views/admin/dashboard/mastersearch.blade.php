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


						<div class="portlet-body form search-wrapper" id="filters">
							<form action="{{ route('mastersearch') }}" name="datasearch" method="get">
								{{csrf_field()}}
							    <div class="form-group">
							        <div class="search-inner">
							            <span>Search By:</span>

							            <div class="field-item">

											<div class="input-outer">
											<input type="hidden" name="post_type" value="search">
									        <input type="text" name="search" class="form-control" placeholder="Search" value="">
									        </div>
									        <div class="input-outer">
									        <select name="field" class="form-control">
									        <option value="name">Name</option>
									        <option value="email">Email</option>
									        <option value="phone">Phone</option>
									        <option value="unique_code">Unique Code</option>	
									        </select>
									        </div>
									    </div>

							            <div class="form-actions">
							                <button type="submit" class="btn green"><i class="fa fa-search"></i> Search</button>
							                <a class="btn default" href="{{ route('mastersearch') }}"><i class="fa fa-refresh"></i> Reset</a>
							            </div>

							        </div>
							    </div>
							</form>

						</div>
						<div class="portlet-body" id="user-section">
							<span class="response_status"></span>
							<div class="table-responsive">
								<h4><center>{{'User Data'}}</center></h4>
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th class="table-checkbox"> ID </th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Unique Code</th>
											<th>Festival Dates</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>

									@foreach($data as $key => $value)
										@if(!empty($value['user_data']))
											<tbody>
												@foreach($value['user_data'] as $userdata)
												<tr>
													<td>{{$userdata->id}}</td>
													<td>{{$userdata->name}}</td>
													<td>{{$userdata->email}}</td>
													<td>+91 {{$userdata->phone}}</td>
													<td>{{$userdata->unique_code}}</td>
													<td>{{$userdata->festival_dates}} May 2022</td>
													<td>{{ date('d M Y H:i A', strtotime($userdata->created_at)); }}</td>
													<td>
														@if($userdata->unique_code != '')
														<a class="fa-icon" data-toggle="tooltip" title="" data-original-title="View QR Code" id="view_qrcode" data-qrpath="{{$userdata->qrcode_path}}" data-qrcode="{{$userdata->unique_code}}"><i class="fa fa-eye"></i></a>
														@endif
														@if($userdata->quantity > 1)
															<a class="fa-icon" data-toggle="tooltip" title="" target="_blank" href="{{ route('usermembers') }}/{{ $userdata->id }}" data-original-title="User Members"><i class="fa fa-users"></i></a>
														@endif
														<a class="fa-icon" data-toggle="tooltip" title="" href="javascript:void(0)" onclick="emailUser({{ $userdata->id }})" data-original-title="Resend Email"><i class="fa fa-envelope"></i></a>
														@if(!empty($userdata->payment_id))
															<a class="fa-icon" data-toggle="tooltip" title="" target="_blank" href="{{ route('userpaymentdetails') }}/{{ $userdata->id }}" data-original-title="Payment Details"><i class="fa fa-credit-card"></i></a>
														@endif
													</td>
												</tr>
												@endforeach
											</tbody>
										@endif
									@endforeach
										
								</table>
								<br>
								<h4><center>{{'User Member Data'}}</center></h4>
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th> ID </th>
											<th> User ID </th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Unique Code</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>

									@foreach($data as $key => $value)
										@if(!empty($value['user_members_data']))
											<tbody>
												@foreach($value['user_members_data'] as $usermemberdata)
												<tr>
													<td>{{$usermemberdata->id}}</td>
													<td>{{$usermemberdata->user_id}}</td>
													<td>{{$usermemberdata->name}}</td>
													<td>{{$usermemberdata->email}}</td>
													<td>+91 {{$usermemberdata->phone}}</td>
													<td>{{$usermemberdata->unique_code}}</td>
													<td>{{ date('d M Y H:i A', strtotime($usermemberdata->created_at)); }}</td>
													<td>
														@if($usermemberdata->unique_code != '')
														<a class="fa-icon" data-toggle="tooltip" title="" data-original-title="View QR Code" id="view_qrcode" data-qrpath="{{$usermemberdata->qrcode_path}}" data-qrcode="{{$usermemberdata->unique_code}}"><i class="fa fa-eye"></i></a>
														@endif
														<a class="fa-icon" data-toggle="tooltip" title="" href="javascript:void(0)" onclick="emailMember({{ $usermemberdata->id }})" data-original-title="Resend Email"><i class="fa fa-envelope"></i></a>
													</td>
												</tr>
												@endforeach
											</tbody>
										@endif
									@endforeach
										
								</table>
								<br>
								<h4><center>{{'Invited User'}}</center></h4>
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th class="table-checkbox"> ID </th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Invited BY</th>
											<th>Unique Code</th>
											<th>Festival Dates</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									@foreach($data as $key => $value)
										@if(!empty($value['invited_user']))
											<tbody>
												@foreach($value['invited_user'] as $inviteduser)
												<tr>
													<td>{{$inviteduser->id}}</td>
													<td>{{$inviteduser->name}}</td>
													<td>{{$inviteduser->email}}</td>
													<td>+91 {{$inviteduser->phone}}</td>
													<td>@By {{$inviteduser->invitedBy['name']}}</td>
													<td>{{$inviteduser->unique_code}}</td>
													<td>{{$inviteduser->festival_dates}} May 2022</td>
													<td>{{ date('d M Y H:i A', strtotime($inviteduser->created_at)); }}</td>
													<td>
														<a class="fa-icon" data-toggle="tooltip" title="" href="javascript:void(0)" onclick="emailInvitee({{ $inviteduser->id }})" data-original-title="Resend Email"><i class="fa fa-envelope"></i></a>
														@if($inviteduser->unique_code != '')
															<a class="fa-icon" data-toggle="tooltip" title="" data-original-title="View QR Code" id="view_qrcode" data-qrpath="{{$inviteduser->qrcode_path}}" data-qrcode="{{$inviteduser->unique_code}}"><i class="fa fa-eye"></i></a>
														@endif
													</td>
												</tr>
												@endforeach
											</tbody>
										@endif
									@endforeach
										
								</table>
								<br>
								<h4><center>{{'Interface User'}}</center></h4>
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th class="table-checkbox"> ID </th>
											<th>Interface Category</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Profession</th>
											<th>Unique Code</th>
											<th>Festival Dates</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>
									@foreach($data as $key => $value)
										@if(!empty($value['interface_user']))
											<tbody>
												@foreach($value['interface_user'] as $interfaceuser)
												<tr>
													<td>{{$interfaceuser->id}}</td>
													<td>{{$interfaceuser->userInterfaces['category']}}</td>
													<td>{{$interfaceuser->name}}</td>
													<td>{{$interfaceuser->email}}</td>
													<td>+91 {{$interfaceuser->phone}}</td>
													<td>{{$interfaceuser->profession}}</td>
													<td>{{$interfaceuser->unique_code}}</td>
													<td>{{$interfaceuser->festival_dates}} May 2022</td>
													<td>{{ date('d M Y H:i A', strtotime($interfaceuser->created_at)); }}</td>
													<td>
														@if($interfaceuser->unique_code != '')
															<a class="fa-icon" data-toggle="tooltip" title="" data-original-title="View QR Code" id="view_qrcode" data-qrpath="{{$interfaceuser->qrcode_path}}" data-qrcode="{{$interfaceuser->unique_code}}"><i class="fa fa-eye"></i></a>
														@endif
													</td>
												</tr>
												@endforeach
											</tbody>
										@endif
									@endforeach
										
								</table>
								<br>
								<h4><center>{{'Complementary Invitees Data'}}</center></h4>
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th> ID </th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Alloted Quantity</th>
											<th>Remaining Quantity</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
									</thead>

									@foreach($data as $key => $value)
										@if(!empty($value['complementary_invitees']))
											<tbody>
												@foreach($value['complementary_invitees'] as $complementaryinvitees)
												<tr>
													<td>{{$complementaryinvitees->id}}</td>
													<td>{{$complementaryinvitees->name}}</td>
													<td>{{$complementaryinvitees->email}}</td>
													<td>+91 {{$complementaryinvitees->phone}}</td>
													<td>{{$complementaryinvitees->qty}}</td>
													<td>{{$complementaryinvitees->remaining_qty}}</td>
													<td>{{ date('d M Y H:i A', strtotime($complementaryinvitees->created_at)); }}</td>
													<td>
														<a class="fa-icon" data-toggle="tooltip" title="Invitees List" target="_blank" href="{{route('inviteeUserList')}}/{{$complementaryinvitees->id}}"><i class="fa fa-list"></i></a>
                                                        <a class="fa-icon" data-toggle="tooltip" title="Open Panal" target="_blank" href="{{ route('invitees') }}/{{$complementaryinvitees->access_token}}"><i class="fa fa-link"></i></a>
													</td>
												</tr>
												@endforeach
											</tbody>
										@endif
									@endforeach
										
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


<!-- QR code model -->
<div class="comman-modal modal fade" id="qrcode-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body">
				<!-- user-form -->
				<div class="user-form">
					<h5 class="modal-title">QR Code</h5>
					<table style="text-align: center;margin: 0 auto;">
						<tr>
							<td class="qr_code_sec"><img src="" class="qr_code_img"/></td>
						</tr>
						<tr>
							<td class="unique_code"></td>
						</tr>

					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- QR code model -->

@endsection

@section('script')

<script type="text/javascript">

	$(document).on('click','#view_qrcode', function(e) 
    {
        $(".response_editinvitee").hide();
        
        var qrpath = $(this).data('qrpath');
        var qrcode = $(this).data('qrcode');

        $('.qr_code_img').attr('src', qrpath);
        $('.unique_code').html(qrcode);

		$("#qrcode-modal").modal('show');
    });

	function emailUser(id)
   	{
   		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$.ajax({
			type:'POST',
			url: "{{route('emailUser')}}",
			data: {id: id},

			success:function(response)
			{
				response = jQuery.parseJSON(response);
				var type = response.type;
				var message = response.message;

				if(type == 'Success')
				{
					Swal.fire(
						'Success',
						'Email Resend Successfully.',
						'success'
					)
					$('.response_status').css('color', 'green').html(message).show();
				}
				else
				{
					$('.response_status').css('color', 'red').html(message).show();
				}

				$( "#user-section" ).load(window.location.href + " #user-section" );
			},
		});
   	}

	function emailMember(id)
   	{
   		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$.ajax({
			type:'POST',
			url: "{{route('emailMember')}}",
			data: {id: id},

			success:function(response)
			{
				response = jQuery.parseJSON(response);
				var type = response.type;
				var message = response.message;

				if(type == 'Success')
				{
					Swal.fire(
						'Success',
						'Email Resend Successfully.',
						'success'
					)
					$('.response_status').css('color', 'green').html(message).show();
				}
				else
				{
					$('.response_status').css('color', 'red').html(message).show();
				}

				$( "#user-section" ).load(window.location.href + " #user-section" );
			},
		});
   	}

	function emailInvitee(id)
   	{
   		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$.ajax({
			type:'POST',
			url: "{{route('emailInvitee')}}",
			data: {id: id},

			success:function(response)
			{
				response = jQuery.parseJSON(response);
				var type = response.type;
				var message = response.message;

				if(type == 'Success')
				{
					Swal.fire(
						'Success',
						'Email Resend Successfully.',
						'success'
					)
					$('.response_status').css('color', 'green').html(message).show();
				}
				else
				{
					$('.response_status').css('color', 'red').html(message).show();
				}

				$( "#user-section" ).load(window.location.href + " #user-section" );
			},
		});
   	}

</script>
@endsection
