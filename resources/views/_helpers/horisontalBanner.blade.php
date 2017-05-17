@if(count($horisontalBanners)==3)
    <div class="horizontalBannerUp">
        <div class="container commercialHorisontalBanner">
            <div class="row horisontalBannerDiv">
                <div class="col-md-4 col-sm-4">
                    @if($horisontalBanners[0]->redirect_url)
                        <a href="{{$horisontalBanners[0]->redirect_url}}">
                            <img class="imgHorisontalBanner1" src="{{ asset('images/banners/'.$horisontalBanners[0]->img_name) }}" alt="">
                        </a>
                    @else
                        <img class="imgHorisontalBanner1" src="{{ asset('images/banners/'.$horisontalBanners[0]->img_name) }}" alt="">
                    @endif
                </div>
                <div class="col-md-4 col-sm-4">
                    @if($horisontalBanners[1]->redirect_url)
                        <a href="{{$horisontalBanners[1]->redirect_url}}">
                            <img class="imgHorisontalBanner2" src="{{ asset('images/banners/'.$horisontalBanners[1]->img_name) }}" alt="">
                        </a>
                    @else
                        <img class="imgHorisontalBanner2" src="{{ asset('images/banners/'.$horisontalBanners[1]->img_name) }}" alt="">
                    @endif
                </div>
                <div class="col-md-4 col-sm-4">
                    @if($horisontalBanners[2]->redirect_url)
                        <a href="{{$horisontalBanners[2]->redirect_url}}">
                            <img class="imgHorisontalBanner3" src="{{ asset('images/banners/'.$horisontalBanners[2]->img_name) }}" alt="">
                        </a>
                    @else
                        <img class="imgHorisontalBanner3" src="{{ asset('images/banners/'.$horisontalBanners[2]->img_name) }}" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif