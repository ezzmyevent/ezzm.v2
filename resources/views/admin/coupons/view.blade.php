
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
    <h1 class="modal-title">View Coupon</h1>
</div>

<!-- Modal body -->
<div class="modal-body">
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Coupon Name</p>
            {{$coupon->name}}
        </div>
    </div>
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Coupon Code</p>
            {{$coupon->code}}
        </div>
    </div>
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Description</p>
            {{$coupon->description}}
        </div>
    </div>
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Tickets</p>
            <ul>
                @foreach($all_ticket_added as $key => $value)
                <li>{{$value['name']}}{{$value['category'] != '' ? " - ".$value['category'] : '';}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Type</p>
            @if($coupon->coupon_type == 1)
                Fixed Amount
            @else
                Percentage
            @endif
        </div>
    </div>
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Price</p>
            @if($coupon->coupon_type == 1)
                ₹ {{$coupon->amount}}
            @else
                {{$coupon->amount}} %
            @endif
            
        </div>
    </div>
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Starting Date</p>
            {{$coupon->starting_at}}
        </div>
    </div>
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Ending Date</p>
            {{$coupon->ending_at}}
        </div>
    </div>


</div>

</div>