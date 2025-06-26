@extends('admin.layouts.master')

@push('plugin-styles')
    <link href="{{ asset('public/admin/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2 class="heading">Dashboard</h2>
            <?php /*  <div class="dropdown dropdown-date">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1.svg')}}"> 1 Week
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1.svg')}}"> Till Date</a>
                  <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1.svg')}}"> 1 Day</a>
                  <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1.svg')}}"> 1 Week</a>
                  <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/calendar_icon-1.svg')}}"> 1 Month</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"><img class="cal-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"> Custom</a>
                </div>
            </div>  */ ?>
        </div>

        <div class="row dashboard-stat-outer dso-top">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="dashboard-stat2">
                    <div class="display">
                        <div class="icon">
                            <img class="" src="{{ asset('public/admin/assets/images/tickets_icon.svg')}}">
                        </div>
                        <div class="number">
                            <small class="crd-heding">Registered Users</small>
                            <h3 class="">
                                {{--<a href="exportUsersAll">--}}
                                    {{ isset($user_count_data['online'])?$user_count_data['online']:0 }}
                                {{--</a>--}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="dashboard-stat2">
                    <div class="display">
                        <div class="icon">
                            <img class="" src="{{ asset('public/admin/assets/images/tickets_icon.svg')}}">
                        </div>
                        <div class="number">
                            <small class="crd-heding">Pending</small>
                            <h3 class="">
                                
                                    {{ $pendingCount ?? 0 }}
                                
                            </h3>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="dashboard-stat2">
                    <div class="display">
                        <div class="icon">
                            <img class="" src="{{ asset('public/admin/assets/images/tickets_icon.svg')}}">
                        </div>
                        <div class="number">
                            <small class="crd-heding">Successful</small>
                            <h3 class="">
                                
                                    {{ $successCount ?? 0 }}
                                
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="dashboard-stat2">
                    <div class="display">
                        <div class="icon">
                            <img class="" src="{{ asset('public/admin/assets/images/tickets_icon.svg')}}">
                        </div>
                        <div class="number">
                            <small class="crd-heding">Onspot Registered User</small>
                            <h3 class="">
                                <a href="onspotExportUsersAll">
                                    {{ isset($user_count_data['onsite'])?$user_count_data['onsite']:0 }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 stat-multiple">
                    <div class="display">
                        <div class="number">
                            <small class="crd-heding">Reedem Users</small>
                            <div class="stat-double">
                                <div class="stat-double-left">
                                    <div class="stat-free">Pre</div>
                                    <h3 class="">
                                        <a href="exportUsers">
                                            {{ isset($redeem_count_data['online'])?$redeem_count_data['online']:0 }}
                                        </a>
                                    </h3>
                                </div>
                                <div class="stat-double-right">
                                    <div class="stat-free">Onspot</div>
                                    <h3 class="">
                                        <a href="onspotExportUsers">
                                            {{ isset($redeem_count_data['onsite'])?$redeem_count_data['onsite']:0 }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <br/>
        <?php
        if(!empty($category_count_data))
            {
        ?>
        <div class="d-flex justify-content-between">
            <h2 class="heading">Category Wise Data</h2>

        </div>
        <div class="row dashboard-stat-outer dso-top">
            <?php
            foreach($category_count_data as $key=>$category)
            {
             ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2 stat-multiple">
                        <div class="display">
                            <div class="number">
                                <small class="crd-heding">{{$key}}</small>
                                <div class="stat-double">
                                    <div class="stat-double-left">
                                        <div class="stat-free">Online</div>
                                        <h3 class="">
                                            <a href="exportCategorywise/online/{{$key}}">
                                                {{ isset($category['online'])?$category['online']:0 }}
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="stat-double-right">
                                        <div class="stat-free">Onspot</div>
                                        <h3 class="">
                                            <a href="exportCategorywise/onsite/{{$key}}">
                                                {{ isset($category['onsite'])?$category['onsite']:0 }}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>
        </div>
        <?php
        }
        ?>




        <!-- total ticket sales -->

    <?php /* <div class="card ticket-chart mb-5 mt-5 p-4">
		<h2 class="sub-heading mb-3">Total Ticket Sales</h2>
		<canvas id="myChart"></canvas>
	</div> */ ?>

    <!-- ticket types -->
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex m-block justify-content-between mb-3">
                    <h2 class="sub-heading">Registered User Type</h2>
                    <?php
                    $online_count=isset($user_count_data['online'])?$user_count_data['online']:0;
                    $onsite_count=isset($user_count_data['onsite'])?$user_count_data['onsite']:0;
                    $total_reg=$online_count+$onsite_count;
                    $online_percentage=0;
                    $onsite_percentage=0;
                    if(!empty($total_reg))
                    {
                        $online_percentage=($online_count*100)/($total_reg);
                        $onsite_percentage=($onsite_count*100)/($total_reg);
                    }




                    ?>
                    <span class="med-16 text-light">Total User :{{ isset($total_reg)?$total_reg:0  }}</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6 space-right">
                        <div class="progress-circle card blue-circle">
                            <div class="percent">
                                <svg>
                                    <circle cx="45" cy="45" r="40"></circle>
                                    <circle cx="45" cy="45" r="40" style="--percent: {{ number_format($online_percentage,2) }}"></circle>
                                </svg>
                                <div class="number">
                                    <h3>{{ number_format($online_percentage,2)  }}%</h3>
                                </div>
                            </div>
                            <div class="tecket-detail">
                                <p class="semi-18">Pre Registered User</p>
                                <p class="text-light reg-14" style="font-size: 20px"><a href="exportUsersAll">{{ isset($online_count)?$online_count:0  }}</a></p>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 space-left">

                        <div class="progress-circle card red-circle">
                            <div class="percent">
                                <svg>
                                    <circle cx="45" cy="45" r="40"></circle>
                                    <circle cx="45" cy="45" r="40" style="--percent: {{ number_format($onsite_percentage,2)  }}"></circle>
                                </svg>
                                <div class="number">
                                    <h3>{{ number_format($onsite_percentage,2)  }}%</h3>
                                </div>
                            </div>
                            <div class="tecket-detail">
                                <p class="semi-18">Onspot Registered User</p>
                                <p class="text-light reg-14" style="font-size: 20px"><a href="onspotExportUsersAll">{{ isset($onsite_count)?$onsite_count:0  }}</a></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(!empty($attendee_count_data))
        {
        foreach($attendee_count_data as $key=>$userdata)
        {
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex m-block justify-content-between mb-3">
                    <h2 class="sub-heading">{{ $key }}</h2>
                    <?php
                        $online_count=isset($userdata['online'])?$userdata['online']:0;
                        $onsite_count=isset($userdata['onsite'])?$userdata['onsite']:0;
                        $total_reg=$online_count+$onsite_count;
                        $online_percentage=0;
                        $onsite_percentage=0;
                        if(!empty($total_reg))
                        {
                            $online_percentage=($online_count*100)/($total_reg);
                            $onsite_percentage=($onsite_count*100)/($total_reg);
                        }
                    ?>
                    <span class="med-16 text-light">Total User :{{ isset($total_reg)?$total_reg:0  }}</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6 space-right">
                        <div class="progress-circle card blue-circle">
                            <div class="percent">
                                <svg>
                                    <circle cx="45" cy="45" r="40"></circle>
                                    <circle cx="45" cy="45" r="40" style="--percent: {{ number_format($online_percentage,2) }}"></circle>
                                </svg>
                                <div class="number">
                                    <h3>{{ number_format($online_percentage,2)  }}%</h3>
                                </div>
                            </div>
                            <div class="tecket-detail">
                                <p class="semi-18">Pre Registered User</p>
                                <p class="text-light reg-14" style="font-size: 20px">
                                    <a href="exportLocationWiseZapping/online/{{ $key }}">
                                        {{ isset($online_count)?$online_count:0  }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 space-left">
                        <div class="progress-circle card red-circle">
                            <div class="percent">
                                <svg>
                                    <circle cx="45" cy="45" r="40"></circle>
                                    <circle cx="45" cy="45" r="40" style="--percent: {{ number_format($onsite_percentage,2)  }}"></circle>
                                </svg>
                                <div class="number">
                                    <h3>{{ number_format($onsite_percentage,2)  }}%</h3>
                                </div>
                            </div>
                            <div class="tecket-detail">
                                <p class="semi-18">Onspot Registered User</p>
                                <p class="text-light reg-14" style="font-size: 20px">
                                    <a href="exportLocationWiseZapping/onsite/{{ $key }}">
                                        {{ isset($onsite_count)?$onsite_count:0  }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        }
        ?>


    <!-- recent order -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="sub-heading">Recent User Entry</h2>
                <div class="table-scroller">
                    <table class="table table-hover recent-order-table" id="" width="100%">
                        <thead>
                        <tr>
                            <th> User Type </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Company </th>
                            <th> Designation </th>
                            <th> Unique Code </th>
                            <th> Created </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($userRecord as $record)
                        {
                        ?>

                        <tr>
                            <td>{{$record->user_type}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->email}}</td>
                            <td>{{$record->company}}</td>
                            <td>{{$record->designation}}</td>
                            <td>{{$record->unique_code}}</td>
                            <td>{{$record->created_at}}</td>
                        </tr>

                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
--}}
        <!-- Organiser contact form filled -->
        <?php /*
<div class="org-cff d-flex justify-content-between align-items-center">
	<div class="d-flex align-items-center">
		<img class="cff-icon" src="{{ asset('public/admin/assets/images/contact_form.svg')}}"><h2 class="semi-20 m-0">Orgaizer Contact Forms Filled:</h2>
	</div>
	<div><h2 class="semi-20 m-0">2036</h2></div>
</div>
*/ ?>
    <!-- Recent Queries -->
        <?php /* <div class="row">
<div class="col-md-12">
    <h2 class="sub-heading">Recent Queries</h2>
    <div class="table-scroller">
    <table class="table table-hover recent-order-table" id="" width="100%">
        <thead>
            <tr>
                <th> Name </th>
                <th> Email</th>
                <th> Mobile </th>
                <th> Enquiry </th>
                <th> Date </th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>Himanshu</td>
                    <td>xyz@gmail.com</td>
                    <td>09828-98280</td>
                    <td>Message goes here</td>
                    <td>12 Jun, 2022</td>
                </tr>
                <tr>
                    <td>Rohit</td>
                    <td>xyz@gmail.com</td>
                    <td>09828-98280</td>
                    <td>Message goes here</td>
                    <td>12 Jun, 2022</td>
                </tr>
                <tr>
                    <td>Sudhanshu</td>
                    <td>xyz@gmail.com</td>
                    <td>09828-98280</td>
                    <td>Message goes here</td>
                    <td>12 Jun, 2022</td>
                </tr>
                <tr>
                    <td>Rohit</td>
                    <td>xyz@gmail.com</td>
                    <td>09828-98280</td>
                    <td>Message goes here</td>
                    <td>12 Jun, 2022</td>
                </tr>
                <tr>
                    <td>Sudhanshu</td>
                    <td>xyz@gmail.com</td>
                    <td>09828-98280</td>
                    <td>Message goes here</td>
                    <td>12 Jun, 2022</td>
                </tr>

        </tbody>
    </table>
</div>
</div>
</div>
*/ ?>


    </div>



@endsection

@push('plugin-scripts')
    <!-- 	<script src="{{ asset('public/admin/assets/plugins/chartjs/Chart.min.js') }}"></script>
	<script src="{{ asset('public/admin/assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
	<script src="{{ asset('public/admin/assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
	<script src="{{ asset('public/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('public/admin/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
	<script src="{{ asset('public/admin/assets/plugins/progressbar-js/progressbar.min.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js" type="text/javascript"> </script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: 'Tickets Sale',
                    data: [20, 50, 95, 70, 50, 5, 15],
                    backgroundColor: "rgba(236,102,102,0.6)"
                }]
            }
        });
    </script>
@endpush

@push('custom-scripts')
    <!-- 	<script src="{{ asset('public/admin/assets/js/dashboard.js') }}"></script>
	<script src="{{ asset('public/admin/assets/js/datepicker.js') }}"></script> -->
@endpush