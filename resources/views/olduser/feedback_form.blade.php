<!DOCTYPE html>
<html>
<head>
  <title>ezzmyevent Admin Panel</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Styles -->
        <style>
            body {font-family: 'Nunito', sans-serif; background-color: #f4f4f4; } 
            label.blue {color: #1877f2; font-size: 17px; font-weight: 600; margin-top: 20px; margin-bottom: 5px; } 
            p.sub-feedback {font-weight: 500; color: #666; font-size: 14px; } 
            .check-list {display: flex; flex-wrap: wrap; gap: 20px; } 
            .check-list .check-blue-wrapper {flex: 0 0 50%; } 
            .check-blue, .radio-blue {position: relative; }
            .check-blue input, .radio-blue input {position: absolute; width: 100%; height: 100%; z-index: 9; opacity: 0; }
            .check-blue-wrapper label, .radio-blue-wrapper label {font-size: 15px; font-weight: normal; position: relative; padding-left: 40px; margin-bottom: 20px; display: inline-block; line-height: 2; }
            .radio-blue-wrapper label:before {content: ""; position: absolute; width: 25px; height: 25px; border: 1px solid #DBE2EA; left: 0; border-radius: 4px; top: 2px; box-shadow: 0 4px 8px #2c27380a; }
            .radio-blue input:checked + label:before {border: 2px solid #1877f2; }
            .radio-blue input:checked + label:after {content: ""; position: absolute; width: 12px; height: 7px; border-bottom: 2px solid #1877f2; border-left: 2px solid #1877f2; left: 6px; top: 9px; transform: rotate(-45deg); }
            textarea {display: block; border: 1px solid #DBE2EA; border-radius: 5px; width: 500px; max-width: 100%; box-shadow: 0 4px 8px #2c27380a; }
            .radio-blue-wrapper.f-width {flex: 0 0 100%; }
            .radio-blue-wrapper.f-width label{margin-bottom: 0;}

            @media(min-width: 1200px) {
                .container{max-width: 1104px;}
            }

            @media(min-width: 1400px){
                .container{max-width: 1104px;} 
            }

            .alert-danger {background-color: transparent; border: none; border-radius: 0px; padding: 0px; color: #F00; font-size: 14px; line-height: 1; }


.form_input {
  display: block;
  border: 1px solid #DBE2EA;
  border-radius: 5px;
  width: 500px;
  max-width: 100%;
  box-shadow: 0 4px 8px #2c27380a;
}

        </style>
    </head>

    <body class="antialiased">
        <div class="container">
            <div class="bg-white rounded p-4">
                <span class="response_success"></span>
                

                <form method="POST" class="feedback_form" id="feedback_form" enctype="multipart/form-data">

                    @csrf
                                    @method('POST')

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">Name</label>
                            <input type="text" name="name" class="form_input">
                            <div class="alert alert-danger mt-1 mb-1 name_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">Company Name</label>
                            <input type="text" name="company_name" class="form_input">
                            <div class="alert alert-danger mt-1 mb-1 company_name_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">Designation</label>
                            <input type="text" name="designation" class="form_input">
                            <div class="alert alert-danger mt-1 mb-1 designation_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">Mobile no.</label>
                            <input type="text" name="mobile_no" class="form_input">
                            <div class="alert alert-danger mt-1 mb-1 mobile_no_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">Email</label>
                            <input type="text" name="email" class="form_input">
                            <div class="alert alert-danger mt-1 mb-1 email_error"></div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">1.Please rate your overall experience at ServiceNow Achieve </label>
                            <p class="sub-feedback">(5 being excellent)</p>
                            <div class="check-list">
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_1" value="1">
                                        <label class="">1</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_1" value="2">
                                        <label class="">2</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_1" value="3">
                                        <label class="">3</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_1" value="4">
                                        <label class="">4</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_1" value="5">
                                        <label class="">5</label>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger mt-1 mb-1 feed_1_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">2.Were the sessions easy to understand and absorb? </label>
                            <div class="check-list">
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_2" value="yes"> 
                                        <label class="">Yes</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_2" value="no"> 
                                        <label class="">No</label>
                                    </div>
                                </div>                                
                            </div>
                            <div class="alert alert-danger mt-1 mb-1 feed_2_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">3. Were there any standout sessions you found most valuable? Why? </label>
                             <textarea name="feed_3"></textarea>
                        </div>
                        <div class="alert alert-danger mt-1 mb-1 feed_3_error"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">4. What were your reasons for attending?</label> 
                            <div class="check-list">
                                <div class="radio-blue-wrapper f-width">
                                    <div class="radio-blue">
                                        <input type="checkbox" name="feed_4[]" value="Discover something new about ServiceNow">
                                        <label class="">Discover something new about ServiceNow  </label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper f-width">
                                    <div class="radio-blue">
                                        <input type="checkbox" name="feed_4[]" value="Listen to other ServiceNow customer journeys"> 
                                        <label class="">Listen to other ServiceNow customer journeys </label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper f-width">
                                    <div class="radio-blue"><input type="checkbox" name="feed_4[]" value="Network and learn from your peers"> 
                                        <label class="">Network and learn from your peers</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper f-width">
                                    <div class="radio-blue"><input type="checkbox" name="feed_4[]" value="Listen to industry thought leaders"> 
                                        <label class=""> Listen to industry thought leaders </label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper f-width">
                                    <div class="radio-blue"><input type="checkbox" name="feed_4[]" value="Learn about driving the future of business through technology">
                                        <label class=""> Learn about driving the future of business through technology </label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper f-width">
                                    <div class="radio-blue"><input type="checkbox" name="feed_4[]" value="Discover how to automate the everyday away"> 
                                        <label class="">Discover how to automate the everyday away</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper f-width">
                                    <div class="radio-blue">
                                        <input type="checkbox" name="feed_4[]" value="Gain valuable insights on building resiliency into your business"> 
                                        <label class=""> Gain valuable insights on building resiliency into your business </label>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger mt-1 mb-1 feed_4_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">5. Would you like to be contacted by ServiceNow for more information?   </label>
                            <div class="check-list">
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_5" value="yes"> <label class="">Yes</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_5"  value="no"> <label class="">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger mt-1 mb-1 feed_5_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">6. Would you like to meet with a ServiceNow solution expert?  </label>
                            <div class="check-list">
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_6" value="yes"> 
                                        <label class="">Yes</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_6" value="no"> 
                                        <label class="">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger mt-1 mb-1 feed_6_error"></div>                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">7. How likely are you to recommend ServiceNow Achieve to a colleague? </label>
                            <p class="sub-feedback">(with 10 being most likely to recommend)</p>
                            <div class="check-list">
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="1"> 
                                        <label class="">1</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="2"> 
                                        <label class="">2 </label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="3"> 
                                        <label class="">3</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="4"> 
                                        <label class="">4</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="5"> 
                                        <label class="">5</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="6"> 
                                        <label class="">6</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="7"> 
                                        <label class="">7</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="8"> 
                                        <label class="">8</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="9"> 
                                        <label class="">9</label>
                                    </div>
                                </div>
                                <div class="radio-blue-wrapper">
                                    <div class="radio-blue">
                                        <input type="radio" name="feed_7" value="10"> 
                                        <label class="">10</label>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger mt-1 mb-1 feed_7_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="blue">8. How can we make ServiceNow Achieve better?</label>
                            <textarea name="feed_8"></textarea>
                            <div class="alert alert-danger mt-1 mb-1 feed_8_error"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success mt-4" id="submitbutton-abc" onclick="submitForm()">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>


<script src="https://code.jquery.com/jquery-3.4.0.js"></script>

<!-- <script src="https://live.ezzmyevent.in/eventbot/ldjs2022/public/front/js/jquery-3.4.1.min.js"></script> -->




<script type="text/javascript">

    function submitForm() {
        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{route('save_feedback')}}",
            data: $('#feedback_form').serialize(),

            success: function (response)
            {
                $(".response_success").html('<div class="bg-light rounded p-4"><p><strong>Thankyou for sharing your valuable feedback for ServiceNow Achieve | Mumbai. </strong></p></div>');
                $("#feedback_form")[0].reset();
                $("#feedback_form").html('');
            },
            error: function (response)
            {
                $.each(response.responseJSON.errors, function (key, value) {
                    console.log(key);
                    console.log(value);
                    $('.' + key + '_error').html(value);
                });
            }
        });

        // e.preventDefault();
    

    }


    $('#submitbutton').on('click', function (e) {});
</script>