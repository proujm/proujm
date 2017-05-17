@extends('layouts.app')
@section('content')
    {!! Helpers::userMenu() !!}
    <div class="container infoUpContainer">
        {!! Breadcrumbs::render('info') !!}
        <div class="row infoContainer">
            <div class="col-md-12 infodiv">
                @foreach($news as $item)
                    {!! Helpers::newsItem($item) !!}
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12 text-center newsLinks">
            {!! $news->links() !!}
        </div>
    </div>
    {!! Helpers::horisontalBanner($horisontalBanners) !!}
    <script src="{{ asset('lightbox2/js/lightbox.js') }}" type="text/javascript"></script>
@stop