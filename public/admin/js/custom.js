$(document).ready(function(){
  $('[data-toggles="tooltip"]').tooltip();
});
// ----------------------------
jQuery(function($) {
  var window_location_href = window.location.href;
  window_location_href = window_location_href.endsWith('/') ? window_location_href.substr(0, window_location_href.length - 1) : window_location_href;
  var pgurl = window_location_href.substr(window_location_href.lastIndexOf("/") + 1);


  $(".page-sidebar-menu a").each(function() {
    var thisPage = $(this).attr("href");
    thisPage = thisPage.endsWith('/') ? thisPage.substr(0, thisPage.length - 1) : thisPage;
    thisPage = thisPage.substr(thisPage.lastIndexOf("/") + 1);

    if (thisPage == pgurl)
      $(this).addClass("active");
  });

});

// -------------------------------
 $(document).ready(function(){
        $('#drop-file').change(function(e){
            var fileName = e.target.files[0].name;
            document.getElementById("drop-file-name").innerHTML = fileName;
        });
    });

// -------------------------------

  $(document).ready(function(){
$(".btn-add-input").click(function() {

    $(this).toggleClass("added");

    if ($(this).text() == "Add")
       $(this).text("Added")
    else
       $(this).text("Add");

});
});
// -------------------------------
  tinymce.init({
    selector: "#mytextarea"
  });
  tinymce.init({
    selector: "#mytextarea1"
  });
  tinymce.init({
    selector: "#mytextarea2"
  });
  tinymce.init({
    selector: "#mytextarea3"
  });

  function myFunc() {
    console.log(document.getElementById("mytextarea").value);
  }

// -----------------------------

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
      label: 'Tickets Sale',
      data: [20, 50, 95, 70, 50, 5, 15],
      backgroundColor: "rgba(236,102,102,0.6)"
    }]
  }
});

