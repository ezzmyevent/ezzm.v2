@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3 flex-wrap">
            <div class="d-flex">
                <h2 class="heading mb-0">{{ $title }}</h2>
            </div>
			<div class="m-box d-flex">
                <!-- <button type="button" class="btn btn-main btn-add-coupon" data-toggle="modal" data-target="#addUserModal" onclick="openmodal('add');">+ Add User</button>
                <button type="button" class="btn btn-main btn-add-coupon" data-toggle="modal" data-target="#addUserModal" onclick="openmodal('import');">+ Import Users</button>
                {{--<a class="btn btn-main btn-add-coupon" href="{{ route('exportUsers') }}" > Export Users Redeem</a>--}} -->
                <a class="btn btn-main btn-add-coupon" href="{{ route('exportUsersAllOnsite') }}" > Export All Users</a>
            </div>
        </div>
        @include('admin.elements.search', ['route' => 'users'])
        <!-- Tickets Table -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-12">
                <div class="table-scroller">
                    <table class="table table-hover attendees-table tickets-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Code</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Unique Code</th>
                                <th>Adult 1</th>
                                <th>Adult 2</th>
                                <th>Adult 3</th>
                                <th>Kid 1</th>
                                <th>Kid 2</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($users))
                                @foreach ($users as $key => $value)
                                    <tr id="{{ $value->id }}">
                                        <td> {{ ++$key }} </td>
                                        <!-- <td> <a href="{{$value->eticket_path}}" target="_blank"><?= !empty($value->eticket_path) ? 'View' : ""; ?></a> </td> -->
                                        <td> {{ $value->emp_code }} </td>
                                        <!-- <td> {{ $value->lead_name }} </td> -->
                                        <td> {{ $value->name }} </td>
                                        <td> {{ $value->phone }} </td>
                                        <td> {{ $value->unique_code }}</td>

                                        <td> {{ $value->adult_1 }}</td>
                                        <td> {{ $value->adult_2 }}</td>
                                        <td> {{ $value->spouse }}</td>
                                        <td> {{ $value->kid_1 }}</td>
                                        <td> {{ $value->kid_2 }}</td>

                                        <td> <?php  
										if($value->status ==1){ ?> <span class="activated">Successful</span> <?php } else { ?> <span class="deactivated">Pending</span>  <?php } ?> </td>
                                        <td>
                                            <div class="dropdown ticket-option">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    <div class="dot-three"></div>
                                                </button>
                                                <div class="dropdown-menu">

                                                    	<a class="dropdown-item" onclick="openmodal('view', '{{$value->id}}');" data-toggle="modal" data-target="#addUserModal">
                                                    		<img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg') }}">
                                                    		View User
                                                    	</a>
                                                        
                                                        <a class="dropdown-item" onclick="openmodal('edit', '{{$value->id}}');" data-toggle="modal" data-target="#addUserModal">
                                                        	<img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg') }}"> Edit User
                                                        </a>

                                                        @if(!empty($value->phone))
	                                                        <a class="dropdown-item" onclick="resendmail('{{$value->id}}')">
																<img class="cal-icon" src="{{ asset('public/admin/assets/images/email_builder.svg')}}">Resend M-badge
															</a> 
														@endif

														@if(!empty($value->eticket_path))
															<a class="dropdown-item" href="{{ $value->eticket_path }}" target="_blank"> 
																<img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg') }}">View M-badge
															</a>
														@endif

                                                        
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12"> No data available in table </td>
                                </tr>
                            @endif
                        </tbody>
			        </table>
                </div>
            	<div class="paging_bootstrap_full_number" id="">
					<ul class="pagination">
						@if($pagination == 'yes')
							{!! $users->links() !!}
						@endif
					</ul>
				</div>
			</div>
        </div>
    </div>
<!-- Start User modal -->
<div class="modal right fade" id="addUserModal">
	<div class="modal-dialog modal-dialog-scrollable">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<div id="modalContent"></div>
	</div>
</div>
<!-- End User modal -->

