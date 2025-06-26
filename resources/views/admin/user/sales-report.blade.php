@extends('admin.layouts.master')
@section('content')


<div class="container">
	<div class="d-flex justify-content-between">
		<h2 class="heading">Sales Report</h2>
		<div class="dropdown dropdown-date">
		    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		      <img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1.svg')}}"> 1 Week
		    </button>
		    <div class="dropdown-menu">
		      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> Till Date</a>
		      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Day</a>
		      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Week</a>
		      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1')}}.svg"> 1 Month</a>
		      <div class="dropdown-divider"></div>
		      <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Custom</a>
		    </div>
		  </div>
	</div>

	<div class="row dashboard-stat-outer dso-top">
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a class="tkt-box" href="{{ url('/admin/ticket-type-detail') }}">
            <div class="dashboard-stat2">
            	<div class="no-flex">
                    <div class="d-flex justify-content-between mb-3">
                    	<span class="semi-18">Basic</span>
                        <span class="fas fa-chevron-right"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                    	<span class="med-14">Ticket Sold</span>
                    	<span class="med-14">500</span>
                    </div>
                    <div class="d-flex justify-content-between">
                    	<span class="med-14">Total Sales</span>
                    	<span class="med-14">1.5 Lacs</span>
                    </div>
                    
                </div>
            </div>
                </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a class="tkt-box" href="{{ url('/admin/ticket-type-detail') }}">
            <div class="dashboard-stat2">
            	<div class="no-flex">
                    <div class="d-flex justify-content-between mb-3">
                    	<span class="semi-18">VIP</span>
                        <span class="fas fa-chevron-right"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                    	<span class="med-14">Ticket Sold</span>
                    	<span class="med-14">500</span>
                    </div>
                    <div class="d-flex justify-content-between">
                    	<span class="med-14">Total Sales</span>
                    	<span class="med-14">1.5 Lacs</span>
                    </div>
                    
                </div>
            </div>
                </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a class="tkt-box" href="{{ url('/admin/ticket-type-detail') }}">
            <div class="dashboard-stat2">
            	<div class="no-flex">
                    <div class="d-flex justify-content-between mb-3">
                    	<span class="semi-18">Premium</span>
                        <span class="fas fa-chevron-right"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                    	<span class="med-14">Ticket Sold</span>
                    	<span class="med-14">500</span>
                    </div>
                    <div class="d-flex justify-content-between">
                    	<span class="med-14">Total Sales</span>
                    	<span class="med-14">1.5 Lacs</span>
                    </div>
                    
                </div>
            </div>
                </a>
        </div>
	</div>



	<!-- total ticket sales -->
	<div class="d-flex justify-content-between mt-4">
		<h2 class="sub-heading mb-3">Ticket Chart</h2>
		<div class="dropdown dropdown-date">
		    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		      <img class="cal-icon" src="{{ asset('public/admin/assets/images/tickets_icon.svg')}}"> Basic Ticket
		    </button>
		    <div class="dropdown-menu">
		      <a class="dropdown-item" href="#"> Premium Ticket</a>
		      <a class="dropdown-item" href="#"> Student Ticket</a>
		      <a class="dropdown-item" href="#"> Basic Ticket</a>
		      <a class="dropdown-item" href="#"> Free Ticket</a>
		    </div>
		  </div>
	</div>
	<div class="card ticket-chart mb-5 mt-4 p-4">
		<canvas id="myChart"></canvas>
	</div>



</div>

		






@endsection


