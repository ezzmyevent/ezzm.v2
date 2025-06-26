<style>
    .nav-tabs ol {
        padding-left: 20px;
    }
</style>

<div class="event-box sticky-md-top">
    <div class="flex-grow-1">
        <h4 class="mb-3">{{ $master_setting['settings']->title }}</h4>
       
    </div>
    <!-- <a href="javascript:;" class="share" data-bs-toggle="modal" data-bs-target="#stream-share"><i class="bi bi-share-fill"></i></a> -->
</div>
<div id="stream-share" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="stream-shareLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"><button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
            <div class="modal-body p-lg-4 text-center">
                <h5 class="mb-0 text-uppercase">SHARE EVENT</h5>
                <ul class="social-links">
                    @if($master_setting['settings']->facebook != '')
                    <li>
                        <a data-social="whatsapp" href="javascript:void(0);" data-hreflink="{{$master_setting['settings']->facebook}}" id="shareBtnFacebook" class="facebook">
                            <img src="{{asset('public/svg/facebook.svg')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($master_setting['settings']->twitter != '')
                    <li>
                        <a data-social="whatsapp" href="javascript:void(0);" data-hreflink="{{$master_setting['settings']->twitter}}" class="twitter" id="shareBtnTwitter">
                            <img src="{{asset('public/svg/twitter.svg')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($master_setting['settings']->linkedin != '')
                    <li>
                        <a data-social="whatsapp" href="javascript:void(0);" data-hreflink="{{$master_setting['settings']->linkedin}}" class="linkedin" id="shareBtnLinkedin">
                            <img src="{{asset('public/svg/linkedin.svg')}}" alt="">
                        </a>
                    </li>
                    @endif
                    @if($master_setting['settings']->whatsapp != '')
                    <li>
                        <a data-social="whatsapp" href="javascript:void(0);" data-hreflink="{{$master_setting['settings']->whatsapp}}" class="whatsapp" id="shareBtnWhatsapp">
                            <img src="{{asset('public/svg/whatsapp.svg')}}" alt="">
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>