<div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h1 class="modal-title">Add Coupon</h1>
      </div>
      
      <!-- Modal body -->
    <form id="coupondetails" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

            <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Coupon Name<span style="color:red;">*</span></p>
                <input type="text" class="form-control" placeholder="Coupon Name" name="name">
            </div>
            </div>
            <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Coupon Code<span style="color:red;">*</span></p>
                <input type="text" class="form-control" placeholder="Coupon Code" name="code">
            </div>
            </div>
            <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Description<span style="color:red;">*</span></p>
                <textarea class="form-control" placeholder="Coupon Desctiption" name="description"></textarea>
            </div>
            </div>
            <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Ticket Category<span style="color:red;">*</span></p>
                <select class="js-example-basic-multiple w-100" name="ticket_id[]" id="ticket_id"  multiple="multiple">
                    <option value="" >Please select a Ticket</option>
                    <option value="Cart">Complete Cart</option>
                    @foreach($ticket as $item)
                        <option value="{{$item->id}}">{{ $item->name.'('. $item->category. ')'}}</option>
                    @endforeach
                </select>
            </div>
            </div>
            <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Coupon Type<span style="color:red;">*</span></p>
                <select class="form-control" name="coupon_type" id="coupon_type">
                    <option value="">Select a Type</option>
                    <option value="1">Fixed Amount</option>
                    <option value="2">Percentage</option>
                </select>
            </div>
            </div>
            <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Amount/Percentage<span style="color:red;">*</span></p>
                <input type="number" class="form-control" placeholder="Amount/Percentage" id="amount" name="amount">
            </div>
            </div>
            <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Starting Date<span style="color:red;">*</span></p>
                <input type="datetime-local" name="starting_at" min="{{date('Y-m-d')}}T00:00" class="form-control">
            </div>
            </div>
            <div class="row mb-adj">
            <div class="col-md-12">
                <p class="text-light reg-14">Ending Date<span style="color:red;">*</span></p>
                <input type="datetime-local" name="ending_at"  min="{{date('Y-m-d')}}T00:00" class="form-control">
            </div>
            </div>


        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-main btn-full submit-btn">Add</button>
        </div>
    </form>
      
</div>

