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
                     <!-- <div class="hover-container">
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
                     </div> -->
                  </div>
                  <!-- <p class="text-center">Please enter your Email ID in UPPERCASE</p> -->
                  <div class="row justify-content-center">
                     <div class="col-md-6 cont">
                        <div class="p-3 my-3 mt-lg-4 mb-lg-5 login_w">
                           <h1>Attending the event?</h1>
                           <p class="lead">Are you attending Family Day 2025</p>
                           <div>
                              <button type="button" class="btn btn-outline-dark eventStatus" data-status="1">Yes</button>
                              <button type="button" class="btn btn-outline-dark eventStatus" data-status="2">No</button>
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
   $(document).on('click', '.eventStatus', function() {
        var self = $(this);
        var status = $(this).attr('data-status');
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: 'POST',
              url: "{{ route('event-save-status') }}",
              data: {status:status},
              beforeSend: function() {
                $('body').addClass('body-loader');
                $('.lds-hourglass').show();
            },
              success: function (response) {
                  var type = response.type;
                  var message = response.message;
                  self.prop('disabled', false);
                  if (message == 'Yes event status') {
                    var userId = '{{ Session::get('user') }}';
					window.location.href="{{route('attendeesUser')}}/"+userId;
                  }
                  else if(message == 'No event status') 
                  {
                    var userId = '{{ Session::get('user') }}';
					window.location.href="{{route('thanks')}}";
                  }
                  else {
                      toastr.error(response.error);
   				
                  }
              },
   		    complete: function(data) {
   			$('.lds-hourglass').hide();
       	    },
          });
    });

  </script>
<style>
  
   
  .cont {
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 40px 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        button {
            margin: 10px;
            min-width: 80px;
        }
</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection