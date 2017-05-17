@if(count($caruselBanners)>0)
    <div class="row carousel-holder">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @for($i=0; $i<count($caruselBanners); $i++)
                    @if($i == 0)
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    @else
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li>
                    @endif
                @endfor
            </ol>
            <div class="carousel-inner">
                @for($i=0; $i<count($caruselBanners); $i++)
                    @if($i == 0)
                        <div class="item active">
                    @else
                        <div class="item">
                    @endif
                            @if($caruselBanners[$i]->redirect_url)
                                <a href="{{$caruselBanners[$i]->redirect_url}}">
                                    <img class="slide-image" src="{{ asset('images/carusel/'.$caruselBanners[$i]->img_name) }}" alt="">
                                </a>
                            @else
                                <img class="slide-image" src="{{ asset('images/carusel/'.$caruselBanners[$i]->img_name) }}" alt="">
                            @endif
                        </div>
                @endfor
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
@endif