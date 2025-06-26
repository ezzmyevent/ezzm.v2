@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3 flex-wrap">
            <div class="d-flex">
                <h2 class="heading mb-0">{{ $title }}</h2>
            </div>
            <div class="m-box d-flex">
                <div class="search-wrapper d-flex">
                    <form action="{{route('users')}}" method="GET" >
                        <input type="text" name="search" class="form-control ticket-search" placeholder="Search Here..">
                        <button type="submit" class="btn btn-search">Search</button>
                    </form>
                    <a href="{{route('users')}}" class="btn btn-reset btn-main">Reset</a>
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
                            <th>Location</th>
                            <th>User Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company Name</th>
                            <th>Designation</th>
                            <th>Unique Code</th>

                        </tr>
                        </thead>

                        <tbody>

                        @if (!empty($users))
                            @foreach ($users as $key => $value)
                                <tr id="{{ $value->id }}">
                                    <td> {{ ++$key }} </td>
                                    <td> {{ $value->location }} </td>
                                    <td> {{ $value->user_type }} </td>
                                    <td> {{ $value->name }} </td>
                                    <td> {{ $value->email }} </td>
                                    <td>{{ $value->company }}</td>
                                    <td>{{ $value->designation }}</td>
                                    <td>{{ $value->unique_code }}</td>
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
