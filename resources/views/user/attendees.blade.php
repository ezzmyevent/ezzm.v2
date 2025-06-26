@extends('layouts.user')

@section('content')
<div class="container">
	@include('elements.event_info')
	<div class="bg-white p-2 rounded">
		<div class="row g-3" id="main-section">
			<div class="col-md-12">
				<form id="user_details" method="post" enctype="multipart/form-data">
					@CSRF
					<div class="p-3 p-lg-4 pb-0">
						<div class="d-flex align-items-center mb-4">
							<div class=" flex-grow-1">
								<div class="top-heading mb-0">
									<a href="{{route('ticketBookings', ['slug' => $slug])}}" class="btn-back me-3"><img src="{{asset('public/images/back_arrow.svg')}}" alt=""></a>
									<h5 class="mb-0">{{$ticket_details->category}}</h5>
								</div>
								<br>
								<div class="disclaimer_text">
									<p class="text-primary mb-1">Points to Note:</p>
									<ul>
										<li>1. HSBC employees to register with their official email ID and also enter their PSID.</li>
										<li>2. Non-employees should register with their personal email ID.</li>
									</ul>
								</div>

							</div>
							<!-- <div class="employee_tab">
								<input type="radio" class="btn-check employeetype" name="employee_type" id="employee"
									value="Employee">
								<label class="btn btn-secondary" for="employee">Employee</label>

								<input type="radio" class="btn-check employeetype" name="employee_type"
									id="non_employee" value="Non Employee" checked>
								<label class="btn btn-secondary" for="non_employee">Non Employee</label>
							</div> -->
						</div>
						<div class="accordion" id="accordionExample">
							<input name="total_attendees" type="hidden"
								value="{{$_SESSION[$slug][$ticket_details->category]['ticket_quantity']}}">
							<input name="slug" type="hidden" value="{{$slug}}">
							<input name="category" type="hidden" value="{{$ticket_details->category}}">
							<input name="ticket_id" type="hidden" value="{{$ticket_details->id}}">

							@for($i=1; $i<=$_SESSION[$slug][$ticket_details->category]['ticket_quantity'];$i++)
								<button
									class="accordion-button accordion-btn{{$i}} text-secondary bg-light rounded mb-3"
									type="button" data-bs-toggle="collapse" data-bs-toggle="collapse"
									data-bs-target="#collapse{{$i}}"
									aria-expanded="@if($i==1) {{'true'}} @else {{'false'}} @endif"
									aria-controls="collapse{{$i}}">
									<i class="bi bi-check-circle-fill text-light-new me-2 check-btn{{$i}} @if(isset($_SESSION[$slug][$ticket_details->category]['user_details']['attendee'.$i]) && $_SESSION[$slug][$ticket_details->category]['user_details']['attendee'.$i]['name'] != '') text-success @endif"></i>
									@if($i == 1)
									Your Details
									@else
									Attendee {{$i}} Details
									@endif
								</button>
								<div id="collapse{{$i}}"
									class="accordion-sec{{$i}} accordion-collapse collapse @if($i==1) {{'show'}} @endif"
									aria-labelledby="heading{{$i}}" data-bs-parent="#accordionExample">
									<div class="accordion-body px-0">
										@php
											$selected = '';
											$user_details = [];
											if(isset($_SESSION[$slug][$ticket_details->category]['package_summary']['attendee'.$i]))
											{
											$selected =
											$_SESSION[$slug][$ticket_details->category]['package_summary']['attendee'.$i]['type'];
											}

											if(isset($_SESSION[$slug][$ticket_details->category]['user_details'])) {
											$user_details = $_SESSION[$slug][$ticket_details->category]['user_details'];
											}

											$total_attendee_qty = $_SESSION[$slug][$ticket_details->category]['ticket_quantity'];
										@endphp
										<input name="attendee{{$i}}[attendee_count]" type="hidden" value="{{$i}}">

										@if($i == 1)

										<div class="row gx-lg-5">
											<input name="attendee{{$i}}[user_type]" type="hidden" value="Master">
											<div class="col-md-6">
												<div class="mb-4">
													<label class="form-label required">Name</label>
													<input name="attendee{{$i}}[name]" id="name" type="text"
														placeholder="Type here" class="form-control"
														value="@if(isset($user_details['attendee'.$i]['name'])) {{$user_details['attendee'.$i]['name']}} @endif">
													<span class="error-message"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="mb-4">
													<label class="form-label required">Email</label>
													<input name="attendee{{$i}}[email]" id="email" type="text"
														placeholder="Type here" class="form-control"
														value="@if(isset($user_details['attendee'.$i]['email'])) {{$user_details['attendee'.$i]['email']}} @endif">
													<span class="error-message"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="mb-4">
													<label class="form-label">PS ID</label>
													<input name="attendee{{$i}}[employee_code]" id="employee_code"
														placeholder="Type here" type="text" class="form-control"
														value="@if(isset($user_details['attendee'.$i]['employee_code'])) {{$user_details['attendee'.$i]['employee_code']}} @endif">
													<span class="error-message"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="mb-4">
													<label class="form-label required">Preferred Time Of Arrival</label>
													<input type="hidden" name="time_slot_qty" id="time_slot_qty" value="@if(isset($user_details['attendee'.$i]['time_slot']) && isset($ticket_slots[$user_details['attendee'.$i]['time_slot']])){{$ticket_slots[$user_details['attendee'.$i]['time_slot']]}}@endif">
													<select name="attendee{{$i}}[time_slot]" class="form-select"
														id="time_slot" data-attendee="{{$i}}">
														<option value="">Select Time Slot</option>
														@foreach($ticket_slots as $key => $value)
														<option value="{{$key}}"
															@if(isset($user_details['attendee'.$i]['time_slot']) &&
															$user_details['attendee'.$i]['time_slot']==$key)
															{{'selected'}} @endif @if($value < $total_attendee_qty) disabled @endif data-qty="{{$value}}">{{$key}}</option>
														@endforeach

													</select>
													<span class="error-message"></span>
												</div>
											</div>
										</div>
										@else
										<div class="row gx-lg-5">

											<div class="col-md-6">
												<div class="mb-4">
													<label class="form-label required">Accompanied By</label>
													<select name="attendee{{$i}}[user_type]"
														class="form-select usertype" id="user_type"
														data-attendee="{{$i}}">
														<option value="">Select</option>
														<option value="Partner"
															@if(isset($user_details['attendee'.$i]['user_type']) &&
															$user_details['attendee'.$i]['user_type']=='Partner' )
															{{'selected'}} @endif>Partner</option>
														<option value="Children"
															@if(isset($user_details['attendee'.$i]['user_type']) &&
															$user_details['attendee'.$i]['user_type']=='Children' )
															{{'selected'}} @endif>Children</option>
														<option value="Parents"
															@if(isset($user_details['attendee'.$i]['user_type']) &&
															$user_details['attendee'.$i]['user_type']=='Parents' )
															{{'selected'}} @endif>Parents</option>
														<option value="Parents_in_law"
															@if(isset($user_details['attendee'.$i]['user_type']) &&
															$user_details['attendee'.$i]['user_type']=='Parents_in_law' )
															{{'selected'}} @endif>Parents-in-law</option>


													</select>
													<span class="error-message"></span>
												</div>
											</div>

											<div class="col-sm-12 mb-4" style="display:none;">
												<div class="order-summary p-4">
													<div class="row">

														<div class="col-12 col-sm-4 col-md-3" id="age_group_sec{{$i}}"
															@if(isset($user_details['attendee'.$i]['user_type']) &&
															$user_details['attendee'.$i]['user_type']=='Children' )
															style="display:block;" @else style="display:none;" @endif>
															<div class="mb-2">
																<label class="form-label required">Age</label>
																<input name="attendee{{$i}}[age_group]" id="age_group{{$i}}"
																	type="text" class="form-control"
																	data-attendee="{{$i}}"
																	value="@if(isset($user_details['attendee'.$i]['age_group'])) {{$user_details['attendee'.$i]['age_group']}} @endif">
																<span class="error-message"></span>
															</div>
														</div>
														<div class="col-12 col-sm-8 col-md-6">
															<div class="mb-2">
																<label class="form-label required">Name</label>
																<input name="attendee{{$i}}[name]" id="name{{$i}}"
																	type="text" class="form-control"
																	data-attendee="{{$i}}"
																	value="@if(isset($user_details['attendee'.$i]['name'])) {{$user_details['attendee'.$i]['name']}} @endif">
																<span class="error-message"></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										@endif

										<div class="row">
											<div class="col-sm-12 col-md-12 col-lg-12 text-end mb-3">
												@if($i != 1)
												<button class="btn btn-outline-danger px-4 me-2 remove-item"
													data-slug="{{$slug}}" data-category="{{$ticket_details->category}}"
													data-type="Remove-Attendee" data-attendee="{{$i}}">Remove</button>
												@endif
												@php
												$attendee_count = count($user_details)+1;
												@endphp
												@if($i !=
												$_SESSION[$slug][$ticket_details->category]['ticket_quantity'])
												<button class="btn btn-outline px-4 submit-btn formsubmit submitbtn{{$i}}"
													data-type="Next" data-slug="{{$slug}}"
													data-category="{{$ticket_details->category}}" data-attendee="{{$i}}"
													@if($i > $attendee_count) {{'disabled'}} @endif>
													Save <i class="bi bi-chevron-right ms-2 ms-2"></i>
												</button>
												@else
												<button class="btn btn-primary px-3 submit-btn formsubmit submitbtn{{$i}}"
													data-type="Submit" data-slug="{{$slug}}"
													data-category="{{$ticket_details->category}}" data-attendee="{{$i}}"
													@if($i > $attendee_count) {{'disabled'}} @endif>
													Submit <i class="bi bi-chevron-right ms-2 ms-2"></i>
												</button>
												@endif

											</div>
										</div>
									</div>
								</div>
								@endfor
						</div>
					</div>
				</form>
			{{--@if($_SESSION[$slug][$ticket_details->category]['ticket_quantity']
				< $ticket_details->max_qty)
                <div class="shadow-box d-flex align-items-center justify-content-between p-3">
                    <button class="btn btn-outline-primary px-3 me-2 add-new-attendee" data-slug="{{$slug}}" data-categoryid="{{$ticket_details->id}}">ADD NEW ATTENDEE</button>
                </div>
                @endif--}}
            </div>
            <!-- <div class="col-md-4">
                <div class="order-summary">
                    <h6 class="mt-md-3 mb-0 text-center">No Items Added</h6>
                    <h4 class="mb-4 text-capitalize text-primary">Package Summary</h4>
                    <div class="flex-grow-1 overflow-auto" id="package-summary">
                        @if(empty($_SESSION[$slug][$ticket_details->category]['package_summary']))
                            <div class="ticket-cart">
                                <div class="order-item">{{$ticket_details->category}} x {{$_SESSION[$slug][$ticket_details->category]['ticket_quantity']}}
                                    <span class="ms-auto text-nowrap">
                                        @if($_SESSION[$slug][$ticket_details->category]['ticket_price'] == 0) {{'Free'}} @else {{'₹ '.$_SESSION[$slug][$ticket_details->category]['ticket_price']}} @endif
                                    </span>
                                </div>
                            </div>
                            <h5 class="d-md-flex align-items-center">Total <span class="ms-auto text-nowrap text-primary total-ammount">{{'₹ '.$_SESSION[$slug][$ticket_details->category]['ticket_price']}}</span></h5>
                        @else
                            @php $ammount = []; @endphp
                            @foreach($_SESSION[$slug][$ticket_details->category]['package_summary'] as $key => $value)
                                <div class="order-item">{{$value['user']}} x 1
                                    <span class="ms-auto text-nowrap">
                                        @if($value['ticket_price'] == 0) {{'Free'}} @else {{'₹ '.$value['ticket_price']}} @endif
                                    </span>
                                </div>
                                @php
                                    array_push($ammount, $value['ticket_price']);
                                @endphp
                            @endforeach
                            @php $total = array_sum($ammount) @endphp
                            <h5 class="d-md-flex align-items-center">Total <span class="ms-auto text-nowrap text-primary total-ammount">₹ {{$total}}</span></h5>
                        @endif
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
@include('elements.footer')
@endsection
@section('script')
<script>
$(document).ready(function () {
    //manage package order summary
    $(document).on('change','.usertype', function () {
        var attendee = $(this).data('attendee');
        var user_type = $(this).val();

        if(user_type == 'Children') {
            $('#age_group_sec'+attendee).show();
        } else {
            $('#age_group_sec'+attendee).hide();
        }

        /* $.ajax({
            type:'POST',
            url: "{{route('managePackageSummary')}}",
            data: {"_token": "{{ csrf_token() }}",ticket:ticket,attendee:attendee,age_group:age_group},

            success:function(response)
            {
                response = jQuery.parseJSON(response);
                var type = response.type;
                var data = response.data;

                $( "#package-summary" ).load(window.location.href + " #package-summary" );
            },
        }); */
    });

	$(document).on('change','#time_slot', function () {
        var time_slot_qty = $(this).find(':selected').attr('data-qty');
		$('#time_slot_qty').val(time_slot_qty);
    });

    /* $(document).on('click','.employeetype', function () {
        var user_type = $(this).val();

        if(user_type == 'Employee') {
            $('#employee_code_sec').show();
        } else {
            $('#employee_code_sec').hide();
        }
    }); */

    //manage user details
    $(document).on('click','.submit-btn', function (e)
    {
		

        var btn_type = $(this).data('type');
        var attendee = $(this).data('attendee');
        var slug = $(this).data('slug');
        var form = $('#user_details')[0];
        var formData = new FormData(form);
        formData.append('type', btn_type);
        formData.append('attendee_num', attendee);

		if(btn_type == 'Submit') {
			$('.formsubmit').addClass('disabled');
		}

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type:'POST',
            url: "{{route('manageUserDetails')}}",
            data:formData,
            contentType: false,
            processData: false,
            success:function(response)
            {
                //response = jQuery.parseJSON(response);
                var type = response.type;
                var message = response.message;
                var next_attendee = attendee+1;


                if($.isEmptyObject(response.error)){
                    //accordian close
                    $(".accordion-btn"+attendee).removeClass('collapsed');
                    $(".accordion-btn"+attendee).attr('aria-expanded', 'false');
                    $(".accordion-sec"+attendee).removeClass('show');
                    //next accordian close
                    $(".accordion-btn"+next_attendee).addClass('collapsed');
                    $(".accordion-btn"+next_attendee).attr('aria-expanded', 'true');
                    $(".accordion-sec"+next_attendee).addClass('show');

					$(".check-btn"+attendee).addClass('text-success');

                    $('.submitbtn'+next_attendee).removeAttr("disabled");

                }else{
                    console.log(response.error);
                    $.each( response.error, function( key, value ) {
                        toastr.error(value);
                    });
                }

                if(type == "Success-submit") {
                    window.location.href="{{route('success')}}/"+response.user_id;
                }

                //$( "#user-section" ).load(window.location.href + " #user-section" );
            },

        });
        e.preventDefault();
    });

    //select country ajax
    $(document).on('change','.country', function()
    {
        var country_id =  $('option:selected', this).data('id');
        var attendee =  $(this).data('attendee');

        $.ajax({
            url: "{{route('ajaxstate')}}",
            type: "POST",
            data: {"_token": "{{ csrf_token() }}",country_id: country_id},
            cache: false,
                success: function(result){
                $("#state"+attendee).html(result);
            }
        });
    });

    //unique phone number check
    $(document).on('keyup','.mobile', function()
    {
        var phone_number =  $(this).val();
        var attendee =  $(this).data('attendee');

        let duplicates = []
        var all_phone = $('.mobile').map((_,el) => el.value).get();
        $.each( all_phone, function( key, value ) {
            if(phone_number == value) {
                duplicates.push(key+1);
            }
        });

        if(duplicates.length >= 2) {
            $('.mobile-error'+attendee).html('&#x2717; Duplicate number').css('color', 'red');
            $('.submitbtn'+attendee).attr("disabled", 'true');
        } else {
            $('.mobile-error'+attendee).html('&#10004; Valid').css('color', 'green');
            $('.submitbtn'+attendee).removeAttr("disabled");
        }
    });

    //unique phone number check
    $(document).on('click','.festival_dates', function()
    {
        var checked = $(this).val();
        var day_quantity =  $(this).data('dayqty');
        var attendee =  $(this).data('attendee');

        var checked_dates = $('.dates'+attendee+':checkbox:checked').length;

        if(checked_dates > day_quantity) {
            var error_msg = '';
            if(day_quantity == 1) {
                error_msg = 'You can select only '+day_quantity+' day.';
            } else {
                error_msg = 'You can select only '+day_quantity+' days.';
            }
            $(this).prop('checked', false);
            toastr.error(error_msg);
        }

    });

    //add new attendees
    $(document).on('click','.add-new-attendee', function (e) {
        var category_id = $(this).data('categoryid');
        var slug = $(this).data('slug');

		var total_attendee_qty = "{{$total_attendee_qty}}";
		var total_slot_qty = $("#time_slot_qty").val();

		if(parseInt(total_attendee_qty) < parseInt(total_slot_qty)) {
			if(category_id != '') {
				$.ajax({
					type:'POST',
					url: "{{route('addNewAttendeeToCart')}}",
					data: {"_token": "{{ csrf_token() }}",slug:slug,category_id:category_id},

					success:function(response)
					{
						response = jQuery.parseJSON(response);
						var type = response.type;
						var message = response.message;

						if(type == 'Success') {
							location.reload();
						} else {
							toastr.error(message);
						}
					},
				});
				e.preventDefault();
			}
		} else {
			Swal.fire(
				'Error',
				'The selected time slot quantity limit has been reached. Please select another time slot to add more attendees.',
				'error'
			)
		}
    });

    //remove attendees
    $(document).on('click','.remove-item', function (e) {
        var category = $(this).data('category');
        var slug = $(this).data('slug');
        var btn_type = $(this).data('type');
        var attendee = $(this).data('attendee');
        var mobile = $('#mobile'+attendee).val();

        if(category != '') {
            $.ajax({
                type:'POST',
                url: "{{route('removeToCart')}}",
                data: {"_token": "{{ csrf_token() }}",slug:slug,category:category,type:btn_type,attendee:attendee,mobile:mobile},

                success:function(response)
                {
                    response = jQuery.parseJSON(response);
                    var type = response.type;
                    var message = response.message;

                    if(type == 'Success') {
                        //$("#main-section").load(window.location.href + "#main-section");
                        location.reload();
                    }
                },
            });
        }
        e.preventDefault();
    });
});
</script>
@endsection