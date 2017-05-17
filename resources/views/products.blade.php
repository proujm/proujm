@extends('layouts.app')
@section('content')
    {!! Helpers::userMenu() !!}
    <div class="container productsContainerUp">
        {!! Breadcrumbs::render('products') !!}
        <div class="row allProducts">
            <div class="col-md-12 blockImages">
                @foreach($products as $product)
                    {!! Helpers::imageForm(\App\Models\ProductImages::getMainImage($product), 4) !!}
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12 text-center newsLinks">
            {!! $products->links() !!}
        </div>
    </div>
    {!! Helpers::horisontalBanner($horisontalBanners) !!}
@stop