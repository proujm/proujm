@if($item)
    <div class="newsTitle text-center col-md-12">
        <h1>{{mb_strimwidth($item->title,0,250,'...')}}</h1>
    </div>
    @if($item->image)
        <div class="newsImage text-center col-md-12">
            <a href="{{ asset('images/news/'.$item->image) }}" class="fullScreenImage" data-lightbox="example-set" data-title="">
                <img src="{{ asset('images/news/'.$item->image) }}" class="fullScreenImage newsImg">
            </a>
        </div>
    @endif
    @if($item->video)
        <div class="newsVideo text-center col-md-12">
            <iframe class="newsIfframe" src="http://www.youtube.com/embed/{!!Helpers::getYoutubeVideoID($item->video)!!}?autoplay=0" allowfullscreen="" frameborder="0"></iframe>
        </div>
    @endif
    @if($item->note)
        <div class="col-md-12">
            <div class="newsNote">
                {{$item->note}}
            </div>
        </div>
    @endif
    <div class="newsDate pull-right">
        {{date("d-m-Y", strtotime($item->created_at))}}
    </div>
@endif

