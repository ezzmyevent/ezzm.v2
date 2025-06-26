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
							<form action="{{ route('onsiteusers') }}" name="search" method="get">
								{{csrf_field()}}
							    <div class="form-group">
							        <div class="search-inner">
							            <span>Search By:</span>
							            <div class="field-item">
											<div class="input-outer">
											<input type="hidden" name="post_type" value="search">
									        <input type="text" name="name" class="form-control" placeholder="Name" value="">
									        </div>
									        <div class="input-outer">
									        <input type="text" name="email" class="form-control" placeholder="Email" value="">
									        </div>
									        <div class="input-outer">
									        <input type="text" name="phone" class="form-control" placeholder="Phone" value="">
									        </div>
									        <div class="input-outer">
									        <input type="text" name="qr" class="form-control" placeholder="QR Code" value="">
									        </div>
										</div>

							            <div class="form-actions">
							                <button type="submit" class="btn green"><i class="fa fa-search"></i> Search</button>
							                <a class="btn default" href="{{ route('onsiteusers') }}"><i class="fa fa-refresh"></i> Reset</a>
							            </div>

							        </div>
							    </div>
							</form>
							
						</div>

						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject"> {{$title}} </span>
							</div>
							<div class="actions">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-modal">Add User</button>
								<a href="{{route('exportOnsiteData')}}" class="btn">Export Data</a>
							</div>
						</div>

						<div class="portlet-body" id="user-section">
							<span class="response_status"></span>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th class="table-checkbox"> # </th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>QR Code</th>
											<th>Festival Dates</th>
											<th>Registration Date</th>
											<th> Action </th>
										</tr>
									</thead>

									<tbody>
										@if(!empty($users))
										@foreach ($users as $key => $value)
											<tr class="odd gradeX" id="{{ $value->id }}">
												<td class="table-checkbox"> {{ ++$key }} </td>
												<td class="table-checkbox"> {{ $value->name }} </td>
												<td class="table-checkbox"> {{ $value->email }} </td>
												<td class="table-checkbox"> {{ $value->phone }} </td>
												<td class="table-checkbox"> {{ $value->unique_code }} </td>
												<td class="table-checkbox"> {{ $value->festival_dates }} </td>
												<td>
													{{ date('d M Y H:i A', strtotime($value->created_at)); }}
												</td>
												<td>
													@if($value->unique_code != '')
														<a class="fa-icon" data-toggle="tooltip" title="" data-original-title="View QR Code" id="view_qrcode" data-qrpath="{{$value->qrcode_path}}" data-qrcode="{{$value->unique_code}}"><i class="fa fa-eye"></i></a>
														<a class="fa-icon" data-original-title="User QR Code" href="{{route('qrcode_user')}}/{{ $value->unique_code }}/{{ $value->ticket_category }}"
														 target="_blank"><i class="fa fa-eye"></i></a>

													@endif
												</td>
											</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>
							<div class="paging_bootstrap_full_number" id="">
								<ul class="pagination">
									@if($pagination == 'yes')
										{{ $users->withQueryString()->links() }}
									@endif
								</ul>
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

