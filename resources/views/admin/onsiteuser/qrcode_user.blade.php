@php
 $arr='["'.$unique_code.'","'.$category.'"]';
@endphp


<div class="centerImg">
<img src="{{ asset('public/ID22.png')}}" alt="IndiaDesign" style="display: block;max-width:100%;" />

<div class="generateCode">
<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($arr)) !!}">
<p>{{$unique_code}}</p>
</div>
</div>







<style type="text/css">
.centerImg{ 
display: flex; 
align-items: flex-start; 
justify-content: center; 
width: 100%; 
position: relative;
margin-top: 5vh; 
}

.generateCode{     
position: absolute;
text-align: center;
left: 38%;
top: 67%;
z-index: 7;
width: 24%;
}
</style>