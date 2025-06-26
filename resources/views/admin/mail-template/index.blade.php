@extends('admin.layouts.master')
@section('content')
<style>
div#sendTemplateToMailModal .modal-dialog, div#sendTemplateToUserModal .modal-dialog {
    pointer-events: initial;
}
.table-scroller {
    overflow: auto;
    padding-bottom: 60px;
}
.activetocron{
	cursor: pointer;
}
</style>
<div class="container">

    <div class="d-flex justify-content-between mb-3 flex-wrap">
        <div class="d-flex">
            <h2 class="heading mb-0">Template List</h2>
        </div>
        <div class="save-next">
			<a href="{{route('mail-template.create')}}" class="btn btn-main btn-add-mail">+ Add Mail Template</a>
        </div>
    </div>

<div class="row">
<div class="col-md-12">
    <div class="table-scroller">
        <table class="table table-hover tickets-table" id="" width="100%">
          
            <tbody>
				@foreach($mailtemplates as $key => $value)
				<tr>
					<td><span class="semi-18">{{$value->title}}</span></td>
					<td>{{$value->subject}}</td>
					{{-- <td>{{$value->reminder_status}}</td> --}}
                    <td>{{$value->template_type}}</td>
					<td>
						@if($value->active_to_cron == 1)
						<badge class="activated badge badge-success" data-id = "{{$value->id}}">Active For Cron</badge>
						@else
						 <badge class="activated badge badge-danger activetocron" title="Click For Active To Cron" data-id = "{{$value->id}}">Deactive</badge>
						@endif
					</td>
					<td>
						@if($value->status == 1)
							<span class="activated">Activated</span>
						@else
							<span class="deactivated">Deactivated</span>
						@endif
					</td>
					<td>
						<div class="dropdown ticket-option">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<div class="dot-three"></div>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{route('mail-template.edit',['id' => $value->id])}}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a> 
							@if($value->is_deleted == 0)
							<a class="dropdown-item" onclick="return confirm('Do You Want To Delete?');" href="{{route('mail-template.destroy',['id' => $value->id])}}"><img class="cal-icon" src="{{ asset('public/admin/assets/images/delete_icon.svg')}}"> Delete</a>
							@endif
							<a class="dropdown-item" href="javascript:void(0);" onclick="openTestModel({{$value->id}});"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Check Mail Template</a> 
							<a class="dropdown-item" href="javascript:void(0);" onclick="openMailToUserModel({{$value->id}});"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}">Send Mail</a> 

						</div>
					</td>
					</tr>
					@endforeach
                </tbody>
        </table>
    </div>
	<div class="paging_bootstrap_full_number" id="">
		<ul class="pagination">
			@if($pagination == 'yes')
				{!! $mailtemplates->links() !!}
			@endif
		</ul>
	</div>
    </div>
    </div>
</div>



<!-- send template to mail modal -->
<div class="modal fade" id="sendTemplateToMailModal">
	<div class="modal-dialog modal-dialog-scrollable bg-white">
		<div id="modalContent">
			<div class="modal-header">
				<h5 class="modal-title">Check Template Preview On Email </h5>
				<button type="button" class="close" data-dismiss="modal">×</button>
			  </div>
			<div class="container py-3">
				<form method="post" id="sendTemplateToMailForm">
					@csrf
					<input type="hidden" value="" id="templateid" name="templateid">
					<div class="row">
						<div class="col-md-12">
							<label class="" for="email">Email  <span class="error-required">*</span></label>
							<input type="email" class="form-control mb-3" id="to_emails" name="to_emails">
						</div>
						<div class="col-md-12">
							<button type="button" class="btn btn-mail btn-add-input" id="sendTemplateToMail" name="sendTemplateToMail">Send</button>
						</div>					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- send template to mail modal -->

<!-- send template to mail modal -->
<div class="modal  fade" id="sendTemplateToUserModal">
	<div class="modal-dialog modal-dialog-scrollable bg-white">
		<div id="modalContent">
			<div class="modal-header">
				<h5 class="modal-title">Send an Email to a Specific User</h5>
				<button type="button" class="close" data-dismiss="modal">×</button>
			  </div>
			<div class="container py-3">
				<form method="post" id="sendMailToUserForm">
					@csrf
					<input type="hidden" value="" id="templateid" name="templateid">
					<div class="row">
						<div class="col-md-12">
							<input type="email" class="form-control" id="to_emails" name="to_emails">
						</div>
						<div class="col-md-12 mt-3">
							<button type="button" class="btn btn-mail btn-add-input" class="form-control" id="sendMailToUser" name="sendMailToUser">Send</button>
						</div>					
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
<!-- send template to mail modal -->

@endsection
@push('custom-scripts')

<script type="text/javascript">

function openmodal(type, id) {
	var url = '';
	
	if(typeof id === 'undefined') {
		var id = '';
	}

	if(type == 'add') {
		url = "{{route('tickets-add')}}";
	} else if(type == 'view') {
		url = "{{route('tickets-view')}}";
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
			$('#modalContent').html(response);
		},
	});
}

