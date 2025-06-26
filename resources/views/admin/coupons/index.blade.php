@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3 flex-wrap">
        <div class="d-flex">
            <h2 class="heading mb-0">Coupons</h2>
        </div>
        <div class="m-box d-flex">
            <div class="search-wrapper d-flex">
				<form action="{{route('coupons')}}" method="GET" >
					<input type="text" name="search" class="form-control ticket-search" placeholder="Search Here..">
					<button type="submit" class="btn btn-search">Search</button>
				</form>
				<a href="{{route('coupons')}}" class="btn btn-reset btn-main">Reset</a>
            </div>
            <button type="button" class="btn btn-main btn-add-coupon" data-toggle="modal" data-target="#addCouponModal" onclick="openmodal('add');">+ Add Coupon</button>
        </div>
		
    </div>
    <div class="row">
    	<div class="col-md-12">
    		@if($search != '')
			<h3 class="search-for">Search for : {{$search}}</h3>
		@endif
    	</div>
    </div>
    <!-- Tickets Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-scroller">

                <table class="table table-hover attendees-table tickets-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Discount</th>
                            <th>Started at</th>
                            <th>Ending at</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						@if(!empty($data))
							@foreach($data as $key => $value)
							<tr id="{{ $value->id }}">
								<td> {{ ++$key }} </td>
								<td> {{ $value->name }} </td>
								<td> {{ $value->code }} </td>
								<td>
									@if($value->coupon_type == 1)
										<span>Fixed Amount</span>
									@else
										<span>Percentage</span>
									@endif
								</td>
								<td> 
									@if($value->coupon_type == 1)
										<span>₹ {{ $value->amount }}</span>
									@else
										<span>{{ $value->amount }} %</span>
									@endif
									 
								</td>
								<td> {{ $value->ending_at }} </td>
								<td> {{ $value->ending_at }} </td>
								<td> {{ $value->created_at }} </td>
								<td> 
									@if($value->status == 1)
										<span class="activated">Activated</span>
									@else
										<span class="deactivated">Deactivated</span>
									@endif
								</td>
								<td>
									<div class="dropdown ticket-option">
										<button type="button" class="btn btn-default dropdown-toggle"
											data-toggle="dropdown">
											<div class="dot-three"></div>
										</button>
										<div class="dropdown-menu">
											@if($value->status == 1)
											<a class="dropdown-item" onclick="changestatus('0','{{$value->id}}');"><img class="cal-icon" src="{{ asset('public/admin/assets/images/deactivate_icon.svg')}}"> Deactivate</a>
											@else
											<a class="dropdown-item" onclick="changestatus('1','{{$value->id}}');"><img class="cal-icon" src="{{ asset('public/admin/assets/images/activate.svg')}}"> Activate</a>
											@endif
											<a class="dropdown-item" onclick="openmodal('view', '{{$value->id}}');" data-toggle="modal" data-target="#addCouponModal">
												<img class="cal-icon" src="{{ asset('public/admin/assets/images/view_icon.svg')}}"> View
											</a>
											<a class="dropdown-item" onclick="deletecoupon('{{$value->id}}');"><img class="cal-icon" src="{{ asset('public/admin/assets/images/delete_icon.svg')}}"> Delete</a>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						@else
							<tr class="odd gradeX" style="text-align: center;"> <td colspan="8"> No data available in table </td> </tr>
						@endif
                    </tbody>
                </table>
            </div>
			<div class="paging_bootstrap_full_number" id="">
				<ul class="pagination">
					@if($pagination == 'yes')
						{!! $data->links() !!}
					@endif
				</ul>
			</div>
        </div>
    </div>
</div>

<!-- coupon modal -->
<div class="modal right fade" id="addCouponModal">
	<div class="modal-dialog modal-dialog-scrollable">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<div id="modalContent"></div>
	</div>
</div>
<!-- coupon modal -->
@endsection
@push('custom-scripts')

<script type="text/javascript">
$(function () {
	$('.datepicket').datetimepicker();
});

function openmodal(type, id) {
	var url = '';
	
	if(typeof id === 'undefined') {
		var id = '';
	}

	if(type == 'add') {
		url = "{{route('coupons-add')}}";
	} else if(type == 'view') {
		url = "{{route('coupons-view')}}";
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
	var url = "{{route('coupons-status')}}";

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

function deletecoupon(id) {
	var url = "{{route('coupons-delete')}}";

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
			location.reload();
		},
	});
}

//add coupon
$(document).on('click','.submit-btn', function (e) {
	var form = $('#coupondetails')[0];
	var formData = new FormData(form);
	
	$.ajax({
		type:'POST',				
		url: "{{route('coupons-save')}}",
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
//for add coupon
</script>
@endpush