<!-- Add User Modal start -->
<div class="comman-modal modal fade" id="user-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <!-- user-form -->
                    <div class="user-form">
                        <h5 class="modal-title">Add Data</h5>
                        <form role="form" class="form-horizontal" action="#" id="add_user_data" method="post" enctype="multipart/form-data">
                            <div class="response_adduser alert-danger" style="display:none;">
                                <ul></ul>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <select name="ticket_category" class="form-control ticket_category" id="ticket_category" style="padding: 0 15px;">
                                        <option value="Visitors Entry">Visitors Entry</option>
                                        <option value="Symposium">Symposium</option>
                                        <option value="Symposium - Student">Symposium - Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group selecDateWrapper">
                                    <label for="dataname">Festival Dates</label><br>
                                    <span class="festival_dates_data_12"><input type="checkbox" class ="selectedId festival_dates_check_box_12" name="festival_dates[]" value="12"> 12th May</span>
                                    <span class="festival_dates_data_13"><input type="checkbox" class ="selectedId festival_dates_check_box_13" name="festival_dates[]" value="13"> 13th May</span>
                                    <span class="festival_dates_data_14"><input type="checkbox" class ="selectedId festival_dates_check_box_14" name="festival_dates[]" value="14"> 14th May</span>
                                    <span class="festival_dates_data_15"><input type="checkbox" class ="selectedId festival_dates_check_box_15" name="festival_dates[]" value="15"> 15th May</span>
                                </div>
                            </div>
							<div class="form-body">
                                <div class="form-group line-input">
									<label for="dataname">Payble Amount</label>
									<input name="payable_amount" type="text" class="form-control payable-amount" id="payable_amount" value="0" readonly>
                                </div>
                            </div>
							<div class="form-body">
                                <div class="form-group line-input">
									<label for="dataname">Payment Type</label>
                                    <select name="paymenttype" class="form-control" id="paymenttype" style="padding: 0 15px;">
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="name" type="text" class="form-control" id="user_name" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="email" type="text" class="form-control" id="user_email" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="phone" type="text" class="form-control" id="user_phone" placeholder="Enter Phone Number" required>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <select class="form-control" name="gender" id="gender" style="padding: 0 15px;">
                                        <option value="" selected="selected">Select Gender </option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Transgender">Transgender</option>
                                        <option value="Non-binary/non-conforming">Non-binary/non-conforming</option>
                                        <option value="Prefer not to respond">Prefer not to respond</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <select name="state" class="form-control" id="state" style="padding: 0 15px;">
                                        @php
                                            $states = \App\Models\States::getState();
                                        @endphp
                                        <option value="">Select state</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->name}}" data-id="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <select name="city" class="form-control" id="city" style="padding: 0 15px;">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
							
                            <div class="form-actions">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit" name="submit" class="btn blue primary adduser-submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Add User Modal end -->

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
	$('#ticket_category').on('change', function(e) {
        var category = $(this).val();
		$('.festival_dates_check_box_12').prop('checked', false);
		$('.festival_dates_check_box_13').prop('checked', false);
		$('.festival_dates_check_box_14').prop('checked', false);
		$('.festival_dates_check_box_15').prop('checked', false);
		$('.payable-amount').val('0');
        if(category != 'Visitors Entry') {
            $('.festival_dates_data_15').hide();
        } else {
            $('.festival_dates_data_15').show();
        }

    });

	$(document).on('click','#view_qrcode', function(e) 
    {
        $(".response_editinvitee").hide();
        
        var qrpath = $(this).data('qrpath');
        var qrcode = $(this).data('qrcode');

        $('.qr_code_img').attr('src', qrpath);
        $('.unique_code').html(qrcode);

		$("#qrcode-modal").modal('show');
    });
	
	$('.adduser-submit').on('click', function(e)
	{
        $(".response_adduser").hide();
   		
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type:'POST',
            url: "{{route('addonsiteusers')}}",
            data:$('#add_user_data').serialize(),

            success:function(response)
            {   
                if($.isEmptyObject(response.error)){
                    //response = jQuery.parseJSON(response);
                    var type = response.type;
                    var message = response.message;
                    
                    document.getElementById('add_user_data').reset();
                    $('.response_adduser').removeClass('alert-danger');
                    $('.response_adduser').css('color', 'green').html(message).show();
                    
                    $( "#user-section" ).load(window.location.href + " #user-section" );
                }else{
                    $(".response_adduser").find("ul").html('');
                    $(".response_adduser").css('display','block');
                    $.each( response.error, function( key, value ) {
                        console.log(value)
                        $(".response_adduser").find("ul").append('<li>'+value+'</li>');
                    });
                }
            },
        });
		
   		e.preventDefault();
   	});

	$(document).on('click','.selectedId', function(e) 
   	{
		var ticket_category = $('#ticket_category').val();
		var dates = [];
		$(".selectedId:checkbox:checked").each(function(){
			dates.push($(this).val());
		});

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type:'POST',
			url: "{{route('getrates')}}",
			data: {ticket_category: ticket_category,dates:dates},

			success:function(response)
			{
				response = jQuery.parseJSON(response);
				var status = response.status;
				var payble_amount = response.payble_amount;

				if(status) {
					$('.payable-amount').val(payble_amount);
				} else {
					$('.payable-amount').val('0');
				}
			},
		});
		
   	});

</script>
@endsection
