@extends('admin.layouts.admin')
@section('content')
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="">
				<div class="">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
<!-- 					<div class="portlet light">
                        <div class="portlet-title">
							<div class="caption">
								<span class="caption-subject">VIP Users </span>
							</div>
							<div class="actions">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bulk-user-modal">Import VIP Users</button>
							</div>
						</div>

		
					</div> -->
					<!-- END EXAMPLE TABLE PORTLET-->


               <div class="user-form">
                         <form role="form" class="form-horizontal" action="{{route('import_interface_users')}}/{{$id}}" method="post" enctype="multipart/form-data">
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
                                        <a href="{{route('sampleVIPUserExcel')}}" class="btn secondary">Download Sample</a>
                                        <!-- <button type="button" id="back-button" class="btn blue primary">Back</button> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    
				</div>



			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END CONTENT -->












               


           
<!-- Add User Modal end -->


@endsection

@section('script')

@endsection
