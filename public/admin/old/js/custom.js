/**
Custom module for you to write your own javascript functions
**/
var Custom = function () {

    // private functions & variables

    var myFunc = function(text) {
        alert(text);
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.            
        },

        //some helper function
        doSomeStuff: function () {
            myFunc();
        }

    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();


$(document).ready(function() {
    $("#bulk-button").click(function() {
        $('.user-form').hide();
        $(".bulk-form").show();
    });

    $("#back-button").click(function() {
        $('.bulk-form').hide();
        $(".user-form").show();
    });
});

$(document).ready(function() {
    // $(".submenu").show();
    $(".menu-parent").click(function() {
        $(this).siblings('.submenu').slideToggle();
        $(this).toggleClass('active');
    });
    $(".submenu-inner").hide();
    $(".menu-parent-inner").click(function() {
        $(this).siblings('.submenu-inner').slideToggle();
        $(this).toggleClass('active');
    });
     if (window.location.href.indexOf("poll") > -1) {
       $(".menu-parent").siblings('.submenu').slideDown();
        $(".menu-parent").addClass('active');
    }else if (window.location.href.indexOf("quiz") > -1) {
       $(".menu-parent").siblings('.submenu').slideDown();
        $(".menu-parent").addClass('active');
    }else if (window.location.href.indexOf("documents") > -1) {
       $(".menu-parent").siblings('.submenu').slideDown();
        $(".menu-parent").addClass('active');
    }else if (window.location.href.indexOf("question") > -1) {
       $(".menu-parent").siblings('.submenu').slideDown();
        $(".menu-parent").addClass('active');
    }else if (window.location.href.indexOf("archive-question") > -1) {
       $(".menu-parent").siblings('.submenu').slideDown();
        $(".menu-parent").addClass('active');
    }else if (window.location.href.indexOf("feedbacks") > -1) {
       $(".menu-parent").siblings('.submenu').slideDown();
        $(".menu-parent").addClass('active');
    }else if (window.location.href.indexOf("chatList") > -1) {
       $(".menu-parent").siblings('.submenu').slideDown();
        $(".menu-parent").addClass('active');
    }else if (window.location.href.indexOf("question") > -1) {
       $(".menu-parent-inner").siblings('.submenu-inner').slideDown();
        $(".menu-parent-inner").addClass('active');
    }else if (window.location.href.indexOf("archive-question") > -1) {
       $(".menu-parent-inner").siblings('.submenu-inner').slideDown();
        $(".menu-parent-inner").addClass('active');
    }
});

