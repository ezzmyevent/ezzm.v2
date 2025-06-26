@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3 flex-wrap">
            <div class="d-flex">
                <h2 class="heading mb-0">{{ $title }}</h2>
            </div>
            <div class="m-box d-flex">
                <a class="btn btn-main btn-add-coupon" href="{{ route('onspotExportUsers') }}" > Export Users Redeem</a>
                <a class="btn btn-main btn-add-coupon" href="{{ route('onspotExportUsersAll') }}" > Export Users All</a>
            </div>
        </div>
        @include('admin.elements.search', ['route' => 'onspot'])
        <!-- Tickets Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-scroller">

                    <table class="table table-hover attendees-table tickets-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company Name</th>
                            <th>Designation</th>
                            <th>Unique Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @if (!empty($users))
                            @foreach ($users as $key => $value)
                                <tr id="{{ $value->id }}">
                                    <td> {{ ++$key }} </td>
                                    <td> {{ $value->category }} </td>
                                    <td> {{ $value->name }} </td>
                                    <td> {{ $value->email }} </td>
                                    <td> {{ $value->phone }} </td>
                                    <td>{{ $value->company }}</td>
                                    <td>{{ $value->designation }}</td>
                                    <td>{{ $value->unique_code }}</td>
                                <!-- <td> {{ '(' . $value->country_code . ')' . ' ' . $value->phone }} </td>
                                        <td> {{ $value->ticket_qty }} </td>
										<td> {{ $value->ticket_amt }} </td>
										<td> {{ $value->festival_dates }} </td>
										<td>
											{{ date('d M Y H:i A', strtotime($value->created_at)) }}
                                        </td>-->
                                    <td> <?php

                                        if($value->status == 1){ ?> <span class="activated">Activated</span> <?php } else { ?> <span class="deactivated">Draft</span>  <?php } ?> </td>
                                    <td>
                                        <div class="dropdown ticket-option">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <div class="dot-three"></div>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" onclick="openmodal('view', '{{$value->id}}');" data-toggle="modal" data-target="#addUserModal"><img class="cal-icon"
                                                                                                                                                                             src="{{ asset('public/admin/assets/images/view_icon.svg') }}">
                                                    View</a>



                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12"> No data available in table </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="paging_bootstrap_full_number" id="">
                    <ul class="pagination">
                        @if($pagination == 'yes')
                            {!! $users->links() !!}
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Start User modal -->
    <div class="modal right fade" id="addUserModal">
        <div class="modal-dialog modal-dialog-scrollable">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <div id="modalContent"></div>
        </div>
    </div>
    <!-- End User modal -->

@endsection
@push('custom-scripts')

    <script type="text/javascript">


        function openmodal(type, id) {
            var url = '';

            if(typeof id === 'undefined') {
                var id = '';
            }

            if(type == 'add') {
                url = "{{route('users-add')}}";
            } else if(type == 'view') {
                url = "{{route('users-view')}}";
            } else if(type == 'import') {
                url = "{{route('users-import')}}";
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'GET',
                url: url,
                data: {id:id},
                success:function(response)
                {
                    $('#modalContent').html(response);
                },
            });
        }

        $(document).on('click','.submit-btn', function (e) {
            var form = $('#userdetails')[0];
            var formData = new FormData(form);

            $.ajax({
                type:'POST',
                url: "{{route('users-save')}}",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    //response = jQuery.parseJSON(response);
                    var type = response.type;
                    var message = response.message;

                    if($.isEmptyObject(response.error)){
                        location.reload();
                    }else{
                        console.log(response.error);
                        $.each( response.error, function( key, value ) {
                            toastr.options = {"positionClass": "toast-bottom-right"};
                            toastr.error(value);
                        });
                    }

                    //$( "#user-section" ).load(window.location.href + " #user-section" );
                },

            });
            e.preventDefault();
        });

        $(document).on('click','.submit-btn-for-import', function (e) {
            var form = $('#importdetails')[0];
            var formData = new FormData(form);

            $.ajax({
                type:'POST',
                url: "{{route('users-uploadcsv')}}",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response)
                {
                    //response = jQuery.parseJSON(response);
                    var type = response.type;
                    var message = response.message;

                    if($.isEmptyObject(response.error)){
                        location.reload();
                    }else{
                        console.log(response.error);
                        $.each( response.error, function( key, value ) {
                            toastr.options = {"positionClass": "toast-bottom-right"};
                            toastr.error(value);
                        });
                    }

                    //$( "#user-section" ).load(window.location.href + " #user-section" );
                },

            });
            e.preventDefault();
        });
    </script>
@endpush