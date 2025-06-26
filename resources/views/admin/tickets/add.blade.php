
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title">Add Ticket</h1>
        </div>
        
        <!-- Modal body -->
    <form id="ticketdetails" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Ticket Category</p>
              <select class="form-control" name="category">
                <option value="">Select Category</option>
                @foreach($ticket_category as $key => $value)
                <option value="{{$value->name}}">{{$value->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Name</p>
              <input type="text" class="form-control" placeholder="Ticket Name" name="name">
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Description</p>
              <textarea class="form-control" placeholder="Ticket Desctiption" name="description"></textarea>
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Price</p>
              <input type="number" class="form-control" placeholder="Ticket Price" name="price">
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-12">
              <p class="text-light reg-14">Customise Price</p>
              <input type="checkbox" class="form-control" name="custom_price" id="custom_price" value="1">
            </div>
          </div>
          <div id="customise_price" style="display:none;">
            <div class="row mb-adj">
              <div class="col-md-6">
                <p class="text-light reg-14">For ages 6 and below</p>
                <input type="number" class="form-control" placeholder="Min Attendee Per Booking" id="ages_6_and_below" name="ages_6_and_below">
              </div>
              <div class="col-md-6">
                <p class="text-light reg-14">For ages 7 to 11</p>
                <input type="number" class="form-control" placeholder="Max Attendee Per Booking" id="ages_7_to_11" name="ages_7_to_11">
              </div>
            </div>
            <div class="row mb-adj">
              <div class="col-md-6">
                <p class="text-light reg-14">For ages 12 to 17</p>
                <input type="number" class="form-control" placeholder="Min Attendee Per Booking" id="ages_12_to_17" name="ages_12_to_17">
              </div>
            </div>
          </div>
          <div class="row mb-adj">
            <div class="col-md-6">
              <p class="text-light reg-14">Min Per Booking</p>
              <input type="number" class="form-control" placeholder="Min Attendee Per Booking" id="min_qty" name="min_qty">
            </div>
            <div class="col-md-6">
              <p class="text-light reg-14">Max Per Booking</p>
              <input type="number" class="form-control" placeholder="Max Attendee Per Booking" id="max_qty" name="max_qty">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <p class="text-light reg-14">Min Dates Select</p>
                <div class="custom-file-upload">
                    <select class="form-control" name="day_qty">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
          </div>


        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-main btn-full submit-btn">Add</button>
        </div>
    </form>
        
      </div>
