
@extends('layouts.user')

@section('content')
<style>
     .thank-you-container {
            max-width: 600px;
            text-align: left;
            background-color: #ffffff;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-weight: bold;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
</style>
<div class="container">
	@include('elements.event_info')
	<div class="bg-white p-2 rounded">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="p-3 p-lg-4">
                    {{--<div class="mb-md-2 top-heading">
                        <h5 class="mb-0 d-flex flex-grow-1">
                            <a href="{{route('main')}}" class="btn-back me-3"><img src="{{asset('public/images/back_arrow.svg')}}"></a> Basic Information
                        </h5>
                    </div>--}}
                    <form id="activeForm" class="thanks_min_h">
                        <div class="successfully thank-you-container">
                           
                            <p class="mt-4">Thank you for registering for <strong>EZZMYEVENT 2025</strong>; we will share your QR code to your official email id shortly.</p>
                                
                            <a href="{{route('main')}}" class="btn btn-outline px-4 me-2">Home</a>
                        </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('elements.footer')
@endsection
@section('script')
<script>
</script>
@endsection

<style>
.thanks_min_h{
min-height: calc(100vh - 415px);
display: flex;
align-items: center;
justify-content: center;
width: 100%;
flex-wrap: wrap;
margin-bottom:50px;
}
</style>
