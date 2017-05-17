@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Меню   --}}
            <div class="col-md-3">
                {!! Helpers::adminMenu() !!}
            </div>
            {{--    Основной контейнер   --}}
            <div class="col-md-9">
                @if(count($products) == 0)
                    <div class="nullCategories">
                        <div class="nullCategoriesTitle">
                            <h3>продукты не созданы</h3>
                        </div>
                        <div class="nullCategoriesText">
                            <h5>добавьте новый продукт</h5>
                        </div>
                    </div>
                @else
                    <table class="table table-sm adminProductTable adminTables tableTextCenter">
                        <thead>
                        <tr class="borderbottom">
                            <th>Н<br>а<br>з<br>в<br>а<br>н<br>и<br>е</th>
                            <th>К<br>а<br>т<br>е<br>г<br>о<br>р<br>и<br>я</th>
                            <th>О<br>п<br>и<br>с<br>а<br>н<br>и<br>е</th>
                            <th>С<br>т<br>о<br>и<br>м<br>о<br>с<br>т<br>ь</th>
                            <th>С<br>т<br>а<br>т<br>у<br>с</th>
                            <th>П<br>р<br>о<br>с<br>м<br>о<br>т<br>р<br>о<br>в</th>
                            <th>И<br>з<br>о<br>б<br>р<br>а<br>ж<br>е<br>н<br>и<br>й</th>
                            <th>К<br>о<br>м<br>м<br>е<br>н<br>т<br>а<br>р<br>и<br>и</th>
                            <th class="edit"></th>
                            <th class="delete"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->title}}</td>
                                <td>{{$product->category->title}}</td>
                                <td>
                                    {{mb_strimwidth($product->description,0,50,'...')}}
                                </td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->status}}</td>
                                <td>{{$product->view_count}}</td>
                                <td>
                                    @if(\App\Models\Product::getCountStandartImages($product)>0)
                                        {{count($product->images)-1}}
                                    @else {{count($product->images)}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('comment.show', $product->id)}}">
                                        {{count($product->comments)}}
                                    </a>
                                </td>
                                <td>
                                    <a class="btn actionButtons" href="{{route('product.edit', $product->id)}}" title="Редактировать">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        <span class="sr-only">Редактировать</span>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route('product.destroy', $product->id)}}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {!! csrf_field() !!}
                                        <button class="btn actionButtons"  title="Удалить">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            <span class="sr-only">Удалить</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                {{--    Добавить   --}}
                <div class="row">
                    <div class="col-md-12">
                        {!! $products->links() !!}
                    </div>
                    <div class="col-md-10"></div>
                    <div class="col-md-2" align="right">
                        <a class="btn buttonHoverColor" href="{{route('product.create')}}" title="Добавить новый товар">Добавить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop