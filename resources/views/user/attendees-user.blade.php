@extends('layouts.user')

@section('content')
<div class="container">
	@include('elements.event_info')
	<div class="bg-white p-2 rounded">
		<div class="row g-3" id="main-section">
			<div class="col-md-12">
				<div class="p-3 p-lg-4">
					<div class="top-heading">
						<a href="{{route('main')}}" class="btn-back me-3"><img src="{{asset('public/images/back_arrow.svg')}}" alt=""></a> Back
					</div>
					
					<form id="activity_details" method="post" enctype="multipart/form-data">
						<div class="login_form_selection">
							<input type="hidden" name="user_id" value="{{$user_details->id}}" id="user_id">
							<div class="row justify-content-center">
                            <!-- <h3>Attendees Fields to be as follows </h3> -->
								<div class="col-lg-4 mb-4">
									<div class="border border-dark py-3 px-2 rounded h-100">
									<div class="vh_custom px-2">
											<h5 class="mt-0 mb-1 fw-5">Employee ID:</h5>
											<p class="mb-3 mb-lg-4">{{$user_details->emp_code}}</p>
											<h5 class="mt-0 mb-1 fw-5">Name:</h5>
											<p class="mb-3 mb-lg-4">{{$user_details->name}}</p>
											<h5 class="mt-0 mb-1 fw-5">Email:</h5>
											<p class="mb-3 mb-lg-4">{{ $user_details->email }}</p>
											<h5 class="mt-0 mb-1 fw-5">Event Date:</h5>
											<p class="mb-0"><strong style="color: #0f52fb;">25th March 2025</strong></p>
										</div>
									</div>
								</div>
								<div class="col-lg-8 mb-4">
									<div class="border border-dark py-3 px-2 rounded h-100">
										
										<div class="vh_custom px-2">
											
											<table class="table table-sm table-borderless mb-3">
												<thead>
													
												</thead>
												<tbody>
													
													<tr>
														<td>
															Whatsapp No.<span style="color:red;">*</span>
														</td>
														<td colspan="2">
															<input type="hidden" name="country_code" value="+91" id="country_code">
															
															<input type="text" class="form-control" name="mobile" id="mobileInput" value="{{ $user_details->phone }}" maxlength="10" pattern="\d{10}" placeholder="9999999999" onkeypress="return isNumber(event)" >

														</td>
													</tr>
													<tr>
														<td colspan="2">
															<h6 class="text-primary">Guest Details*:
															</h6>
														</td>
														<td>
															<h6 class="text-primary">Name of Guest* :
															</h6>
														</td>
													</tr>
													<tr>
														<td>
															Adult 1
														</td>
														<td>
															<select class="form-select adults" name="adult_1">
																<option value="Spouse" <?= $user_details->adult_1 == 'Spouse' ? 'selected':''; ?>>Spouse</option>
																<option value="Father" <?= $user_details->adult_1 == 'Father' ? 'selected':''; ?>>Father</option>
																<option value="Mother" <?= $user_details->adult_1 == 'Mother' ? 'selected':''; ?>>Mother</option>
																<option value="Father-in-law" <?= $user_details->adult_1 == 'Father-in-law' ? 'selected':''; ?>>Father-in-law</option>
																<option value="Mother-in-law" <?= $user_details->adult_1 == 'Mother-in-law' ? 'selected':''; ?>>Mother-in-law</option>
																<option value="No" <?= !in_array($user_details->adult_1, ['Father', 'Mother','Spouse',
																	'Father-in-law', 'Mother-in-law']) ? 'selected':''; ?>>No</option>
                                                            </select>
														</td>
                                                        <td><input type="text" class="form-control" name="guest1_name"  value="{{$user_details != null ? $user_details->guest1_name:''}}" placeholder="Enter Adult 1 Name"></td>

													</tr>
													<tr>
														<td>
															Adult 2
														</td>
														<td>
														<select class="form-select adults" name="adult_2">
																<option value="Spouse" <?= $user_details->adult_2 == 'Spouse' ? 'selected':''; ?>>Spouse</option>
																<option value="Father" <?= $user_details->adult_2 == 'Father' ? 'selected':''; ?>>Father</option>
																<option value="Mother" <?= $user_details->adult_2 == 'Mother' ? 'selected':''; ?>>Mother</option>
																<option value="Father-in-law" <?= $user_details->adult_2 == 'Father-in-law' ? 'selected':''; ?>>Father-in-law</option>
																<option value="Mother-in-law" <?= $user_details->adult_2 == 'Mother-in-law' ? 'selected':''; ?>>Mother-in-law</option>
																<option value="No" <?= !in_array($user_details->adult_2, ['Father', 'Mother','Spouse', 
																'Father-in-law', 'Mother-in-law']) ? 'selected':''; ?>>No</option>
															</select>
														</td>
                                                        <td><input type="text" class="form-control" name="guest2_name"  value="{{$user_details != null ? $user_details->guest2_name:''}}" placeholder="Enter Adult 2 Name"></td>
													</tr>
													<tr>
														<td>
															Adult 3
														</td>
														<td>
															
														<select class="form-select adults" name="spouse">
															<option value="Spouse" <?= $user_details->spouse == 'Spouse' ? 'selected':''; ?>>Spouse</option>
																<option value="Father" <?= $user_details->spouse == 'Father' ? 'selected':''; ?>>Father</option>
																<option value="Mother" <?= $user_details->spouse == 'Mother' ? 'selected':''; ?>>Mother</option>
																<option value="Father-in-law" <?= $user_details->spouse == 'Father-in-law' ? 'selected':''; ?>>Father-in-law</option>
																<option value="Mother-in-law" <?= $user_details->spouse == 'Mother-in-law' ? 'selected':''; ?>>Mother-in-law</option>
																<option value="No" <?= !in_array($user_details->spouse, ['Father', 'Mother','Spouse', 
																'Father-in-law', 'Mother-in-law']) ? 'selected':''; ?>>No</option>
                                                            </select>
														</td>
                                                        <td><input type="text" class="form-control" name="guest3_name"  value="{{$user_details != null ? $user_details->guest3_name:''}}" placeholder="Enter Adult 3 Name"></td>

													</tr>
													<tr>
														<td>
															Kid 1
														</td>
														<td>
															<select class="form-select" name="kid_1">
																<option value="0-6" <?= $user_details->kid_1 == '0-6' ? 'selected':''; ?>>0-6</option>
																<option value="7-12" <?= $user_details->kid_1 == '7-12' ? 'selected':''; ?>>7-12</option>
																<option value="13-18" <?= $user_details->kid_1 == '13-18' ? 'selected':''; ?>>13-18</option>
																<option value="No" <?= $user_details->kid_1 == 'No' || $user_details->kid_1 == Null ? 'selected':''; ?>>No</option>
															</select>
														</td>
                                                        <td><input type="text" class="form-control" name="kid1_name" value="{{$user_details != null ? $user_details->kid1_name:''}}" placeholder="Enter Kid 1 Name"></td>

													</tr>
													<tr>
														<td>
															Kid 2
														</td>
														<td>
															<select class="form-select" name="kid_2">
																<option value="0-6" <?= $user_details->kid_2 == '0-6' ? 'selected':''; ?>>0-6</option>
																<option value="7-12" <?= $user_details->kid_2 == '7-12' ? 'selected':''; ?>>7-12</option>
																<option value="13-18" <?= $user_details->kid_2 == '13-18' ? 'selected':''; ?>>13-18</option>
																<option value="No" <?= $user_details->kid_2 == 'No' || $user_details->kid_2 == Null ? 'selected':''; ?>>No</option>
															</select>
														</td>
                                                        <td><input type="text" class="form-control" name="kid2_name" value="{{$user_details != null ? $user_details->kid2_name:''}}" placeholder="Enter Kid 2 Name"></td>
													</tr>
												</tbody>
											</table>
											
										</div>
									</div>
								</div>
								
							</div>
							
							@if($user_details->attendees==0)
							<div class="col-sm-12 col-md-12 text-center" id="remove_submit">
								<button class="btn btn-primary px-3 submit-btn_attend submitbtn1" data-type="Submit"
								data-slug="CityRegistration" data-category="Mumbai" data-attendee="1">
								Submit
								</button>
							</div>
							@else
							<div class="col-sm-12 col-md-12 text-center">
								<button class="btn btn-primary submit-btn_attend px-3" type="button">
								Check & Resubmit
								</button>
							</div>
							@endif
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
@include('elements.footer')
@endsection
@section('script')
<script>



