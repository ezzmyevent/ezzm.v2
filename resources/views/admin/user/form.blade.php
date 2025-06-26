@extends('admin.layouts.master')
@section('content')



<div class="container">
			<div class="d-flex justify-content-between mb-3 flex-wrap">
				<div class="d-flex">
						<h2 class="heading mb-0">Form</h2>
				</div>
				<div class="save-next">
					<button type="button" class="btn btn-main" data-toggle="modal" data-target="#addFieldModal">+ Add New</button>
				</div>
			</div>


			




<!-- Form -->

<div class="row">
		<div class="col-lg-8">
				<div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="sub-heading black">Step 1 Information <span class="fas fa-chevron-down"></span></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in show" data-parent="#accordion">
        <div class="panel-body">
        		<div class="field-box">
        				<label class="label">Your Name*</label>
        				<div class="inp-box">
        						<img class="drag-icon" src="{{ asset('public/admin/assets/images/drag_icon.svg')}}">
        						<input class="form-control input-box" type="text" name="">
        						<div class="inp-btns">
        							<button type="button" class="icon-btn delete-btn" data-toggles="tooltip" title="Delete"><img class="btn-icon" src="{{ asset('public/admin/assets/images/delete_icon.svg')}}"></button>
        							<button type="button" class="icon-btn edit-btn" data-toggle="modal" data-target="#editFieldModal" data-toggles="tooltip" title="Edit"><img class="btn-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"></button>
        							<button type="button" class="icon-btn copy-btn" data-toggles="tooltip" title="Copy"><img class="btn-icon" src="{{ asset('public/admin/assets/images/copy_icon.svg')}}"></button>
        						</div>
        				</div>
        		</div>
        		<div class="field-box">
        				<label class="label">Email Address*</label>
        				<div class="inp-box">
        						<img class="drag-icon" src="{{ asset('public/admin/assets/images/drag_icon.svg')}}">
        						<input class="form-control input-box" type="text" name="">
        						<div class="inp-btns">
        							<button type="button" class="icon-btn delete-btn" data-toggles="tooltip" title="Delete"><img class="btn-icon" src="{{ asset('public/admin/assets/images/delete_icon.svg')}}"></button>
        							<button type="button" class="icon-btn edit-btn" data-toggle="modal" data-target="#editFieldModal" data-toggles="tooltip" title="Edit"><img class="btn-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"></button>
        							<button type="button" class="icon-btn copy-btn" data-toggles="tooltip" title="Copy"><img class="btn-icon" src="{{ asset('public/admin/assets/images/copy_icon.svg')}}"></button>
        						</div>
        				</div>
        		</div>
        		<div class="field-box">
        				<label class="label">Country*</label>
        				<div class="inp-box">
        						<img class="drag-icon" src="{{ asset('public/admin/assets/images/drag_icon.svg')}}">
        						<input class="form-control input-box" type="text" name="">
        						<div class="inp-btns">
        							<button type="button" class="icon-btn delete-btn" data-toggles="tooltip" title="Delete"><img class="btn-icon" src="{{ asset('public/admin/assets/images/delete_icon.svg')}}"></button>
        							<button type="button" class="icon-btn edit-btn" data-toggle="modal" data-target="#editFieldModal" data-toggles="tooltip" title="Edit"><img class="btn-icon" src="{{ asset('public/admin/assets/images/edit_icon.svg')}}"></button>
        							<button type="button" class="icon-btn copy-btn" data-toggles="tooltip" title="Copy"><img class="btn-icon" src="{{ asset('public/admin/assets/images/copy_icon.svg')}}"></button>
        						</div>
        				</div>
        		</div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="sub-heading black">Step 2 Information<span class="fas fa-chevron-down"></span></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse" data-parent="#accordion">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>
 
  </div> 
		</div>
		<div class="col-lg-4">
				<ul class="input-list">
						<li><div class="title-with-icon"><img class="input-list-icon" src="{{ asset('public/admin/assets/images/text_field.svg')}}"> Text Field</div> <button type="button" class="btn btn-add-input">Add</button></li>
						<li><div class="title-with-icon"><img class="input-list-icon" src="{{ asset('public/admin/assets/images/text_area.svg')}}"> Text Area</div> <button type="button" class="btn btn-add-input">Add</button></li>
						<li><div class="title-with-icon"><img class="input-list-icon" src="{{ asset('public/admin/assets/images/select.svg')}}"> Select</div> <button type="button" class="btn btn-add-input">Add</button></li>
						<li><div class="title-with-icon"><img class="input-list-icon" src="{{ asset('public/admin/assets/images/radio_group.svg')}}"> Radio Group</div> <button type="button" class="btn btn-add-input">Add</button></li>
						<li><div class="title-with-icon"><img class="input-list-icon" src="{{ asset('public/admin/assets/images/file_upload.svg')}}"> File Upload</div> <button type="button" class="btn btn-add-input">Add</button></li>
						<li><div class="title-with-icon"><img class="input-list-icon" src="{{ asset('public/admin/assets/images/date_field.svg')}}"> Date Field</div> <button type="button" class="btn btn-add-input">Add</button></li>
						<li><div class="title-with-icon"><img class="input-list-icon" src="{{ asset('public/admin/assets/images/checkbox_group.svg')}}"> Checkbox Group</div> <button type="button" class="btn btn-add-input">Add</button></li>
				</ul>
		</div>
</div>





</div>




@endsection


