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
								<span class="caption-subject"> Attendees </span>
							</div>
							<div class="actions">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-modal">Download Attendees By Date</button>
								@if($master_setting['settings']['register_menu_download_attendees'] == 1)
									<a href="{{route('exportAttendees')}}" class="btn">Download All Attendees</a>
								@endif
							</div>
						</div>

						<div class="portlet-body form search-wrapper" id="filters">
							<form action="{{ route('attendees') }}" name="search" method="get">
								{{csrf_field()}}
							    <div class="form-group">
							        <div class="search-inner">
							            <input type="hidden" name="post_type" value="search">

							            <span>Search By:</span>

							            <div class="field-item">
											@foreach($users['search_fields'] as $key => $value)
							            		
												@php $input_value = ''; @endphp
												@if(isset($_GET[$value['field_value']]) && $_GET[$value['field_value']] != '')
												@php $input_value = $_GET[$value['field_value']]; @endphp
							            		@endif
												<div class="input-outer">
									                <input type="text" name="{{ $value['field_value'] }}" class="form-control" placeholder="{{ $value['field_title'] }}" value="{{$input_value}}">
									            </div>
											@endforeach
			                            </div>

							            <div class="form-actions">
							                <button type="submit" class="btn green"><i class="fa fa-search"></i> Search</button>
							                <a class="btn default" href="{{ route('attendees') }}"><i class="fa fa-refresh"></i> Reset</a>
							            </div>

							        </div>
							    </div>
							</form>
							
								@if(isset($users['search_for']) && $users['search_for'] != '')
								<span class='pt-5'>		
									{{ "Search for : " }}
										{{ rtrim($users['search_for'], ', '); }}
								</span>
								@endif
						</div>


						<div class="portlet-body" id="user-section">
							<span class="response_status"></span>
							<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th class="table-checkbox"> # </th>
											@foreach($users['view_fields'] as $key => $value)
												<th>
													{{ $value['field_title'] }}
												</th>
											@endforeach
											<th> Registration Date </th>
											<th> Action </th>
										</tr>
									</thead>

									<tbody>
										@php 
										$total_view_fields = count($users['view_fields'])+2;
										@endphp
										
										@if($users['pagination'] == 'yes')
											@if(count($users['record']) > 0)
												@foreach($users['record'] as $key => $value)
													<tr class="odd gradeX" id="{{ $value['id'] }}">
														<td class="table-checkbox"> {{ ++$key }} </td>
														@foreach($users['view_fields'] as $k => $val)
															<td>
																{{ $value[$val['field_value']]; }}
															</td>
														@endforeach
														<td>
															{{ date('d M Y H:i A', strtotime($value['created_at'])); }}
														</td>
														<td>
															@if($value['status'] == 1) 
															<a class="fa-icon tooltips" data-toggle="tooltip" title="Deactivate" onclick="changeStatus(0, {{ $value['id'] }})"><i class="fas fa-times-circle"></i></a>
															@else
															<a class="fa-icon tooltips" data-toggle="tooltip" title="Activate" onclick="changeStatus(1, {{ $value['id'] }})"><i class="far fa-check-circle"></i></a>
															@endif

															<a class="fa-icon" data-toggle="tooltip" title="" href="javascript:void(0)" data-original-title="Delete" onclick="deleteUser({{ $value['id'] }})"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
											@endforeach 
											@else
												<tr class="odd gradeX"> <td colspan="'.$total_view_fields.'"> No data available in table </td> </tr>
											@endif
										@endif


										@if($users['pagination'] == 'no')
											@if(count($users['record']) > 0 )
												@foreach($users['record'] as $key => $value)
													<tr class="odd gradeX" id="{{ $value->id }}">
														<td class="table-checkbox"> {{ ++$key }} </td>

														@foreach($users['view_fields'] as $k => $val)
															<td>
																@php 
																	$field_value = $val['field_value'];
																@endphp
																{{ $value->$field_value; }}																
															</td>
														@endforeach
														<td>
															{{ date('d M Y H:i A', strtotime($value->created_at)); }}
														</td>
														<td>
															@if($value->status == 1) 
															<a class="fa-icon tooltips" data-toggle="tooltip" title="Deactivate" onclick="changeStatus(0, {{ $value->id }})"><i class="fas fa-times-circle"></i></a>
															@else
															<a class="fa-icon tooltips" data-toggle="tooltip" title="Activate" onclick="changeStatus(1, {{ $value->id }})"><i class="far fa-check-circle"></i></a>
															@endif

															<a class="fa-icon" data-toggle="tooltip" title="" href="javascript:void(0)" data-original-title="Delete" onclick="deleteUser({{ $value->id }})"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												@endforeach
											@else
												<tr class="odd gradeX"> <td colspan="'.$total_view_fields.'"> No data available in table </td> </tr>
											@endif
										@endif
										
									</tbody>
								</table>
							</div>
							<div class="paging_bootstrap_full_number" id="">
								<ul class="pagination">
									@if($users['pagination'] == 'yes')
										{{ $users['record']->withQueryString()->links() }}
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
                        <h5 class="modal-title">Download Attendees By Date</h5>
                        <form role="form" class="form-horizontal" action="{{route('exportAttendeesByDate')}}" id="download-attendees" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="response_adduser"></div>
                            <div class="form-body">
                                
								<div class="form-group line-input">
									<label class="control-label" for="user">Start Date</label>
									<input name="start_date" type="date" class="form-control" id="start_date"  placeholder="Enter Start Date" required>
								</div>
								<div class="form-group line-input">
									<label class="control-label" for="user">End Date</label>
									<input name="end_date" type="date" class="form-control" id="end_date" placeholder="Enter End Date" required>
								</div>
                            </div>
							<h7>Please select same date for single day reporting.</h7>
                            <div class="form-actions">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit" name="submit" class="btn blue primary attendees-submit">Submit</button>
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
@endsection

@section('script')

<script type="text/javascript">
	
	$('#end_date').on('change', function(e) {
		$('.response_adduser').html('').hide();
		var start_date = $('#start_date').val();
		var end_date = $(this).val();
		
		if(end_date < start_date) {
			$('#end_date').val('')
			$('.response_adduser').css('color', 'red').html("End date can't be less then start date.").show();
		}
	});
	
	$('.attendees-submit').on('click', function(e) {  
		$('#user-modal').modal('hide');
		setTimeout( function() {
			$('.response_adduser').html('').hide();
			$('#start_date').val('');
			$('#end_date').val('');
		}, 5000);
   	});
	
   	function changeStatus(status, id)
   	{
   		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
		$.ajax({
			type:'POST',				
			url: "{{route('changeStatus')}}",
			data: {status: status, id: id},

			success:function(response)
			{
				response = jQuery.parseJSON(response);
				var type = response.type;
				var message = response.message;

				if(type == 'Success')
				{					
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

   	function deleteUser(id)
   	{
   		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$.ajax({
			type:'POST',				
			url: "{{route('deleteUser')}}",
			data: {id: id},

			success:function(response)
			{
				response = jQuery.parseJSON(response);
				var type = response.type;
				var message = response.message;

				if(type == 'Success')
				{
					document.getElementById('add_user').reset();
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