@extends('layouts.user')

@section('content')
<div class="container">
    @include('elements.event_info') 
    <div class="bg-white p-2 rounded">
        <div class="row g-3" id="main-section">
            <div class="col-md-8">
                <div class="p-3 p-lg-4">
                    <div class="mb-md-5 top-heading">
                        <h5 class="mb-0"><a href="{{route('ticketBookings', ['slug' => $slug])}}" class="btn-back"><i class="bi bi-chevron-left"></i></a></h5>
                    </div>
                    <div class="text-center mb-5">
                        <h4 class="mb-2 text-primary">Attendee Details</h4>
                        <h5 class="mb-5">Select Category To Enter Details</h5>

                        <div class="category-items py-3">
                            @foreach($_SESSION[$slug] as $key => $value)
                            @if(isset($_SESSION[$slug][$key]['user_details']) && count($_SESSION[$slug][$key]['user_details']) == $value["ticket_quantity"])
                            <div class="category-item border-success">
                            @else
                            <div class="category-item border-danger">
                            @endif
                            
                                <a href="{{route('addAttendees', ['id' => $_SESSION[$slug][$key]['id'], 'slug' => $slug])}}">
                                    <div class="d-flex align-items-center">
                                        @if(isset($_SESSION[$slug][$key]['user_details']) && !empty($_SESSION[$slug][$key]['user_details']))
                                            @if(count($_SESSION[$slug][$key]['user_details']) == $value["ticket_quantity"])
                                                <span class="status bg-success me-auto">Completed</span>
                                            @else
                                                <span class="status bg-danger me-auto">Pending</span>
                                            @endif
                                            <b class="ms-1">{{count($_SESSION[$slug][$key]['user_details'])}}/{{$value['ticket_quantity']}}</b>
                                        @else
                                            <span class="status bg-danger me-auto">Pending</span>
                                            <b class="ms-1">0/{{$value['ticket_quantity']}}</b>
                                        @endif
                                    </div>
                                    <div class="py-4 my-auto">
                                        <img class="mb-2" src="{{asset('public/svg/ticket.svg')}}" loading="lazy" alt="">
                                        <h5 class="text-primary">{{$key}}</h5>
                                    </div>
                                </a>
                                <span class="delete bg-danger remove-item" data-slug="{{$slug}}" data-ticketname="{{$key}}" data-type="Remove-Category"><i class="bi bi-trash"></i></span>
                            </div>
                            
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-summary">
                    <!-- <h6 class="mt-md-3 mb-0 text-center">No Items Added</h6> -->
                    <h4 class="mb-4 text-capitalize text-primary">Order Summary</h4>
                    <div class="flex-grow-1 overflow-auto">
                        <div class="ticket-cart">
                            @php $ammount = []; @endphp
                            @if(isset($_SESSION[$slug]))
                                @foreach($_SESSION[$slug] as $key => $value)
                                <div class="order-item">{{$key}} x {{$value['ticket_quantity']}} 
                                    <span class="ms-auto text-nowrap">
                                        @if($value['ticket_price'] == 0) {{'Free'}} @else {{'₹ '.$value['ticket_price']}} @endif
                                    </span>
                                </div>
                                @php 
                                    array_push($ammount, $value['ticket_price']);
                                @endphp
                                @endforeach
                            @endif
                        </div>
                        @php $total = array_sum($ammount) @endphp
                        <h5 class="d-md-flex align-items-center">Total <span class="ms-auto text-nowrap text-primary total-ammount">₹ {{$total}}</span></h5>
                    </div>
                    <a href="{{route('checkout', ['slug' => $slug])}}" class="btn btn-primary py-2 w-100">Checkout<i class="bi bi-chevron-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container"><a href="javascript:;">FAQ’s</a> | <a href="javascript:;">Terms &amp; Condition</a> |
        <a href="javascript:;">Privacy Policy</a>
        <p class="mb-0">© 2022 Ezzmyevent</p>
    </div>
</footer>
@endsection
@section('script')
<script>
    $(document).on('click','.remove-item', function () {
        var ticket_name = $(this).data('ticketname');
        var slug = $(this).data('slug');
        var type = $(this).data('type');
        
        if(ticket_name != '') {
            $.ajax({
                type:'POST',
                url: "{{route('removeToCart')}}",
                data: {"_token": "{{ csrf_token() }}",slug:slug,ticket_name:ticket_name,type:type},

                success:function(response)
                {
                    response = jQuery.parseJSON(response);
                    var type = response.type;
                    var message = response.message;
                    var data = response.data;
                    
                    if(type == 'Success') {
                        $( "#main-section" ).load(window.location.href + " #main-section" );
                    } else {
                        toastr.error(message);
                    }
                },
            });
        }
    });
</script>
@endsection