@endsection
@push('custom-scripts')

<script type="text/javascript">


function openmodal(type, id) {
    var url = '';
    
    if(typeof id === 'undefined') {
        var id = '';
    }

    if(type == 'add') {
        url = "{{route('users-add')}}";
    } else if(type == 'view') {
        url = "{{route('users-view')}}";
    } else if(type == 'import') {
        url = "{{route('users-import')}}";
    } else if(type == 'export') {
        url = "{{route('users-export')}}";
    }else if(type == 'edit') {
        url = "{{route('editregistration')}}";
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'GET',
        url: url,
        data: {id:id},
        success:function(response)
        {
            if(type == 'add' || type == 'view' || type == 'import' || type == 'edit') {

                console.log(response,'response');
                $('#modalContent').html(response);
            }
        },
    });
}

$(document).on('click','.submit-btn', function (e) {
	var form = $('#userdetails')[0];
	var formData = new FormData(form);
	
	$.ajax({
		type:'POST',				
		url: "{{route('users-save')}}",
		data:formData,
		contentType: false,
		processData: false,
		beforeSend: function() {
			// setting a timeout
			$('body').addClass('body-loader');
			$('.lds-hourglass').show();
		},
		success:function(response){
			//response = jQuery.parseJSON(response);
			var type = response.type;
			var message = response.message;

			if($.isEmptyObject(response.error)){
				Swal.fire(
						'Success',
						'User Add Successfully.',
						'success'
				)
				location.reload(10000);
			}else{
				console.log(response.error);
				$.each( response.error, function( key, value ) {
					toastr.options = {"positionClass": "toast-bottom-right"};
					toastr.error(value);
				});
			}
		},
		complete: function(data) {
			$('.lds-hourglass').hide();
    	},
	
	});
	e.preventDefault();
});
$(document).on('click', '.edit-submit-btn', function(e) {
		var form = $('#editinterfacedetails')[0];
		var formData = new FormData(form);
        console.log(formData,'formData');

		$.ajax({
			type: 'POST',
			url: "{{route('editregistrationforsave')}}",
			data: formData,
			contentType: false,
			processData: false,
			beforeSend: function() {
				// setting a timeout
				$('body').addClass('body-loader');
				$('.lds-hourglass').show();
			},
			success: function(response) {
				location.reload();
			},
			complete: function(data) {
				$('.lds-hourglass').hide();
            },


		});
		
		e.preventDefault();
	});
$(document).on('click','.submit-btn-for-import', function (e) {
	var form = $('#importdetails')[0];
	var formData = new FormData(form);
	var self = $(this);
	self.text('Importing...');
	self.attr('disabled',true);
	$.ajax({
		type:'POST',				
		url: "{{route('users-uploadcsv')}}",
		data:formData,
		contentType: false,
		processData: false,
		success:function(response)
		{
			self.text('Import');
			self.attr('disabled',false);
			//response = jQuery.parseJSON(response);
			var type = response.type;
			var message = response.message;

			if($.isEmptyObject(response.error)){
				location.reload();
			}else{
				console.log(response.error);
				$.each( response.error, function( key, value ) {
					toastr.options = {"positionClass": "toast-bottom-right"};
					toastr.error(value);
				});
			}

			//$( "#user-section" ).load(window.location.href + " #user-section" );
		},
	
	});
	e.preventDefault();
});

function resendmail(id){
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$.ajax({
		type:'POST',
		url: "{{route('resendmail')}}",
		data: {id: id},
		beforeSend: function() {
			// setting a timeout
			$('body').addClass('body-loader');
			$('.lds-hourglass').show();
		},
		success:function(response)
		{
	
			response = jQuery.parseJSON(response);
			var type = response.type;
		
			var message = response.message;

			if(type == 'Success')
			{
				Swal.fire(
						'Success',
						'M-Badge Resend Successfully.',
						'success'
				)
			}
		},
		complete: function(data) {
			$('.lds-hourglass').hide();
    	},
	});
}
</script>
@endpush