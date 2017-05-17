@extends('layouts.app')
@section('content')
    {!! Helpers::userMenu() !!}
    <div class="container productsContainerUp">
        {!! Breadcrumbs::render('search') !!}
        <div class="row">
            <div class="col-md-12 searchTitle text-center">
                <h1>Результаты поиска {{'"'.$searchStr.'"'}}</h1>
            </div>
            <div class="col-md-12 searchContainer">
                @if(count($products)>0)
                    <table class="table table-sm searchTable">
                        <thead>
                            <tr class="searchBorderBottom">
                                <th>Наименование</th>
                                <th>Описание</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{mb_strimwidth($product->title,0,30,'...')}}</td>
                                    <td>{{mb_strimwidth($product->description,0,80,'...')}}</td>
                                    <td>
                                        <a class="btn searchButton" href="{{route('web.product.show', $product->id)}}" title="перейти к товару">
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            <span class="sr-only">Редактировать</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>Сожалеем, но товар по вашему запросу не найден.</h4>
                @endif
            </div>
            <div class="col-md-12 searchLinks">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
    {!! Helpers::horisontalBanner($horisontalBanners) !!}
@stop