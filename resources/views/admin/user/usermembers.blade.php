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
							<form action="{{ route('users') }}" name="search" method="get">
								{{csrf_field()}}
							    <div class="form-group">
							        <div class="search-inner">
							            <span>User Members</span>
							            
							            <div class="form-actions">
							                <a class="btn default" href="{{ route('users') }}"><i class="fa fa-refresh"></i> Back</a>
							            </div>

							        </div>
							    </div>
							</form>

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
											<th>Gender</th>
											<th>Registration Date</th>
											<th> Action </th>
										</tr>
									</thead>

									<tbody>
										@foreach ($users as $key => $value)
													<tr class="odd gradeX" id="{{ $value['id'] }}">
														<td class="table-checkbox"> {{ ++$key }} </td>
														<td class="table-checkbox"> {{ $value->name }} </td>
														<td class="table-checkbox"> {{ $value->email }} </td>
														<td class="table-checkbox"> {{ $value->phone }} </td>
														<td class="table-checkbox"> {{ $value->unique_code }} </td>
														<td class="table-checkbox"> {{ $value->gender }} </td>
														<td>
															{{ date('d M Y H:i A', strtotime($value['created_at'])); }}
														</td>
														<td>
															<a class="fa-icon" data-toggle="tooltip" title="" href="javascript:void(0)" onclick="emailMember({{ $value->id }})" data-original-title="Resend Email"><i class="fa fa-envelope"></i></a>
															
														</td>
													</tr>
											@endforeach
										
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


@endsection

@section('script')

<script type="text/javascript">

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

</script>
@endsection
