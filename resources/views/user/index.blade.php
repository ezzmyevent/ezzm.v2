@extends('layouts.user')
@section('content')
<style type="text/css">
	li {
	  display: inline-block;
	  font-size: 1em;
	  list-style-type: none;
	  padding: 1em;
	  text-transform: uppercase;
	}

	li span {
	  display: block;
	  font-size: 4.5rem;
	}
</style>
<div class="container">
	<div class="top-banner b-br-bl-0"><img src="{{ url('/public/ezzmyeventCover.png') }}" alt=""></div>
	<div class="event-box py-2 justify-content-center mt-0 b-tr-tl-0">
		<div class="event-timer text-center">
			<h6>Celebration begins on</h6>
				<div id="timer">
					<ul>
			      <li><span id="days"></span>days</li>
			      <li><span id="hours"></span>Hours</li>
			      <li><span id="minutes"></span>Minutes</li>
			      <li><span id="seconds"></span>Seconds</li>
			    </ul>
			  </div>
		</div>
	</div>
	<div class="row g-3 g-lg-5">
		<div class="col-md-8">
			<div class="bg-white rounded p-3 h-100">
				<ul class="nav nav-tabs">
					<li><button data-bs-toggle="tab" data-bs-target="#about" type="button"
					class="nav-link active">Event</button></li>
				</ul>
				<div class="tab-content pt-4">
					<!-- <div id="about" class="tab-pane fade show active">
						<p class="fs-5"><b>LKQ</b> India Family Day is a vibrant and engaging event, bringing together members and their families for a day of fun and celebration. With this year's theme of "Imprints - Celebrating Our Journey Together," we honor the tireless dedication and unwavering commitment of all individuals who have created an everlasting impact in <b>LKQ</b> India. <br>
						<br>
						As we gather under the theme of "Imprints," we recognize that each member in our <b>LKQ</b> India family has contributed a unique mark to our shared journey. It's a day where stories are shared, friendships are strengthened, and the collective spirit of our organization is celebrated. Through engaging activities, interactive workshops, and cultural showcases, we aim to create lasting memories that reflect the essence of our collaborative efforts.</p>
					</div> -->

					<div id="about" class="tab-pane fade show active">
					<p class="fs-5"><b>
					EZZ India Family Day 2025 </b>  is a joyous celebration of unity and diversity, a day that brings together our vibrant community of team members and their families to honor the strength of our connections. This year, under the theme of "Ezzmyevent - Diverse Cultures, One Vision," we celebrate the harmony that emerges when people from varied backgrounds come together with a shared purpose.
					
						<br>
						<br>
						On this special day, we’ll come together to enjoy a tapestry of cultural performances and interactive activities that celebrate the richness of our diversity and the unity of our vision. It’s a time to share stories, strengthen bonds, and create lasting memories that remind us of the incredible journey we’re on together.<br><br>
						Let’s celebrate Ezzmyevent vibrant expression of the values that make <b>LKQ</b> India a truly remarkable family!
					</p>
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="book-now p-lg-4">
				<div class="d-flex flex-wrap gap-2 reg_cls">
					<p class="w-100">Click here to Register</p>
					<a href="{{ route('login') }}" class="btn btn-danger py-2 m-auto">Register Now<i
					class="bi bi-chevron-right ms-2"></i></a>
				</div>
			</div>
			<div class="d-block bg-white rounded p-3 p-lg-4 mt-4">
				<h5 class="mb-4">Date and Address</h5>
				<div class="d-flex align-items-start mb-3">
					<span class="svg_icn me-2 me-lg-3">
						<img src="{{asset('public/images/date_icon.svg')}}"alt="">
					</span>
					<b class="flex-grow-1">
    <span class="text-muted d-block lh-1">DATE</span>
    {{ isset($master_setting['settings']) ? e($master_setting['settings']->event_date) : 'Date not set' }}
</b>

				</div>
				
				<div class="d-flex align-items-start mb-3">
					<span class="svg_icn me-2 me-lg-3"><img src="{{asset('public/images/location.svg')}}"
					alt=""></span>
					<address class="flex-grow-1">
						<span class="text-muted d-block lh-1">LOCATION</span>
						<p class="mb-0"><strong> JECC, Jaipur</strong></p>
					</address>
				</div>
				
			</div>
			</div>
		</div>
		
	</div>
	@include('elements.footer')
	@endsection

<script>
	var countDownDate = new Date("January 25, 2025 13:30:00").getTime();
	//var countDownDate = new Date(EVENT_TIME).getTime();
	// Update the count down every 1 second
	var x = setInterval(function() {
	// Get today's date and time
	var now = new Date().getTime();
	// Find the distance between now and the count down date
	var distance = countDownDate - now;
	// Time calculations for days, hours, minutes and seconds
	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	var hours = (hours.toLocaleString(undefined,{minimumIntegerDigits: 2}));
	var minutes = (minutes.toLocaleString(undefined,{minimumIntegerDigits: 2}));
	var seconds = (seconds.toLocaleString(undefined,{minimumIntegerDigits: 2}));
	// Output the result in an element with id="demo"
	document.getElementById("timer").innerHTML = '<ul><li><span id="days">'+ days +'</span>Days</li><li><span id="hours">' + hours + '</span> Hours </li><li><span id="minutes">'+ minutes +'</span> Min </li><li><span id="seconds">' + seconds + '</span>Sec</li></ul>';
	// If the count down is over, write some text
	if (distance < 0) {
	clearInterval(x);
	document.getElementById("timer").innerHTML = '<ul><li><span id="days">00</span>Days</li><li><span id="hours">00</span> Hours </li><li><span id="minutes">00</span> Min </li><li><span id="seconds">00</span>Sec</li></ul>';
	}
	}, 1000);
	</script>




