@extends('admin.layouts.master')
@section('content')
<div class="container">
	<div class="d-flex justify-content-between mb-3">
		<h2 class="heading">Tickets</h2>
	</div>
	<!-- search form  -->
	<div class="d-flex justify-content-between mb-4 mobile-col">
		<div class="search-wrapper d-flex">
			<form id="coupondetails" method="post" enctype="multipart/form-data">
				<input type="search" class="form-control ticket-search" placeholder="Search Here..">
				<button type="submit" class="btn btn-search">Search</button>
			</form>
			<a href="{{route('tickets')}}" class="btn btn-reset btn-main">Reset</a>
		</div>
		<button type="button" class="btn btn-main btn-add-ticket" data-toggle="modal" data-target="#ticketModal" onclick="openmodal('add');">+ Add Ticket</button>
	</div>
	<div class="row">
    	<div class="col-md-12">
    		
			<h3 class="search-for">Search for : addf</h3>
		
    	</div>
    </div>
<!-- Tickets Table -->
<div class="row">
<div class="col-md-12">
    <div class="table-scroller">
        <table class="table table-hover tickets-table" id="" width="100%">
          
            <tbody>
				@foreach($tickets as $key => $value)
				<tr>
					<td><span class="semi-18">{{$value->name}}</span><br><span class="text-light">{{$value->category}}</span></td>
					<td>₹ {{$value->price}}</td>
					<td>INR</td>
					<td>1/100</td>
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
							<a class="dropdown-item" onclick="openmodal('view', '{{$value->id}}');" data-toggle="modal" data-target="#ticketModal">
								<img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View
							</a>
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Edit</a>
							@if($value->status == 1)
							<a class="dropdown-item" onclick="changestatus('0','{{$value->id}}');"><img class="cal-icon" src="{{ asset('public/admin/assets/images/deactivate_icon.svg')}}"> Deactivate</a>
							@else
							<a class="dropdown-item" onclick="changestatus('1','{{$value->id}}');"><img class="cal-icon" src="{{ asset('public/admin/assets/images/activate.svg')}}"> Activate</a>
							@endif
							<a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/delete_icon.svg')}}"> Delete</a>
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
				{!! $tickets->links() !!}
			@endif
		</ul>
	</div>
    </div>
    </div>
</div>

<!-- tickets modal -->
<div class="modal right fade" id="ticketModal">
	<div class="modal-dialog modal-dialog-scrollable">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<div id="modalContent"></div>
	</div>
</div>
<!-- tickets modal -->
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
</script>
@endpush