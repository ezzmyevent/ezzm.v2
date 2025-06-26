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
								<span class="caption-subject"> {{$title}} </span>
							</div>
							<div class="actions">
								<!-- Button trigger modal -->
								<a href="{{route('exportUsersData')}}" class="btn">Export Data</a>
								
							</div>
						</div>

						<div class="portlet-body" id="user-section">
							<span class="response_status"></span>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th class="table-checkbox"> # </th>
											<th> Name </th>
                                            <th> Email </th>
                                            <th> Phone Number </th>
                                            <th> Invited By</th>
                                            <th> Created At</th>
                                            <th> Action</th>
										</tr>
									</thead>

									<tbody>
										@if(!empty($user_data))
                                            @foreach($user_data as $key => $value)
                                                
                                                <tr class="odd gradeX" id="{{ $value['id'] }}">
                                                    <td class="table-checkbox"> {{ ++$key }} </td>
                                                    <td class="table-checkbox"> {{ $value['name'] }} </td>
                                                    <td class="table-checkbox"> {{ $value['email'] }} </td>
                                                    <td class="table-checkbox"> {{ $value['countryCode'].' '.$value['phone'] }} </td>
                                                    <td class="table-checkbox"> {{ '@By '.ucwords(strtolower($value->invitedBy['name'])) }} </td>
                                                    <td>
														{{ date('d M Y H:i A', strtotime($value['created_at'])); }}
                                                    </td>
													<td class="table-checkbox">
														<a class="fa-icon" data-toggle="tooltip" title="" href="javascript:void(0)" onclick="emailInvitee({{ $value['id'] }})" data-original-title="Resend Email"><i class="fa fa-envelope"></i></a>
														@if($value['unique_code'] != '')
															<a class="fa-icon" data-toggle="tooltip" title="" data-original-title="View QR Code" id="view_qrcode" data-qrpath="{{$value['qrcode_path']}}" data-qrcode="{{$value['unique_code']}}"><i class="fa fa-eye"></i></a>
														@endif
													</td>
                                                </tr>
                                        @endforeach
                                        @else
                                            <tr class="odd gradeX"> <td colspan="<?php echo $total_view_fields; ?>"> No data available in table </td> </tr>
                                        @endif
										

									</tbody>
								</table>
							</div>
							<div class="paging_bootstrap_full_number" id="">
								<ul class="pagination">
									{{ $user_data->withQueryString()->links() }}
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
<script>
$(document).on('click','#view_qrcode', function(e) 
    {
        $(".response_editinvitee").hide();
        
        var qrpath = $(this).data('qrpath');
        var qrcode = $(this).data('qrcode');

        $('.qr_code_img').attr('src', qrpath);
        $('.unique_code').html(qrcode);

		$("#qrcode-modal").modal('show');
    });

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