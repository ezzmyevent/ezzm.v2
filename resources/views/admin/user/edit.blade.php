<div class="modal-content">
      
    <!-- Modal Header -->
    <div class="modal-header">
      <h1 class="modal-title">Edit Registered User</h1>
    </div>
    
    <!-- Modal body -->
    <form id="editinterfacedetails" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="interface_id" value="{{$users->id}}">
    <div class="modal-body">
        
          <!-- <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Lead Name</p>
                  <input type="text" class="form-control" placeholder="Name" name="name" value="{{$users->lead_name }}">
              </div>
          </div> -->

          <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Employee ID</p>
                  <input type="text" class="form-control" placeholder="Employee ID" name="emp_code" value="{{$users->emp_code }}">
              </div>
          </div>
          <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Name</p>
                  <input type="text" class="form-control" placeholder="Email" name="name" value="{{$users->name }}">
              </div>
          </div>

          <!-- <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Email</p>
                  <input type="text" class="form-control" placeholder="Email" name="email" value="{{$users->email }}">
              </div>
          </div> -->
          <div class="row mb-adj">
              <div class="col-md-12">
                  <p class="text-light reg-14">Email</p>
                  <input type="text" class="form-control" placeholder="Company" name="company" value="{{$users->email }}">
              </div>
          </div>
         
          
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-main btn-full edit-submit-btn">Update</button>
        </div>
    </form>
    
    
</div>