function updateOptions() {
    const selects = document.querySelectorAll('.adults');
    const selectedValues = Array.from(selects).map(select => select.value);

    selects.forEach(select => {
        const options = select.querySelectorAll('option');

        options.forEach(option => {
            if (option.value !== "No") {
                // Hide options that are selected in other dropdowns
                option.style.display = selectedValues.includes(option.value) && select.value !== option.value
                    ? 'none' : 'block';
            }
        });
    });
}

// Attach event listeners to all the select elements
document.querySelectorAll('.form-select').forEach(select => {
    select.addEventListener('change', updateOptions);
});

// Call the function initially to set the state based on current selections
updateOptions();

	
	var input1 = document.querySelector("#mobileInput");
	window.intlTelInput(input1,({
		autoHideDialCode: false,
		autoPlaceholder: "off",
		nationalMode: true,
		separateDialCode: true,
		initialCountry: 'in',
		preferredCountries: ["in"]
	}));
	var iti1 = window.intlTelInputGlobals.getInstance(input1);
	input1.addEventListener("countrychange", function() {
		var a=  iti1.getSelectedCountryData();
		$('#country_code').val('+'+a.dialCode);

	});
	

	$(document).on('click', '.submit-btn_attend', function (e) {
        e.preventDefault(); // Prevent default form submission

        // Collect Form Data
        var form = $('#activity_details')[0];
        var formData = new FormData(form);

        // AJAX Setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Disable the button and show loader
        $('.submit-btn_attend').attr('disabled', true);
        $('body').addClass('body-loader');
        $('.lds-hourglass').show();

        // AJAX Request
        $.ajax({
            type: 'POST',
            url: "{{ route('saveAttendees') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('.submit-btn_attend').attr('disabled', false);

                if (response.type === 'Success') {
                    toastr.success(response.message); // Success message
					var userId = '{{ Session::get("user") }}';
                    window.location.href = "{{ route('thanksActivity') }}";
                } else if (response.error) {
                    $.each(response.error, function (key, value) {
                        toastr.error(value); // Display validation errors
                    });
                } else {
                    toastr.error('Something went wrong. Please try again!');
                }
            },
            error: function (xhr, status, error) {
                $('.submit-btn').attr('disabled', false);
                toastr.error('An unexpected error occurred: ' + error); // Display error message
            },
            complete: function () {
                $('.lds-hourglass').hide();
                $('body').removeClass('body-loader');
            }
        });
    });
    function checkAvailSlot(self){
    	var slot = $(self).val();
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type:'POST',
            url: "{{route('checkAvailSlots')}}",
            data:{'slot':slot,'user_id':"{{$user_details->id}}",'date':"{{$user_details->date}}",'_token':"{{csrf_token()}}"},
            success:function(response)
            {
            	if(response.type == 'success'){
            		$('#remove_submit').show();
            	}else if(response.type == 'error'){
            		toastr.error('This slot is full.Please choice other slot');
            		$('#remove_submit').hide();
            	}else if(response.type == 'empty'){
            		$('#remove_submit').hide();
            		toastr.error('Slot is required.');
            	}
            },

        });
    }

	function isNumber(evt) {
	    evt = (evt) ? evt : window.event;
	    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	        return false;
	    }
	    return true;
	}
</script>
@endsection
