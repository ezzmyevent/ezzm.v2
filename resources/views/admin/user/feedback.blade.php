@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3 flex-wrap">
            <div class="d-flex">
                <h2 class="heading mb-0">{{ $title }}</h2>
            </div>
            <div class="m-box d-flex">
                <div class="search-wrapper d-flex">
                    <form action="{{route('Feedback')}}" method="GET" >
                        <input type="text" name="search" class="form-control ticket-search" placeholder="Search Here..">
                        <button type="submit" class="btn btn-search">Search</button>
                    </form>
                    <a href="{{route('Feedback')}}" class="btn btn-reset btn-main">Reset</a>

                    <a class="btn btn-main btn-add-coupon" href="{{route('feedbackExport')}}" > Export Feedback </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($search != '')
                    <h3 class="search-for">Search for : {{$search}}</h3>
                @endif
            </div>
        </div>
        <!-- Tickets Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-scroller">

                    <table class="table table-hover attendees-table tickets-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <!-- <th> Option-1 </th>
                            <th> Option-2 </th>
                            <th> Option-3 </th>
                            <th> Option-4 </th>
                            <th> Option-5 </th>
                            <th> Option-6 </th>
                            <th> Option-7 </th>
                            <th> Option-8 </th> -->
                            <th> Date </th>
                        </tr>
                        </thead>

                        <tbody>

                        @if (!empty($users))
                            @foreach ($users as $key => $value)
                                <tr id="{{ $value->id }}">
                                    <td> {{ ++$key }} </td>
                                    <td> {{ $value->name }} </td>
                                    <td> {{ $value->email }} </td>
                                    <td> {{ $value->mobile_no }} </td>
                                    <!--
                                        <td> {{ $value->feed_1 }} </td>
                                        <td> {{ $value->feed_2 }} </td>
                                        <td> {{ $value->feed_3 }} </td>
                                        <td> {{ $value->feed_4 }} </td>
                                        <td> {{ $value->feed_5 }} </td>
                                        <td> {{ $value->feed_6 }} </td>
                                        <td> {{ $value->feed_7 }} </td>
                                        <td> {{ $value->feed_8 }} </td>
                                    -->
                                    <td> {{ date('Y-m-d h:i:s A', strtotime($value->created_at)) }} </td>
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

            if(type == 'view') {
                url = "{{route('feedback_view')}}";
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
                    if(type == 'view') {
                        $('#modalContent').html(response);
                    }
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