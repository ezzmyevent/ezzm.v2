<div class="modal-content">
      
    <!-- Modal Header -->
    <div class="modal-header">
      <h1 class="modal-title">Add User</h1>
    </div>
    
    <!-- Modal body -->
  <form id="userdetails" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">User Category<span style="color:red;">*</span></p>
                  <select class="form-control" name="category" id="category" >
                      <option value="" >Please select a Category</option>
                      <option value="Employee">Employee</option>
                  </select>
              </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Employee ID<span style="color:red;">*</span></p>
                <input type="text" class="form-control" placeholder="Employee ID" name="emp_code" id="emp_code">
            </div>
          </div>

          <div class="row mb-adj">
          <div class="col-md-12">
              <p class="text-light reg-14">Name<span style="color:red;">*</span></p>
              <input type="text" class="form-control" placeholder="Name" name="name">
          </div>
          </div>
          
          <div class="row mb-adj">
          <div class="col-md-12">
              <p class="text-light reg-14">Email<span style="color:red;">*</span></p>
              <input type="text" class="form-control" placeholder="Email" name="email">
          </div>
          </div>
          
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-main btn-full submit-btn">Add</button>
      </div>
  </form>
</div>
 <link href="" rel="stylesheet" />
 
    <script src="https://live.ezzmyevent.in/eventbot/herofincorp/public/js/intlTelInput.min.js?v=1697623060"> </script>
<script type="text/javascript">
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
  document.getElementById("emp_code").addEventListener("input", (e) => {
     let temp = e.target.value;
     e.target.value = temp.substr(0, 6);
    console.log(e.target.value);
})
</script>