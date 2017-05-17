@extends('layouts.app')
@section('content')
    {!! Helpers::makeCarusel($caruselBanners) !!}
    {!! Helpers::userMenu() !!}
    <div class="row">
        <div class="container homeContainerUp">
            {!! Breadcrumbs::render('home') !!}
            <div class="row">
                <div class="col-md-9 col-sm-12 homeContainerDown">
                    <div class="col-md-12 col-sm-12 col-xs-12 blockImages">
                        @foreach($products as $product)
                            {!! Helpers::imageForm(\App\Models\ProductImages::getMainImage($product),3) !!}
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 pull-right commercialBannerUp">
                    <div class="commercialBanner">
                        <div class="vertBannerTitle">Реклама:</div>
                        <img class="pull-right vertBannerImage" src="{{ asset('images/banners/bv02.gif') }}" alt="">
                        <img class="pull-right vertBannerImage" src="{{ asset('images/banners/bv03.gif') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        @if($newsItem)
            <div class="container homeNewsTitle">
                Популярные новости
            </div>
            <div class="container homeContainerNewsUp">
                <div class="row">
                    {!! Helpers::newsItem($newsItem) !!}
                </div>
            </div>
        @endif
        {!! Helpers::horisontalBanner($horisontalBanners) !!}
    </div>
    <script src="{{ asset('lightbox2/js/lightbox.js') }}" type="text/javascript"></script>
@stop