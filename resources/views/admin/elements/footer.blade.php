<div class="modal right fade" id="addCouponModal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title">Add Coupons</h1>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

          
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Coupon Name</p>
              <input type="text" class="form-control" placeholder="Type here..">
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Coupon Code</p>
              <input type="text" class="form-control" placeholder="Type here..">
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Description</p>
              <input type="text" class="form-control" placeholder="Type here..">
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Coupon Type</p>
              <select class="form-control">
                  <option value="">-select-</option>
                  <option value="option2">option 2</option>
              </select>
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Amount/Percentage</p>
              <input type="text" class="form-control" placeholder="Type here..">
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-6">
              <p class="text-light reg-14">Start Date</p>
              <input type="date" class="form-control" placeholder="Type here..">
            </div>
            <div class="col-md-6">
              <p class="text-light reg-14">End Date</p>
              <input type="date" class="form-control" placeholder="Type here..">
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-6">
              <p class="text-light reg-14">Start Time</p>
              <div class="input-group input-group-t date" id="timePicker">
              <input type="text" class="form-control timePicker" placeholder="01:00 PM">
              <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
            </div>
            </div>
            <div class="col-md-6">
              <p class="text-light reg-14">End Time</p>
              <div class="input-group input-group-t date" id="timePicker1">
              <input type="text" class="form-control timePicker" placeholder="01:00 PM">
              <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
            </div>
            </div>
          </div>
        
          
          <div class="row mb-adj">
            <div class="col-12">
              <p class="text-light reg-14">Status</p>
              <fieldgroup class="wrapper">
            <div class="toggle_radio">
              <input type="radio" class="toggle_option" id="first_toggle" name="ticket_type" checked>
              <label class="toggle_label" for="first_toggle">Active</label>
              <input type="radio" class="toggle_option" id="second_toggle" name="ticket_type">
              <label class="toggle_label" for="second_toggle">Draft</label>
          
              <div class="toggle_option_slider">
              </div>
              </div>
          </fieldgroup>
            </div>
            
            
          </div>


        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-main btn-full">Add</button>
        </div>
        
      </div>
    </div>
  </div>


  <div class="modal right fade" id="addFieldModal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title">Select A Question</h1>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

          <ul class="add-field-modal-list">
              <li><span class="med-16">Gender</span><button type="button" class="btn btn-add-input">Add</button></li>
              <li><span class="med-16">Country</span><button type="button" class="btn btn-add-input">Add</button></li>
              <li><span class="med-16">State</span><button type="button" class="btn btn-add-input">Add</button></li>
              <li><span class="med-16">City</span><button type="button" class="btn btn-add-input">Add</button></li>
              <li><span class="med-16">Designation</span><button type="button" class="btn btn-add-input">Add</button></li>
              <li><span class="med-16">Title</span><button type="button" class="btn btn-add-input">Add</button></li>
              <li><span class="med-16">Organisation</span><button type="button" class="btn btn-add-input">Add</button></li>
              <li><span class="med-16">Address</span><button type="button" class="btn btn-add-input">Add</button></li>
              <li><span class="med-16">Pincode</span><button type="button" class="btn btn-add-input">Add</button></li>
          </ul>

        </div>
        
        <!-- Modal footer -->
        <!-- <div class="modal-footer">
          <p class="med-16 text-center">Total 5 Question Selected</p>
          <button type="button" class="btn btn-main btn-full">Submit</button>
        </div> -->
        
      </div>
    </div>
  </div>



  <div class="modal fade" id="editFieldModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">First Name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <label class="label">Label</label>
                    <input type="text" name="" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="label">Help Text</label>
                    <input type="text" name="" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="label">Placeholder</label>
                    <input type="text" name="" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="label">Class</label>
                    <input type="text" name="" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="label">Name</label>
                    <input type="text" name="" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="label">Select Ticket</label>
                    <select name="" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="label">Max Length</label>
                    <input type="text" name="" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="label">Move To</label>
                    <select name="" class="form-control">
                        <option>Step 1</option>
                        <option>Step 2</option>
                    </select>
                </div>
                
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer right-align">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-main">Save</button>
        </div>
        
      </div>
    </div>
  </div>


<div class="modal sample-mail-modal fade" id="sampleMailModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Send Sample Email</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <label class="label">Label</label>
                    <input type="text" name="" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <label class="label">Email</label>
                    <input type="email" name="" class="form-control">
                </div>
            </div>
            
            
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer right-align">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-main">Submit</button>
        </div>
        
      </div>
    </div>
  </div>

  <div class="modal shoot-campaign-modal fade" id="shootCampaignModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Shoot Campaign Email</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <label class="label">Select Ticket Type</label>
                      <select name="" class="form-control">
                        <option value="Ticket type 1">Ticket Type 1</option>
                        <option value="Ticket type 2">Ticket Type 2</option>
                    </select>
                </div>
            </div>
          
            
            
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer right-align">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-main">Submit</button>
        </div>
        
      </div>
    </div>
  </div>



  


<!-- <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-center">
  <p class="text-muted text-center text-md-left">Copyright © 2022 <a href="https://eventbot.in/" target="_blank">EVENTBOT</a>. All rights reserved</p>
 </footer> -->