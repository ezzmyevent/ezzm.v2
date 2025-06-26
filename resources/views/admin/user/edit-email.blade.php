@extends('admin.layouts.master')
@section('content')




<div class="container">
			<div class="d-flex justify-content-between mb-3 flex-wrap">
				<div class="d-flex">
					<div class="arw-back">
						<a href="{{ url('/admin/email-builder') }}"><span class="fas fa-chevron-left"></span></a>
					</div>
					<div class="tkt-heading-wrapper">
						<h2 class="heading mb-0">Edit Email</h2>
					</div>
				</div>
				
			</div>


			




			<!-- Tickets Table -->
			<div class="row">
				<div class="col-md-12">
					<div class="mail-wrap">
						<div  class="main-wrap-inner">
							<img src="{{ asset('public/admin/assets/images/music-support.png')}}" class="email-logo-top">
							<div class="image-drop-zone-wrapper">
								<div class="edit-mail-icon"><img src="{{ asset('public/admin/assets/images/edit_icon_white.svg')}}"></div>
							<div class="image-drop-zone">
					      	<input type="file" name="" class="drop-file" id="drop-file">
					      	<div class="image-drop-detail">
					      		<img src="{{ asset('public/admin/assets/images/img_icon.svg')}}" class="drop-img-icon">
					      		<p class="drop-text">Drop you image here or <span class="blue">Browse</span></p>
					      		<p class="file-support-text">Support:JPG,JPEG,PNG (UPTO 4MB)</p>
					  			<p class="drop-file-name" id="drop-file-name"></p>
					      	</div>
					      </div>
					      </div>
					      <p class="name-email">Hi Rohan,</p>
					      <form method="post">
						    <textarea id="mytextarea3"></textarea>
						  </form>
						</div>
						<img src="{{ asset('public/admin/assets/images/music-support.png')}}" class="email-logo-bottom">
						<ul class="email-social-icon">
							<li><a href="#"><img src="{{ asset('public/admin/assets/images/facebook-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('public/admin/assets/images/twitter-icon.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('public/admin/assets/images/linkedin-icon.png')}}"></a></li>
						</ul>

					</div>
				</div>
			</div>




</div>






@endsection


