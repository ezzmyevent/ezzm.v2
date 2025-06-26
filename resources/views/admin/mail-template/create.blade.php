@extends('admin.layouts.master')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single{
        height: 35px;
    }
    .select2-container--default .select2-selection--single{
        border: 1px solid #ced4da;
        font-size: 14px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        line-height: 33px;
    }
    #createtemplate > .row{
        margin-bottom: 20px;
    }
    .fcard{
        padding: 15px;
    list-style: none;
    box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    }
    #addNewShortCodeForm .row{
        margin-bottom: 15px;
    }
    .fs-13{
        font-size: 13px;
    }
</style>
@endpush

@section('content')

<div class="container">
    <div class="d-flex justify-content-between mb-3 flex-wrap">
        <div class="d-flex">
            <h2 class="heading mb-0">Create Mail Template</h2>
        </div>
        <div class="save-next">
            <a href="{{route('mail-template.index')}}" class="btn btn-main btn-add-ticket"> Templates List</a>
        </div>
    </div>

    <!-- form content --> 
    <div class="row">
        <div class="col-md-8">
            <form id="createtemplate" method="post" enctype="multipart/form-data" action="{{route('tickets-save')}}">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <label class="label">Title <span class="error-required">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="" value="" required>
                    </div>
                </div>    

                <div class="row">
                    <div class="col-md-12">
                        <label class="label">Subject <span class="error-required">*</span></label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="" value="">
                    </div>
                </div>  
                 
                <div class="row">
                    <div class="col-md-12">
                        <label class="label">Attachment <p class="error-required fs-13">Note: You can add multiple attachments by separating each one with a (,) comma.</p></label>
                        <input type="text" name="attachment" id="attachment" class="form-control" placeholder="" value="">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-12">
                        <label class="label">Content <span class="error-required">*</span></label>
                        <textarea class="form-control" id="content" name="content"></textarea>
                    </div>
                </div>   

                <div class="row">
                    <div class="col-md-12">
                        <label class="label">Reminder Status</label>
                        <input type="number" min="0" name="reminder_status" id="reminder_status" class="form-control" placeholder="" value="">
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-12">
                        <label class="label">Category</label>
                        <select class="form-control" id="user_category" name="user_category">
                                <option value="all" selected>All Category</option>
                                @foreach ($categorieslist as $row)
                                    <option value="{{$row->category}}">{{$row->category}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class="label">Status <span class="error-required">*</span></label>
                        <select class="form-control" id="status" name="status">
                            <option value="" disabled selected>--SELECT--</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-save-next submit-btn">Save</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="col-md-4">
            <form id="addNewShortCodeForm" class="mt-4 fcard">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" placeholder="Title" name="title" id="title" class="form-control" placeholder="" value="" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" placeholder="ShortCode" name="shortcode" id="shortcode" class="form-control" placeholder="" value="" required>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <select class="form-control" name="attachwith" id="attachwith">
                            <option value="" selected disabled>--Attach With --</option>
                            @foreach($tables as $table => $columns)
                            <optgroup label="{{ ucfirst($table) }}">
                                @foreach($columns as $column)
                                    <option value="{{ $table }}.{{ $column }}">{{ ucfirst($table) }} - {{ $column }}</option>
                                @endforeach
                            </optgroup>
                            @endforeach                            
                        </select>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-add-input w-100 form-control add-shortcode-btn">Add</button>
                    </div>
                </div>  
            </form>
            <ul class="input-list mt-4" id="shortcodeslist"> 
             </ul>
        </div>   

    </div>

</div>
</div>
@endsection

<!-- For Cropper -->
@section('cropper_script')
@endsection

@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.9.2/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: 'textarea',  // Your TinyMCE selector
    plugins: 'advlist autolink lists link image charmap print preview anchor code fullpage',  // Added 'fullpage' plugin
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image | code',  // 'image' and 'code' buttons
    menubar: 'insert',  // Adds the "Insert" menu with options like Image
    image_title: true,  // Enable the title field in the Image dialog
    fullpage_default_doctype: '<!DOCTYPE html>',  // Handle full HTML documents
    valid_elements: '*[*]',  // Allow all elements and attributes
    extended_valid_elements: 'html, head, body, title, meta, link, style, script[*]',  // Allow document-level tags and script
    forced_root_block: false,  // Disable auto <p> tags
    verify_html: false,  // Relax the strict HTML verification
});
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#attachwith').select2();
    });
</script>

