@extends('admin.layouts.admin')
@section('content')
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!-- BEGIN PAGE CONTENT INNER -->
				<div class="row margin-top-12">
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<span class="caption-subject">Settings</span>
								</div>
							</div>
							<div class="portlet-body form setting-form">
								<div id="response_setting"></div>
								<div class="form-body">
									<div class="form-group line-input">		
										<div class="row">
											<div class="col-md-12">
												<div class="button-wrapper">
													@if($master_setting['settings']['go_live_status'] == true)
														<div class="button1">
															<div class="btn" onclick="refreshAuditorium();">Go Live</div>
														</div>													
													@endif

													@if($master_setting['settings']['redirect_to_meeting_room_status'] == true)
														<div class="button2">	
															<div class="btn" onclick="redirectToMeetingRoom();">Redirect To Meeting Room</div>
														</div>													
													@endif
												</div>

												@if($master_setting['settings']['notification_text_staus'] == true)
													<div class="form-body">
														<div class="form-group line-input" id="embedcode">
															<label class="small-label">Notification Text</label>
															<textarea name="notification_text" class="form-control" id="notification_text" placeholder="Type here notification text…"></textarea>
														</div>
														<div id="response_notification"></div>
														<div class="form-group row">
															<div class="col-md-6">
																<input name="submit" value="Push Notification" type="button" id="pushnotification" class="btn blue" onclick="pushnotification();">
															</div>
														</div>
													</div>												
												@endif

											</div>
										</div>
									</div>
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
@endsection

@section('script')

<script type="text/javascript">
	
	function refreshAuditorium() {
		$.ajax ({
			dataType: "json",
			type:"GET",
			url:socket_path+"goLive",
			data:{'status':'reload_auditorium','project':"{{$master_setting['data']['event_title']}}"},
			success:function(data) {
				console.log(data);
			}
		});
	}

	function redirectToMeetingRoom() {
		$.ajax ({
			dataType: "json",
			type:"GET",
			url:socket_path+"redirectToMeetingRoom",
			data:{'status':'redirect_meeting_room','project':"{{$master_setting['data']['event_title']}}"},
			success:function(data) {
				console.log(data);
			}
		});
		//socket.emit("redirectToMeetingRoom", {status: 'redirect_meeting_room'});
	}

	function pushnotification() {
		var notification_text = $('#notification_text').val();
		
		if(notification_text == '') {
			$('#response_notification').html('Please enter notification text.').css('color', 'red');
			return;
		} else {
			socket.emit("pushnotification", {notification_text: notification_text});
		}
	}

</script>
@endsection