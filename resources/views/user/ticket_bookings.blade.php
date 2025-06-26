@extends('layouts.user')

@section('content')
<div class="container">
	@include('elements.event_info')
	<div class="bg-white p-2 rounded">
		<div class="row g-md-3">
			<div class="col-md-12">
				<div class="p-3 p-lg-4">
					<div class="top-heading">
						<a href="{{route('main')}}" class="btn-back me-3"><img src="{{asset('public/images/back_arrow.svg')}}" alt=""></a> Select
						City
					</div>
					<div class="disclaimer_text">
									<p class="text-primary mb-1">Points to Note:</p>
									<ul>
										<li>Please select the total number of people attending, including yourself.</li>
									</ul>
								</div>
					@php $i=1; @endphp
					@foreach($tickets as $key => $value)
					<div class="d-md-flex align-items-center border-bottom pb-4 mb-4 ticket-type">
						<div class="flex-grow-1">
							<h5 class="mb-0 text-capitalize">
							{{$value['category']}}
							<?php /* <span class="check-b">
									<input type="radio" class="radio-custom" name="" value="">
									<label class="custom-radio-lable fw-6">{{$value['category']}}</label>
                                </span>*/?>
							</h5>
							<?php /*<p class="mb-1 text-muted">{{$value['description']}}</p> */ ?>
						</div>
						<div class="ps-md-4 d-flex align-items-end">
							<div class="text-center me-4">
								<label class="text-muted num_people">Total Pax</label>
								<select class="form-select text-center mw-100 quantity{{$i}} userqty" style=""
									data-package="{{$i}}">
									<option value="0">0</option>
									@for($x=$value['min_qty'];$x<=$value['max_qty'];$x++) <option value="{{$x}}">{{$x}}
										</option>
										@endfor
								</select>
							</div>
							<button class="btn btn-primary w-10 ms-2 add-cart btn{{$i}}" data-id="{{$value['id']}}"
								data-ticketcategory="{{$value['category']}}" data-slug="{{$value['slug']}}"
								data-package="{{$i}}">Proceed</button>

						</div>
					</div>
					@php $i++; @endphp
					@endforeach
				</div>
			</div>
			<!-- <div class="col-md-4">
                <div class="order-summary">
                    <h6 class="mt-md-3 mb-0 text-center">No Items Added</h6>
                    <h4 class="mb-4 text-capitalize text-primary">Order Summary</h4>
                    <div class="flex-grow-1 overflow-auto">
                        <div class="ticket-cart">
                            @php $ammount = []; @endphp
                            @if(isset($_SESSION[$slug]))
                                @foreach($_SESSION[$slug] as $key => $value)
                                <div class="order-item">{{$key}} x {{$value['ticket_quantity']}}
                                    <span class="ms-auto text-nowrap">
                                        @if($value['ticket_price'] == 0) {{'Free'}} @else {{'₹ '.$value['ticket_price']}} @endif
                                    </span>
                                </div>
                                @php
                                    array_push($ammount, $value['ticket_price']);
                                @endphp
                                @endforeach
                            @endif
                        </div>
                        @php $total = array_sum($ammount) @endphp
                        <h5 class="d-md-flex align-items-center">Total <span class="ms-auto text-nowrap text-primary total-ammount">₹ {{$total}}</span></h5>
                    </div>
                    <a href="{{route('bookedTickets', ['slug' => $slug])}}" class="btn btn-primary py-2 w-100">Book Now <i class="bi bi-chevron-right ms-2"></i></a>
                </div>
            </div> -->
		</div>
	</div>
</div>
@include('elements.footer')
@endsection
@section('script')
<script>
$(document).ready(function() {
	$('#selectall').click(function() {
		$('.selectedId').prop('checked', this.checked);
	});

	$(document).on('change', '.userqty', function() {
		var package = $(this).data('package');
		var this_val = $(this).val();

		$('.userqty').val('0');
		$('.add-cart').attr('disabled', 'true');
		$('.quantity' + package).val(this_val);
		$('.btn' + package).removeAttr('disabled');

	});

	$('.add-cart').click(function() {

		var ticket_category = $(this).data('ticketcategory');
		var ticket_id = $(this).data('id');
		var ticket_slug = $(this).data('slug');
		var package_num = $(this).data('package');
		var ticket_quantity = $('.quantity' + package_num).val();


		$.ajax({
			type: 'POST',
			url: "{{route('addToCart')}}",
			data: {
				"_token": "{{ csrf_token() }}",
				ticket_category: ticket_category,
				ticket_slug: ticket_slug,
				ticket_quantity: ticket_quantity
			},

			success: function(response) {
				response = jQuery.parseJSON(response);
				var type = response.type;
				var data = response.data;

				if (type == 'Success') {
					/* $('.ticket-cart').html('');
					const ammount = [];
					$.each( data, function( key, value ) {
					    var price = '';
					    if(value.ticket_price == 0) {
					        price = 'Free';
					    } else {
					        var total = value.ticket_price;
					        price = '₹ '+total;
					        ammount.push(total);
					    }

					    $('.ticket-cart').append('<div class="order-item">'+key+' x '+value.ticket_quantity+' <span class="ms-auto text-nowrap">'+price+'</span></div>');
					});

					let sum = 0;
					for (let i = 0; i < ammount.length; i++) {
					    sum += ammount[i];
					}
					$('.total-ammount').html('₹ '+sum); */
					window.location.href = "../addAttendees/" + ticket_id + "/" +
						ticket_slug;
				} else {
					$('.response_status').css('color', 'red').html(message).show();
				}
			},
		});

	});
});
</script>
@endsection