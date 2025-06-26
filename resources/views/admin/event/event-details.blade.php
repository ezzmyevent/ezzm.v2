@extends('admin.layouts.master')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between mb-3 flex-wrap">
        <div class="d-flex">
            <h2 class="heading mb-0">Event Details</h2>
        </div>
        <div class="save-next">
            <button type="button" class="btn btn-save-next">Save & Next</button>
        </div>
    </div>

    <!-- Tabbing -->
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#eventimage">Event Image</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#description">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#venue">Venue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tandc">T&C</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#social">Social</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="eventimage" class="container-tab tab-pane active"><br>
                    <div class="image-drop-zone">
                        <input type="file" name="" class="drop-file image" id="drop-file">
                        <div class="image-drop-detail">
                            <img src="{{ asset('public/admin/assets/images/img_icon.svg')}}" class="drop-img-icon">
                            <p class="drop-text">Drop you image here or <span class="blue">Browse</span></p>
                            <p class="file-support-text">Support:JPG,JPEG,PNG (UPTO 4MB)</p>
                            <p class="drop-file-name" id="drop-file-name"></p>
                        </div>
                    </div>
                    <span id="upload_image_error"></span>

                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Aadhar Card Image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                </div>

                                <div class="modal-body">
                                    <div class="img-container" style="max-height: 50vh;">
                                        <!-- <div class="row">
                                            <div class="col-md-12"> -->
                                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">

                                                <input type="text" name="uploadImageName" id="uploadImageName">
                                            <!-- </div>
                                            <div class="col-md-4">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <div class="preview embed-responsive-item"></div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <ul class="img_list d-flex justify-content-between flex-wrap event-img-footer pt-5 pb-3">

                        <li>
                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <span class="med-14">Image Name</span>
                                <div class="drag-icon">
                                    <img src="{{ asset('public/admin/assets/images/Drag_icon_v.svg')}}">
                                </div>
                            </div>
                            <div class="img_to_choose">
                                <img src="{{ asset('public/admin/assets/images/up1.jpg')}}">
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-2">
                                <button type="button" class="btn btn-copy-url">
                                	<img src="{{ asset('public/admin/assets/images/url_icon.svg')}}"> Copy URL
                                </button>
                                <div class="set-default-btn">
                                    Use
                                    <div class="button-switch">
                                        <input type="checkbox" id="" class="switch">
                                    </div>
                                </div>
                            </div>
                        </li>


                        <!-- 
	                        <li>
	                            <div class="d-flex justify-content-between align-items-center pb-2">
	                                <span class="med-14">Image Name</span>
	                                <div class="drag-icon">
	                                    <img src="{{ asset('public/admin/assets/images/Drag_icon_v.svg')}}">
	                                </div>
	                            </div>
	                            <div class="img_to_choose">
	                                <img src="{{ asset('public/admin/assets/images/up2.jpg')}}">
	                            </div>
	                            <div class="d-flex justify-content-between align-items-center pt-2">
	                                <button type="button" class="btn btn-copy-url"><img
	                                        src="{{ asset('public/admin/assets/images/url_icon.svg')}}"> Copy URL</button>
	                                <div class="set-default-btn">
	                                    Use
	                                    <div class="button-switch">
	                                        <input type="checkbox" id="" class="switch">
	                                    </div>
	                                </div>
	                            </div>
	                        </li>
	                        <li>
	                            <div class="d-flex justify-content-between align-items-center pb-2">
	                                <span class="med-14">Image Name</span>
	                                <div class="drag-icon">
	                                    <img src="{{ asset('public/admin/assets/images/Drag_icon_v.svg')}}">
	                                </div>
	                            </div>
	                            <div class="img_to_choose">
	                                <img src="{{ asset('public/admin/assets/images/up3.jpg')}}">
	                            </div>
	                            <div class="d-flex justify-content-between align-items-center pt-2">
	                                <button type="button" class="btn btn-copy-url"><img
	                                        src="{{ asset('public/admin/assets/images/url_icon.svg')}}"> Copy URL</button>
	                                <div class="set-default-btn">
	                                    Use
	                                    <div class="button-switch">
	                                        <input type="checkbox" id="" class="switch">
	                                    </div>
	                                </div>
	                            </div>
	                        </li>
	                        <li>
	                            <div class="d-flex justify-content-between align-items-center pb-2">
	                                <span class="med-14">Image Name</span>
	                                <div class="drag-icon">
	                                    <img src="{{ asset('public/admin/assets/images/Drag_icon_v.svg')}}">
	                                </div>
	                            </div>
	                            <div class="img_to_choose">
	                                <img src="{{ asset('public/admin/assets/images/up4.jpg')}}">
	                            </div>
	                            <div class="d-flex justify-content-between align-items-center pt-2">
	                                <button type="button" class="btn btn-copy-url"><img
	                                        src="{{ asset('public/admin/assets/images/url_icon.svg')}}"> Copy URL</button>
	                                <div class="set-default-btn">
	                                    Use
	                                    <div class="button-switch">
	                                        <input type="checkbox" id="" class="switch">
	                                    </div>
	                                </div>
	                            </div>
	                        </li>
	                        <li>
	                            <div class="d-flex justify-content-between align-items-center pb-2">
	                                <span class="med-14">Image Name</span>
	                                <div class="drag-icon">
	                                    <img src="{{ asset('public/admin/assets/images/Drag_icon_v.svg')}}">
	                                </div>
	                            </div>
	                            <div class="img_to_choose">
	                                <img src="{{ asset('public/admin/assets/images/up5.jpg')}}">
	                            </div>
	                            <div class="d-flex justify-content-between align-items-center pt-2">
	                                <button type="button" class="btn btn-copy-url"><img
	                                        src="{{ asset('public/admin/assets/images/url_icon.svg')}}"> Copy URL</button>
	                                <div class="set-default-btn">
	                                    Use
	                                    <div class="button-switch">
	                                        <input type="checkbox" id="" class="switch">
	                                    </div>
	                                </div>
	                            </div>
	                        </li>
	                        <li>
	                            <div class="d-flex justify-content-between align-items-center pb-2">
	                                <span class="med-14">Image Name</span>
	                                <div class="drag-icon">
	                                    <img src="{{ asset('public/admin/assets/images/Drag_icon_v.svg')}}">
	                                </div>
	                            </div>
	                            <div class="img_to_choose">
	                                <img src="{{ asset('public/admin/assets/images/up6.jpg')}}">
	                            </div>
	                            <div class="d-flex justify-content-between align-items-center pt-2">
	                                <button type="button" class="btn btn-copy-url"><img
	                                        src="{{ asset('public/admin/assets/images/url_icon.svg')}}"> Copy URL</button>
	                                <div class="set-default-btn">
	                                    Use
	                                    <div class="button-switch">
	                                        <input type="checkbox" id="" class="switch">
	                                    </div>
	                                </div>
	                            </div>
	                        </li>
                    	-->
                    </ul>
                </div>

                <div id="description" class="container-tab tab-pane fade"><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="label">Event Name</label>
                            <input type="text" name="" class="form-control" placeholder="Type Here..">
                        </div>
                        <div class="col-md-6">
                            <label class="label">Event Display Name</label>
                            <input type="text" name="" class="form-control" placeholder="Type Here..">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="label">Event Start From</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-small">Start Date</label>
                                    <input type="date" name="" class="form-control date-field">
                                </div>
                                <div class="col-md-6">
                                    <label class="label-small">Start Time</label>
                                    <input type="text" name="" placeholder="hh/mm" class="form-control time-field">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="label">Event Ends At</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label-small">End Date</label>
                                    <input type="date" name="" class="form-control date-field">
                                </div>
                                <div class="col-md-6">
                                    <label class="label-small">End Time</label>
                                    <input type="text" name="" placeholder="hh/mm" class="form-control time-field">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="label">Event URL</label>
                            <input type="text" name="" class="form-control" placeholder="Type Here..">
                        </div>
                        <div class="col-md-6">
                            <label class="label">Event Website URL</label>
                            <input type="text" name="" class="form-control" placeholder="Type Here..">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="label">Event Description</label>
                            <textarea class="form-control event-des-textarea" placeholder="Type Here.."></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="label">Address</label>
                            <input type="text" name="" class="form-control" placeholder="Type Here..">
                        </div>
                    </div>
                </div>

                <div id="about" class="container-tab tab-pane fade"><br>
                    <form method="post">
                        <textarea id="mytextarea"></textarea>
                    </form>
                    <button id="bottone" onclick="myFunc()">Ok</button>
                </div>

                <div id="venue" class="container-tab tab-pane fade"><br>
                    <form method="post">
                        <textarea id="mytextarea1"></textarea>
                    </form>
                </div>

                <div id="tandc" class="container-tab tab-pane fade"><br>
                    <form method="post">
                        <textarea id="mytextarea2"></textarea>
                    </form>
                </div>

                <div id="social" class="container-tab tab-pane fade"><br>
                    <ul class="social-link">
                        <li>
                            <img class="social-icon" src="{{ asset('public/admin/assets/images/facebook.svg')}}">
                            <div class="button-switch">
                                <input type="checkbox" id="switch-blue" class="switch">
                            </div>
                        </li>
                        <li>
                            <img class="social-icon" src="{{ asset('public/admin/assets/images/twitter.svg')}}">
                            <div class="button-switch">
                                <input type="checkbox" id="switch-blue" class="switch">
                            </div>
                        </li>
                        <li>
                            <img class="social-icon" src="{{ asset('public/admin/assets/images/linkedin.svg')}}">
                            <div class="button-switch">
                                <input type="checkbox" id="switch-blue" class="switch">
                            </div>
                        </li>
                        <li>
                            <img class="social-icon" src="{{ asset('public/admin/assets/images/instagram.svg')}}">
                            <div class="button-switch">
                                <input type="checkbox" id="switch-blue" class="switch">
                            </div>
                        </li>
                        <li>
                            <img class="social-icon" src="{{ asset('public/admin/assets/images/whatsapp-icon.png')}}">
                            <div class="button-switch">
                                <input type="checkbox" id="switch-blue" class="switch">
                            </div>
                        </li>
                        <li>
                            <img class="social-icon" src="{{ asset('public/admin/assets/images/amazon.svg')}}">
                            <div class="button-switch">
                                <input type="checkbox" id="switch-blue" class="switch">
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- For Cropper -->
	@section('cropper_script')
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" crossorigin="anonymous" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" crossorigin="anonymous"></script>

		<script type="text/javascript">
		    var $modal = $('#modal');
		    var image = document.getElementById('image');
		    var cropper;

		    $("body").on("change", ".image", function(e)
		    {
		        var files = e.target.files;

		        let fileSize = e.target.files[0];
                let extension = fileSize.type;
                let size = (fileSize.size) / (1024 * 1024);

                if(size > 4)
                {
                	alert("The file size must be less than 4 MB");
                    return false;
                }
                
		        var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')

				var getvalues =filename.split(".");
				var filenameFinal = getvalues[0];

		        $("#uploadImageName").val(filenameFinal);

		        var done = function (url) {
		            image.src = url;
		            $modal.modal('show');
		        };

		        var reader;
		        var file;
		        var url;

		        if (files && files.length > 0) {
		            file = files[0];

		            if (URL) {
		                done(URL.createObjectURL(file));
		            }
		            else if (FileReader) {
		                reader = new FileReader();
		                reader.onload = function (e) {
		                    done(reader.result);
		                };
		                reader.readAsDataURL(file);
		            }
		        }
		    });

			var finalCropWidth = 1920;
			var finalCropHeight = 500;
			var finalAspectRatio = finalCropWidth / finalCropHeight;

		    $modal.on('shown.bs.modal', function () {
		        cropper = new Cropper(image, {
		            viewMode: 3,
		            scalable: false,
		            maxContainerHeight: 500,
		            aspectRatio: finalAspectRatio,

		            // aspectRatio: 16/9,
		            // preview: '.preview',
		            // minCanvasHeight:500,
		            // minCropBoxHeight:500,
					// aspectRatio: 1,
					// viewMode: 1,
					// preview: '.preview_profile',
					// autoCropArea: 0.7,
					// viewMode: 1,
					// center: true,
					// dragMode: 'move',
					// movable: true,
					// scalable: true,
					// guides: true,
					// zoomOnWheel: true,
					// cropBoxMovable: true,
					// wheelZoomRatio: 0.1,
					// ready: function () {
					    //Should set crop box data first here
					    // cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					// }

		        });
		    }).on('hidden.bs.modal', function () {
		       cropper.destroy();
		       $("#drop-file").val('');
		       cropper = null;
		    });

		    $("#crop").click(function() {
		        // alert('crop');
		        canvas = cropper.getCroppedCanvas({
		            width: 1920,
		            height: 500,
		        });

		        canvas.toBlob(function(blob) {
		            var reader = new FileReader();
		            reader.readAsDataURL(blob);

		            reader.onloadend = function() {
		            	var uploadImageName = $("#uploadImageName").val();
		                var base64data = reader.result;
		                $.ajax({
		                    type: "POST",
		                    dataType: "json",
		                    url: "uploadImg",
		                    data: { "_token": "{{ csrf_token() }}", 'image': base64data, 'filename': uploadImageName},

		                    success: function(data) {
		                        $modal.modal('hide');
		                        // alert("success upload image");

		                        if(data.response=='success')
		                        {
		                        	// alert(data.response);
		                        	location.reload(true);		                            
		                        }
		                        else
		                        {
		                            $('#upload_image_error').html('Invalid Extension, Please upload JPG, JPEG and PNG Image');
		                        }
		                    }
		                });
		            }
		        });

		    })
		</script>
	@endsection
<!-- For Cropper -->

@endsection


