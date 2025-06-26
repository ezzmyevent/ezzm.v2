
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
    <h1 class="modal-title">View Ticket</h1>
</div>

<!-- Modal body -->
<div class="modal-body">
    <div class="row mb-adj">
        <div class="col-md-12">
            <p class="text-light reg-14">Ticket Type</p>
            {{$tickets->name}}
        </div>
    </div>
    <div class="row mb-adj">
    <div class="col-md-12">
        <p class="text-light reg-14">Ticket Name</p>
        {{$tickets->category}}
    </div>
    </div>
    <div class="row mb-adj">
    <div class="col-md-12">
        <p class="text-light reg-14">Price</p>
        ₹ {{$tickets->price}}
    </div>
    </div>
    <div class="row mb-adj">
    <div class="col-md-12">
        <p class="text-light reg-14">Description</p>
        {{$tickets->description}}
    </div>
    </div>
    <div class="row mb-adj">
    <div class="col-md-6">
        <p class="text-light reg-14">Max Attendees</p>
        {{$tickets->max_qty}}
    </div>
    <div class="col-md-6">
        <p class="text-light reg-14">Max Day Select</p>
        {{$tickets->day_qty}}
    </div>
    </div>


</div>

</div>