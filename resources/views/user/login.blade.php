@extends('layouts.user')

@section('content')
<div class="container">
	@include('elements.event_info')
	<div class="bg-white p-2 rounded">
		<div class="row g-3" id="main-section">
			<div class="col-md-12">

				<div class="p-3 p-lg-4">
					<div class="top-heading">
						<a href="{{route('main')}}" class="btn-back me-3"><img src="{{asset('public/images/back_arrow.svg')}}" alt=""></a> Home
					</div>
	
                   <input type="hidden" id="userid">
					<div class="login_form">
						<div class="d-flex justify-content-center align-items-center">
						<h4 class="text-center login_heading pt-4">Login				</h4>
			            <div class="hover-container">
                            <img src="{{asset('public/images/i-icon.png')}}" alt="" class="img-fluid">
                            <div class="popup" id="popup">
                                <div class="popup-content">
                                    <ol>
                                        <li>Login with your official email id.</li>
                                        <li>Avoid typographical errors or spacing while entering your email id.</li>
                                        <li>Check your Email Inbox,Spam or Others Folder for One Time Password (OTP).</li>
                        </ol>
                                
                                </div>
                            </div>
                        </div>
                        </div>
						<!-- <p class="text-center">Please enter your Email ID in UPPERCASE</p> -->
						<div class="row justify-content-center">
							<div class="col-md-6">
								<div class="bg-light rounded p-3 my-3 mt-lg-4 mb-lg-5 login_w">

									<div class="mb-3 mt-3">
										<label for="email" class="form-label mb-2">Enter your work email id</label>
										<input type="text" class="form-control" id="email" placeholder="" name="email">
									</div>
									<div class="mb-3 mt-3 d" id="optdiv" style="display:none">
										<label for="opt" class="form-label mb-2 W-100 d-flex justify-content-between flex-wrap" style="width:100%">Enter OTP</label>
										<div class="position-relative"><button id="resend-otp-btn">Resend OTP</button></span><input type="text" class="form-control" id="otp" placeholder="" name="otp"></div>
									</div>
									<div class="text-center">
										<button class="btn btn-primary px-3 mt-3 submit-btn" id="loginbtn">
											Login
										</button>
										<button class="btn btn-primary px-3 mt-3 submit-btn1" style="display:none" id="verifyotp">
											Verify OTP
										</button>
									</div>
									
								</div>

							</div>

						</div>

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
	$(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
	$('#resend-otp-btn').click(function() {
            $.ajax({
                type: 'POST',
                url: "{{ route('resendOTP') }}",
                success: function(response) {
                    if (response.message) {
                        toastr.success(response.message);
                    } else if (response.error) {
                        toastr.error(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX error if needed
                }
            });
        });
	$(document).on('click','.submit-btn', function (e)
    {
        var email = $('#email').val();
		var otp = $('#otp').val();
        var self = $(this);
        self.text('Login...');
        self.prop('disabled',true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          
		$.ajax({
			type:'POST',
			url: "{{route('login')}}",
			data:{email:email,otp:otp},
			success:function(response)
			{
				//response = jQuery.parseJSON(response);
				var type = response.type;
				var message = response.message;
				self.text('Login');
        		self.prop('disabled',false);
				userid=response.user_id;
				$('#userid').val(userid);
				if(message=="User found successfully")
				{
					toastr.success("OTP sent successfully");
					$('#otp').val('');
					$('#optdiv').show();
					$('#loginbtn').hide();
					$('#verifyotp').show();
					$("#email").prop("readonly", true);
				}
        		// Swal.fire(
                //         'Online Registration is closed.',
                //         'error'
                //     )

        		// Swal.fire(
                //         {
                //           position: 'center',
                //           icon: 'error',
                //           title: "Online registration is closed.",
                //           showConfirmButton: false,
                //           showCancelButton: true,
                //           allowOutsideClick: false
                //       }
                //     );
				if($.isEmptyObject(response.error)){
					if(type == "Success") {
						// window.location.href="{{route('loginSelectUser')}}/"+response.user_id;
					}

				}else{
					$.each( response.error, function( key, value ) {
						if(value=="Invalid email.")
						{
							$('#optdiv').hide();
						}
						toastr.error(value);
					});
				}
			},

		});
		e.preventDefault();
    });


	$(document).on('click', '.submit-btn1', function (e) {

        var otp = $('#otp').val();
		var userids=$('#userid').val();
        var self = $(this);
        self.text('Verifying...');
        self.prop('disabled', true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('verifyOTP') }}", // Define your verification route
            data: { otp: otp},
            beforeSend: function() {
				// setting a timeout
				$('body').addClass('body-loader');
				$('.lds-hourglass').show();
			},
            success: function (response) {
                var type = response.type;
                var message = response.message;
                self.text('Verify OTP');
                self.prop('disabled', false);
                if (message == "OTP verified successfully") {
					var userId = '{{ Session::get('user') }}';
					// window.location.href="{{route('loginSelectUser')}}/"+userids;
                    if(response.attend == 2)
					   {
                        window.location.href="{{route('thanks')}}";
                       }
                       else if(response.attend == 1 && (response.updateStatus == 0 ||  response.updateStatus == 1))
                       {
                        window.location.href="{{route('attendeesUser')}}/"+userids;
                       }
                        else if(response.attend == 1)
                        {
                            window.location.href="{{route('thanksActivity')}}";
                        }
                        else
                        {
                            window.location.href="{{route('event-status')}}/"+userids;
                        }

                } else {
                    toastr.error(response.error);
					
                }
            },
			complete: function(data) {
				$('.lds-hourglass').hide();
	    	},
        });
        //e.preventDefault();
    });
</script>
<style>
	/* Styles for the container */
.hover-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

/* Styles for the popup */
.popup {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    padding: 10px;
    border-radius: 5px;
    display: none;
    z-index: 1;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
}

/* Show the popup on hover */
.hover-container:hover .popup {
    display: block;
}

/* Styles for the popup content */
.popup-content {
    font-size: 12px;
    width: 390px;
    padding: 0px 12px;
    text-align: left;
    font-weight: 400;
    border-color: #fff;
}
/* Styles for the key point */
.popup::before {
    content: '';
    position: absolute;
    top: -10px;
    left: 50%;
    margin-left: -10px;
    border-width: 10px;
    border-style: solid;
    border-color: transparent transparent #fff transparent;
}
.hover-container img {
    max-width: 14px;
}

</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection