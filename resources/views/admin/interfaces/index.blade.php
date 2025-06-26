@extends('admin.layouts.admin')
@section('content')
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="">
				<div class="">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
                        <div class="portlet-body form search-wrapper" id="filters">
							<form action="{{ route('interfaces') }}/{{$interface_data->id}}" name="search" method="get">
								{{csrf_field()}}
							    <div class="form-group">
							        <div class="search-inner">
							            <span>Search By:</span>
							            <div class="field-item">

											<div class="input-outer">
											<input type="hidden" name="post_type" value="search">
									        <input type="text" name="search" class="form-control" placeholder="Search" value="{{old('search')}}">
									        </div>
									        <div class="input-outer">
									        <select name="field" class="form-control">
									        <option value="name">Name</option>
									        <option value="email">Email</option>
									        <option value="phone">Phone</option>
									        <option value="unique_code">Unique Code</option>	
									        </select>
									        </div>
									    </div>

							            <div class="form-actions">
							                <button type="submit" class="btn green"><i class="fa fa-search"></i> Search</button>
							                <a class="btn default" href="{{ route('interfaces') }}/{{$interface_data->id}}"><i class="fa fa-refresh"></i> Reset</a>
							            </div>

							        </div>
							    </div>
							</form>

						</div>

						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject"> {{$title}} </span>
							</div>
							<div class="actions">
								<!-- Button trigger modal -->
								@if($interface_data->type == 'invite')
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#invite-user-modal">Invite User</button>
								<a href="{{route('exportInviteeData')}}/{{$interface_data->id}}" class="btn">Export Data</a>
                                @elseif($interface_data->type == 'add')
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-modal">Add User</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bulk-user-modal">Import Users</button>
								<a href="{{route('exportInterfaceData')}}/{{$interface_data->id}}" class="btn">Export Data</a>
                                @elseif($interface_data->type == 'neutral')
								<a href="{{route('exportInterfaceData')}}/{{$interface_data->id}}" class="btn">Export Data</a>
								@endif
							</div>
						</div>

						<div class="portlet-body" id="user-section">
							<span class="response_status"></span>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="sample_1" width="100%">
									<thead>
										<tr>
											<th class="table-checkbox"> # </th>
											<th> Name </th>
                                            <th> Email </th>
                                            <th> Phone Number </th>
                                            
                                            @if($interface_data->type == 'invite')
                                            <th> Alloted Quantity </th>
                                            <th> Unique Link</th>
                                            @elseif($interface_data->type == 'add')
                                            <th> Gender </th>
                                            <th> State </th>
                                            <th> City </th>
                                            <th> Company </th>
                                            <th>Unique Code</th>
                                            @elseif($interface_data->type == 'neutral')
                                            <th>Unique Code</th>
                                            @endif
                                            <th> Created At</th>
											<th> Action </th>
										</tr>
									</thead>

									<tbody>
										@if(!empty($data))
                                            @foreach($data as $key => $value)
                                                <tr class="odd gradeX" id="{{ $value['id'] }}">
                                                    <td class="table-checkbox"> {{ ++$key }} </td>
                                                    <td class="table-checkbox"> {{ $value['name'] }} </td>
                                                    <td class="table-checkbox"> {{ $value['email'] }} </td>
                                                    <td class="table-checkbox"> {{ $value['countryCode'].' '.$value['phone'] }} </td>
                                                    
                                                    @if($interface_data->type == 'invite')
                                                    <td class="table-checkbox"> {{ $value['qty'] }} / {{ $value['remaining_qty'] }} </td>
                                                    <td class="table-checkbox"> {{ route('invitees') }}/{{$value['access_token']}}</td>
                                                    @elseif($interface_data->type == 'add')
                                                    <td class="table-checkbox"> {{ $value['gender'] }} </td>
                                                    <td class="table-checkbox"> {{ $value['state'] }} </td>
                                                    <td class="table-checkbox"> {{ $value['city'] }} </td>
                                                    <td class="table-checkbox"> {{ $value['company'] }} </td>
                                                    <td class="table-checkbox"> {{ $value['unique_code'] }} </td>
                                                    @elseif($interface_data->type == 'neutral')
                                                    <td class="table-checkbox"> {{ $value['unique_code'] }} </td>
                                                    @endif
                                                    <td>
                                                        {{ date('d M Y H:i A', strtotime($value['created_at'])); }}
                                                    </td>
                                                    <td>
                                                        @if($interface_data->type == 'invite')
                                                            <a class="fa-icon" data-toggle="tooltip" title="Invitees List" href="{{route('inviteeUserList')}}/{{$value['id']}}"><i class="fa fa-list"></i></a>
                                                            <!-- <a class="fa-icon" data-toggle="modal" data-target="#link-modal" data-toggle="tooltip" title="Copy Link" id="clipboard_link" data-url="{{ route('invitees') }}/{{$value['access_token']}}"><i class="fa fa-clipboard"></i></a> -->
                                                            <a class="fa-icon" data-toggle="modal" data-target="#edit-invitee-modal" data-toggle="tooltip" title="Edit Invitee" id="edit_invitee" data-id="{{$value['id']}}" data-name="{{$value['name']}}" data-qty="{{$value['qty']}}"><i class="fa fa-edit"></i></a>
                                                        @elseif($interface_data->type == 'add')
                                                        @endif
                                                        @if($value->unique_code != '')
                                                        <a class="fa-icon" data-original-title="User QR Code" href="{{route('qrcode_user')}}/{{ $value->unique_code }}/{{ $value->category }}"
                                                         target="_blank"><i class="fa fa-eye"></i></a>
                                                         @endif
                                                    </td>
                                                </tr>
                                        @endforeach
                                        @else
                                            <tr class="odd gradeX"> <td colspan="<?php echo $total_view_fields; ?>"> No data available in table </td> </tr>
                                        @endif
										

									</tbody>
								</table>
							</div>
							<div class="paging_bootstrap_full_number" id="">
								<ul class="pagination">
									{{ $data->withQueryString()->links() }}
								</ul>
							</div>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>



			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END CONTENT -->

<!-- Invite User Modal start -->
    <div class="comman-modal modal fade" id="invite-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <!-- user-form -->
                    <div class="user-form">
                        <h5 class="modal-title">Invite User</h5>
                        <form role="form" class="form-horizontal" action="#" id="invite_user" method="post" enctype="multipart/form-data">
                            <input name="user_interface_id" type="hidden" value="{{$interface_data->id}}">
                            <input name="interface_category" type="hidden" value="{{$interface_data->category}}">
                            <input type="hidden" name="access_token" value="{{ csrf_token() }}" />
                            <div class="response_inviteuser alert-danger" style="display:none;">
                                <ul></ul>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="name" type="text" class="form-control" id="user_name" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="email" type="text" class="form-control" id="user_email" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <select name="country_code" class="form-control country_code" id="user_country_code">
                                        <option value="+91" selected>+91 (India)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="phone" type="text" class="form-control" id="user_phone" placeholder="Enter Phone Number" required>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="qty" type="text" class="form-control" id="user_qty" placeholder="Enter Quantity" required>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit" name="submit" class="btn blue primary inviteuser-submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="comman-modal modal fade" id="link-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <h5 class="modal-title">Invite User Unique Link</h5>
                    <!-- user-form -->
                    <input type="text" class="form-control" id="dynamic_link" value="">
                </div>
            </div>
        </div>
    </div>
<!-- Invitee User Modal end -->

<!-- Add User Modal start -->
<div class="comman-modal modal fade" id="user-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <!-- user-form -->
                    <div class="user-form">
                        <h5 class="modal-title">Add User</h5>
                        <form role="form" class="form-horizontal" action="#" id="add_user" method="post" enctype="multipart/form-data">
                            <input name="user_interface_id" type="hidden" value="{{$interface_data->id}}">
                            <input name="interface_category" type="hidden" value="{{$interface_data->category}}">
                            <input name="festival_dates" type="hidden" value="{{$master_setting['data']['event_dates']}}">
                            <div class="response_adduser alert-danger" style="display:none;">
                                <ul></ul>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="name" type="text" class="form-control" id="user_name" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="email" type="text" class="form-control" id="user_email" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="phone" type="text" class="form-control" id="user_phone" placeholder="Enter Phone Number" required>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <select class="form-control" name="gender" id="gender" style="padding: 0 15px;">
                                        <option value="" selected="selected">Select Gender </option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Transgender">Transgender</option>
                                        <option value="Non-binary/non-conforming">Non-binary/non-conforming</option>
                                        <option value="Prefer not to respond">Prefer not to respond</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <select name="state" class="form-control" id="state" style="padding: 0 15px;">
                                        @php
                                            $states = \App\Models\States::getState();
                                        @endphp

                                        @foreach($states as $state)
                                            <option value="{{$state->name}}" data-id="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <select name="city" class="form-control" id="city" style="padding: 0 15px;">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="company" type="text" class="form-control" id="user_company" placeholder="Enter Company" required>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit" name="submit" class="btn blue primary adduser-submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="comman-modal modal fade" id="bulk-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <!-- bulk-form -->
                    <div class="user-form">
                        <h5 class="modal-title">Add Bulk User</h5>
                        <form role="form" class="form-horizontal" action="{{route('uploadInterfaceUsercsv')}}/{{$interface_data->id}}" method="post" enctype="multipart/form-data">
                        	{{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <div class="upload-file">
                                        <input name="file" type="file" class="form-control" id="fle" required>
                                        <img src="{{ asset('public/images/img_icon.png') }}" alt="">
                                        <h4>DROP YOU IMAGE HERE OR <span>BROWSE</span></h4>
                                        <h3>SUPPORT: CSV FILE</h3>
                                        <p class="img-name"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" name="submit" class="btn blue">Submit</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('sampleUserExcel')}}" class="btn secondary">Download Sample</a>
                                        <!-- <button type="button" id="back-button" class="btn blue primary">Back</button> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Add User Modal end -->

<!-- Edit User -->
<div class="comman-modal modal fade" id="edit-invitee-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <!-- user-form -->
                    <div class="user-form">
                        <h5 class="modal-title">Edit Invitee</h5>
                        <form role="form" class="form-horizontal" action="#" id="edit_invitee_form" method="post" enctype="multipart/form-data">
                            <input name="invitee_id" id="invitee_id" type="hidden" value="" />
                            <div class="response_editinvitee alert-danger" style="display:none;">
                                <ul></ul>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="name" type="text" class="form-control" id="edit_invitee_name" placeholder="Enter Name" value="" />
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group line-input">
                                    <input name="qty" type="text" class="form-control" id="edit_invitee_qty" placeholder="Enter Quantity" value="" />
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit" name="submit" class="btn blue primary editinvitee-submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Edit User -->
@endsection

@section('script')
<script type="text/javascript">

    $(document).ready(function () {
        //$('select').select2({ width: '100%', allowClear: true });
    });

    $('#clipboard_link').on('click', function(e) {
        var link = $(this).data('url');

        $('#dynamic_link').val(link);
    });

    $(document).on('click','#edit_invitee', function(e) 
    {
        $(".response_editinvitee").hide();
        
        var invitee_id = $(this).data('id');
        var name = $(this).data('name');
        var qty = $(this).data('qty');

        $('#invitee_id').attr('value', invitee_id);
        $('#edit_invitee_name').attr('value', name);
        $('#edit_invitee_qty').attr('value', qty);
    });

	$('.inviteuser-submit').on('click', function(e)
	{
        $(".response_inviteuser").hide();
   		
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type:'POST',
            url: "{{route('inviteuser')}}",
            data:$('#invite_user').serialize(),

            success:function(response)
            {   
                if($.isEmptyObject(response.error)){
                    //response = jQuery.parseJSON(response);
                    var type = response.type;
                    var message = response.message;
                    
                    document.getElementById('invite_user').reset();
                    $('.response_inviteuser').removeClass('alert-danger');
                    $('.response_inviteuser').css('color', 'green').html(message).show();
                    
                    $( "#user-section" ).load(window.location.href + " #user-section" );
                }else{
                    $(".response_inviteuser").find("ul").html('');
                    $(".response_inviteuser").css('display','block');
                    $.each( response.error, function( key, value ) {
                        console.log(value)
                        $(".response_inviteuser").find("ul").append('<li>'+value+'</li>');
                    });
                }
            },
        });
		
   		e.preventDefault();
   	});

    $(document).on('click','.editinvitee-submit', function(e)
	{
        $(".response_editinvitee").hide();

        var invitee_id = $('#invitee_id').val();
        var name = $('#edit_invitee_name').val();
        var qty = $('#edit_invitee_qty').val();
   		
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type:'POST',
            url: "{{route('editinviteuser')}}",
            data:{invitee_id:invitee_id,name:name,qty:qty},

            success:function(response)
            {   
                if($.isEmptyObject(response.error)){
                    //response = jQuery.parseJSON(response);
                    var type = response.type;
                    var message = response.message;
                    
                    document.getElementById('edit_invitee_form').reset();
                    $("#edit-invitee-modal").modal('hide');
                    $('.response_editinvitee').removeClass('alert-danger');
                    $('.response_editinvitee').css('color', 'green').html(message).show();
                    
                    $( "#user-section" ).load(window.location.href + " #user-section" );
                }else{
                    $(".response_editinvitee").find("ul").html('');
                    $(".response_editinvitee").css('display','block');
                    $.each( response.error, function( key, value ) {
                        console.log(value)
                        $(".response_editinvitee").find("ul").append('<li>'+value+'</li>');
                    });
                }
            },
        });
		
   		e.preventDefault();
   	});

    $('.adduser-submit').on('click', function(e)
	{
        $(".response_adduser").hide();
   		
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            type:'POST',
            url: "{{route('addinterfaceuser')}}",
            data:$('#add_user').serialize(),

            success:function(response)
            {   
                if($.isEmptyObject(response.error)){
                    //response = jQuery.parseJSON(response);
                    var type = response.type;
                    var message = response.message;
                    
                    document.getElementById('add_user').reset();
                    $('.response_adduser').removeClass('alert-danger');
                    $('.response_adduser').css('color', 'green').html(message).show();
                    
                    $( "#user-section" ).load(window.location.href + " #user-section" );
                }else{
                    $(".response_adduser").find("ul").html('');
                    $(".response_adduser").css('display','block');
                    $.each( response.error, function( key, value ) {
                        console.log(value)
                        $(".response_adduser").find("ul").append('<li>'+value+'</li>');
                    });
                }
            },
        });
		
   		e.preventDefault();
   	});
</script>
@endsection
