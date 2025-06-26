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
								<span class="caption-subject"> Chat List </span>
							</div>
							<div class="actions">
								<a href="{{route('exportChat')}}" class="btn">Download Chat Data</a>
								<a type="button" onclick="resetChat()" class="btn btn-danger">Reset Chat</a>
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
											<th> Message </th>
											<th> Created </th>
											<th> Action </th>
										</tr>
									</thead>

									<tbody>
										@if(count($chat['record']) > 0)
											@foreach($chat['record'] as $key => $value)
												<tr class="odd gradeX" id="{{ $value['id'] }}">
													<td class="table-checkbox"> {{ ++$key }} </td>													
													<td> {{ $value['name']; }} </td>
													<td> {{ $value['message']; }} </td>
													<td> {{ date('d M Y H:i A', strtotime($value['created_at'])); }} </td>
													<td>
														<a class="fa-icon" data-toggle="tooltip" title="" href="javascript:void(0)" data-original-title="Delete" onclick="deleteChat({{ $value['id'] }})"><i class="fa fa-trash"></i></a>
													</td>
												</tr>
											@endforeach 
										@else
											<tr class="odd gradeX"> <td colspan="'.$total_view_fields.'"> No data available in table </td> </tr>
										@endif
									</tbody>

								</table>
							</div>
							<div class="paging_bootstrap_full_number" id="">
								<ul class="pagination">
									{{ $chat['record']->withQueryString()->links() }}
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
	
   	function deleteChat(id)
   	{
   		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$.ajax({
			type:'POST',				
			url: "{{route('deleteChat')}}",
			data: {id: id},

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

	function resetChat()
	{
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, reset!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type:'GET',				
					url: "{{route('resetChat')}}",
					data: {status:'delete'},
					success:function(response)
					{
						Swal.fire(
							'Deleted!',
							'All messages has been deleted.',
							'success'
						)
						$( "#user-section" ).load(window.location.href + " #user-section" );
					},		
				});
			}
		})
	}

</script>

@endsection