<!--  adding shortcode -->
<script type="text/javascript">
$(document).on('click','.add-shortcode-btn', function (e) {
    e.preventDefault();
    var form = $('#addNewShortCodeForm')[0];
    var formData = new FormData(form);
    $.ajax({
        type: 'POST',                
        url: "{{ route('shortcode.store') }}",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
                $('.add-shortcode-btn').html('Waiting...'); 
        },
        success: function(response) {
            $('.add-shortcode-btn').html('Add'); 
            if ($.isEmptyObject(response.error)) {
                $('#addNewShortCodeForm')[0].reset();
                toastr.success('Shortcode successfully created!');
                refreshShortCodesList();
            } else {
                console.log(response.error);
                $.each(response.error, function(key, value) {
                    toastr.options = { "positionClass": "toast-bottom-right" };
                    toastr.error(value);
                });
            }
        },
        error: function(xhr) {
            $('.add-shortcode-btn').html('Add'); 

            var errorResponse = JSON.parse(xhr.responseText);
            if (xhr.status === 400) {
                $.each(errorResponse.error, function(key, value) {
                    toastr.error(value);
                });
            } else if (xhr.status === 500) {
                toastr.error('There was an issue creating the shortcode. Please try again later.');
            }
        }
    });
});
</script>
<!-- shortcode end -->

<!-- fetch shortcode list -->
<script type="text/javascript">
function refreshShortCodesList(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        type: 'POST',                
        url: "{{ route('shortcode.list') }}",
        data: {
            "_token" : "{{ csrf_token() }}"
        },
        contentType: false,
        processData: false,
        success: function(response) {
            if ($.isEmptyObject(response.error)) {
                if (response.success) {
                    var shortcodeList = $('#shortcodeslist');
                    shortcodeList.empty();
                    $.each(response.list, function(index, item) {
                        var listItem = `
                            <li>
                                <div class="title-with-icon">${item.title}</div>
                                <div>
                                  <a href="javascript:void(0)" class="copy-icon" data-shortcode="${item.shortcode}" title="copy shortcode"><i class="fa fa-clone"></i></a> 
                                  <button type="button" class="btn btn-add-input shortcodebtn" data-shortcode="${item.shortcode}">${item.shortcode}</button>                                
                                </div>
                             </li>
                        `;
                        shortcodeList.append(listItem);
                    });
                }   
            } else {
                console.log(response.error);
                toastr.options = { "positionClass": "toast-bottom-right" };
                toastr.error(value);
            }
        },
        error: function(xhr) {
            var errorResponse = JSON.parse(xhr.responseText);
            if (xhr.status === 400) {
                $.each(errorResponse.error, function(key, value) {
                    toastr.error(value);
                });
            } else if (xhr.status === 500) {
                toastr.error('There was an issue creating the shortcode. Please try again later.');
            }
        }
    });
}
refreshShortCodesList();
</script>
<!-- end fetch shortcode list -->


<!--- copy shortcode in clipboard -->
<script>
$(document).on('click','.copy-icon', function (e) {
      var shortcode = this.getAttribute('data-shortcode');
      var tempInput = document.createElement('textarea');
      tempInput.value = shortcode;
      document.body.appendChild(tempInput);
      tempInput.select();
      tempInput.setSelectionRange(0, 99999);
      document.execCommand('copy');
      document.body.removeChild(tempInput);
      toastr.success('Shortcode copied: ' + shortcode);
});
</script>
<!-- end shortcode copy in clipboard -->

<script type="text/javascript">
$(document).on('click','.submit-btn', function (e) {
    e.preventDefault();
	
    var editorContent = tinymce.get('content').getContent();
    var form = $('#createtemplate')[0];
    var formData = new FormData(form);
    formData.append('content', editorContent);

    $.ajax({
        type: 'POST',                
        url: "{{ route('mail-template.store') }}",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
                $('.submit-btn').html('Waiting...'); 
        },
        success: function(response) {
            $('.submit-btn').html('Save'); 

            if ($.isEmptyObject(response.error)) {
                toastr.success('Mail Template successfully created!');
                location.reload();
            } else {
                console.log(response.error);
                $.each(response.error, function(key, value) {
                    toastr.options = { "positionClass": "toast-bottom-right" };
                    toastr.error(value);
                });
            }
        },
        error: function(xhr) {
            $('.submit-btn').html('Save'); 

            var errorResponse = JSON.parse(xhr.responseText);
            if (xhr.status === 400) {
                $.each(errorResponse.error, function(key, value) {
                    toastr.error(value);
                });
            } else if (xhr.status === 500) {
                toastr.error('There was an issue creating the mail template. Please try again later.');
            }
        }
    });

});
</script>
@endpush