function changestatus(status, id) {
	var url = "{{route('tickets-status')}}";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		type:'GET',
		url: url,
		data: {id:id,status:status},
		success:function(response)
		{
			location.reload();
		},
	});
}

//for add tickets
$(document).on('click','#custom_price', function (e) {
	var checked = document.getElementById("custom_price");  
	if (checked.checked == true){  
		$('#customise_price').show();
	} else {
		$('#customise_price').hide();
	}
});

$(document).on('click','.submit-btn', function (e) {
	var min_qty = $('#min_qty').val();
	var max_qty = $('#max_qty').val();

	if(min_qty != '' && max_qty != '') {
		if(max_qty <= min_qty) {
			toastr.options = {"positionClass": "toast-bottom-right"};
			toastr.error('Max quantity should grater then min quantity,');
		}
	}
	
	var form = $('#ticketdetails')[0];
	var formData = new FormData(form);
	
	$.ajax({
		type:'POST',				
		url: "{{route('tickets-save')}}",
		data:formData,
		contentType: false,
		processData: false,
		success:function(response)
		{
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
//for add tickets


// send templaet to mail
function openTestModel(templateid){
	$('#sendTemplateToMailForm #templateid').val(templateid);
	$('#sendTemplateToMailModal').modal({
		backdrop: 'static',
        keyboard: false,
		show:true
	});
}
$(document).on('click','#sendTemplateToMail', function (e) {
		e.preventDefault();

	var form = $('#sendTemplateToMailForm')[0];
	var formData = new FormData(form);
	
	$.ajax({
		type:'POST',				
		url: "{{route('mail-template.sendtemplatemail')}}",
		data:formData,
		contentType: false,
		processData: false,
		beforeSend: function() {
                $('#sendTemplateToMail').html('Waiting...'); 
        },
		success:function(response)
		{
            $('#sendTemplateToMail').html('Send'); 
            if ($.isEmptyObject(response.error)) {
                $('#sendTemplateToMailForm')[0].reset();
                toastr.success(response.success);
            } else {
                console.log(response.error);
                $.each(response.error, function(key, value) {
                    toastr.options = { "positionClass": "toast-bottom-right" };
                    toastr.error(value);
                });
            }
		},
		error: function(xhr) {
            $('#sendTemplateToMail').html('Send'); 
            var errorResponse = JSON.parse(xhr.responseText);
            if (xhr.status === 400) {
                $.each(errorResponse.error, function(key, value) {
                    toastr.error(value);
                });
            } else if (xhr.status === 500) {
                toastr.error('There was an issue sending mail. Please try again later.');
            }
        }
	
	});
});

// send mail to user
function openMailToUserModel(templateid){
	$('#sendMailToUserForm #templateid').val(templateid);
	$('#sendTemplateToUserModal').modal({
		backdrop: 'static',
        keyboard: false,
		show:true
	});
}

$(document).on('click','#sendMailToUser', function (e) {
	e.preventDefault();

	var form = $('#sendMailToUserForm')[0];
	var formData = new FormData(form);
	
	$.ajax({
		type:'POST',				
		url: "{{route('mail-template.sendmailtouser')}}",
		data:formData,
		contentType: false,
		processData: false,
		beforeSend: function() {
                $('#sendMailToUser').html('Waiting...'); 
        },
		success:function(response)
		{
            $('#sendMailToUser').html('Send'); 
            if ($.isEmptyObject(response.error)) {
                $('#sendMailToUserForm')[0].reset();
                toastr.success(response.success);
            } else {
				var errorResponse = response;//JSON.parse(response);
				if (response.status === 400) {
					$.each(errorResponse.error, function(key, value) {
						toastr.error(value);
					});
				} else if (response.status === 500) {
					toastr.error('There was an issue sending mail. Please try again later.');
				}
            }
		},
		error: function(xhr) {
            $('#sendMailToUser').html('Send'); 
            var errorResponse = JSON.parse(xhr.responseText);
            if (xhr.status === 400) {
                $.each(errorResponse.error, function(key, value) {
                    toastr.error(value);
                });
            } else if (xhr.status === 500) {
                toastr.error('There was an issue sending mail. Please try again later.');
            }
        }
	
	});
});
// send mail to user end


// active template to cron

$('.activetocron').click(function(th){
	var templateid = $(this).attr('data-id');
	if(typeof templateid === 'undefined') {
			var templateid = '';
	}	
	if(templateid){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});		

		$.ajax({
		type:'POST',				
		url: "{{route('activetocron')}}",
		data:{
			id:templateid
		},
		success:function(response)
		{
			location.reload();
		},
		error: function(xhr) {
            var errorResponse = JSON.parse(xhr.responseText);
            if (xhr.status === 400) {
                $.each(errorResponse.error, function(key, value) {
                    toastr.error(value);
                });
            } else if (xhr.status === 500) {
                toastr.error('There was an issue sending mail. Please try again later.');
            }
        }
	
	});

	}else{
		toastr.error('Tempate Not Found');
	}
});
</script>
@endpush