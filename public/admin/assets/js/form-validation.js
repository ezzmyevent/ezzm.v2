$(function() {
  'use strict';

  $.validator.setDefaults({
    submitHandler: function() {
     return true;
    }
  });
  $(function() {
    // validate signup form on keyup and submit
    $("#signupForm").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        amount: {
          required: true
        },
        coupon_name: {
          required: true,
          minlength: 3
        },
        coupon_code: {
          required: true,
          minlength: 3
        },
        description: {
          required: true,
          minlength: 3
        },
        coupon_type:{
          required: true,
        },
        starting_at:{
          required: true,
        },
        ending_at:{
          required: true,
        },
        password: {
          required: true,
          minlength: 5
        },
        confirm_password: {
          required: true,
          minlength: 5,
          equalTo: "#password"
        },
        email: {
          required: true,
          email: true
        },
        topic: {
          required: "#newsletter:checked",
          minlength: 2
        },
        agree: "required",
        "ticket_id[]": {
          required: true
        },
      },
      messages: {
        name: {
          required: "Please enter a name",
          minlength: "Name must consist of at least 3 characters"
        },
        amount: {
          required: "Please enter a amount/percentage"
          //minlength: "Coupon Name must consist of at least 3 characters"
        },
        coupon_name: {
          required: "Please enter a coupon name",
          minlength: "Coupon Name must consist of at least 3 characters"
        },
        coupon_code: {
          required: "Please enter a coupon code",
          minlength: "Coupon Code must consist of at least 3 characters"
        },
        description: {
          required: "Please enter a decription",
          minlength: "Description must consist of at least 3 characters"
        },
        coupon_type: {
          required: "Please select an option from the list",
        },
        starting_at: {
          required: "Please select Starting Date Time",
        },
        ending_at: {
          required: "Please select Ending Date Time",
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        confirm_password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long",
          equalTo: "Please enter the same password as above"
        },
        email: "Please enter a valid email address",
        "ticket_id[]": {
          required: "Please select an option from the list",
        },
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
  });
});