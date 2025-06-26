@extends('layouts.user')

@section('content')
<div class="container">
    @include('elements.event_info')
    <div class="bg-white p-2 rounded">
        <div class="p-md-4">
            <div class="top-heading">
                <a href="{{route('bookedTickets', ['slug' => $slug])}}" class="btn-back me-3"><i class="bi bi-chevron-left"></i></a>
                <h5 class="mb-0">Payment</h5>
            </div>
            <div class="bg-light rounded p-2 my-5 px-md-4">
                <table class="table custom-table">
                    <tbody>
                        <tr>
                            <th>{{ $master_setting['settings']->title }}</th>
                            <th colspan="2" class="text-nowrap table-date">{{ $master_setting['settings']->event_date }}</th>
                        </tr>
                        @php $ammount = []; @endphp
                        @if(isset($_SESSION[$slug]))
                            @foreach($_SESSION[$slug] as $key => $value)
                                
                                <tr>
                                    <th>
                                        @php
                                            $ticket_data = \App\Models\Ticket::getTicketRecord($value['id']);
                                        @endphp
                                        {{$ticket_data->category}}
                                        <p>{{$ticket_data->description}}</p>
                                    </th>
                                    <th class="">
                                        <table>
                                            @foreach($value['package_summary'] as $key1 => $value1)
                                                <tr>
                                                    <td>{{$value1['user']}} ({{$value1['ticket_price'] == 0 ? 'Free' : '₹ '.$value1['ticket_price']; }})</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </th>
                                    <th class="text-nowrap">{{'₹ '.$value['ticket_price']}}</th>
                                </tr>
                                @php 
                                    array_push($ammount, $value['ticket_price']);
                                @endphp
                            @endforeach
                        @endif
                        @php $order_total = array_sum($ammount) @endphp
                        <tr class="text-primary">
                            <th>Order Total : </th>
                            <th class="text-nowrap"></th>
                            <th class="text-nowrap">{{'₹ '.$order_total}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-end">
                <button class="btn btn-outline-danger px-3 me-2" id="cancel-order">Cancel</button>
                <a href="successfully.html" class="btn btn-primary px-3">Pay Securely <i class="bi bi-chevron-right ms-2 ms-2"></i></a>
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


<!-- sweet alert toster template -->
<template id="my-template">
  <swal-title>
  Are you sure?<br> You won't be able to revert this!
  </swal-title>
  <swal-icon type="warning"></swal-icon>
  <swal-button type="confirm" onClick="redirect_main()">
    Yes
  </swal-button>
  <swal-button type="cancel">
    Cancel
  </swal-button>
  <swal-param name="allowEscapeKey" value="false" />
  <swal-param
    name="customClass"
    value='{ "popup": "my-popup" }' />
</template>
<!-- sweet alert toster template -->
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(document).on('click','#cancel-order', function () {
            Swal.fire({
                toast: true,
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href="{{route('main')}}";
                }
            });
        });
    });
</script>
@endsection
