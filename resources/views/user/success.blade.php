@extends('layouts.user')

@section('content')
<div class="container">
	@include('elements.event_info')

	<div class="bg-white p-2 rounded">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="p-3 p-lg-4">
                            <div class="mb-md-1 d-flex align-items-center mob-block">
                                <div class="mb-0 d-flex flex-grow-1">
                                    <h5 class="thanks_header d-flex align-items-center">
                                        <lottie-player class="mb-2" src="{{asset('public/json/order-confirm.json')}}" background="transparent" speed="1" loop autoplay></lottie-player>
                                        <div class="thanks_order">
										Thanks for your registration!
                                        </div>
                                    </h5>
                                </div>
                              <?php /* <a href="javascript:;" class="ml-3 btn btn-outline-dark py-2">View Tickets</a> */ ?>
                            </div>

                            <div class="p-4 d-flex bg-light thanks-box">
                                <p>YOU ARE GOING TO</p>
                                <h3>{{ $master_setting['settings']->title }}  ({{$ticket->category}})</h3>
                                <h6 class="mt-3">Organizer’s Message:</h6>
                                <p>Congratulations! You are in for a resplendent time with a vibrant revelry along with your loved ones. HSBC family is looking forward to celebrate you and your life with all things exciting and recreational.
                                </p>

                                <h6 class="mt-2">Confirmation sent to: </h6>
                                <a href="mailto:{{$user->email}}">{{$user->email}}</a>

                                <div class="thanks-address p-0 bg-trans">
                                    <ul>
                                        <li>
										<span class="svg_icn me-2 me-lg-3"><img src="{{asset('public/images/date_icon.svg')}}" alt=""></span>
                                            <span>
                                         <span class="text-muted d-block">DATE</span> 23rd July, 2022
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="mt-3 d-flex justify-content-end">
                                <a href="{{route('login')}}" class="ml-3 btn btn-primary text-decoration-none py-2">
								Choose Your Activities <i class="bi bi-chevron-right ms-2"></i>
                               </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</div>
@include('elements.footer')
@endsection
@section('script')
