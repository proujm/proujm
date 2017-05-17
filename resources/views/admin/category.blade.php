@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Меню   --}}
            <div class="col-md-3">
                {!! Helpers::adminMenu() !!}
            </div>
            {{--    Основной контейнер   --}}
            <div class="col-md-9 adminCategoryContainer">
                @if(count($categories) == 0)
                    <div class="nullCategories">
                        <div class="nullCategoriesTitle">
                            <h3>категории не созданы</h3>
                        </div>
                        <div class="nullCategoriesText">
                            <h5>добавьте новую категорию</h5>
                        </div>
                    </div>
                @else
                    <table class="table table-sm adminTables tableTextCenter">
                        <thead>
                        <tr class="borderbottom">
                            <th>Категория</th>
                            <th>Колличество продуктов</th>
                            <th class="edit"></th>
                            <th class="delete"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->title}}</td>
                                <td>{{count($category->products)}}</td>
                                <td>
                                    <a class="btn actionButtons" href="{{route('category.edit', $category->id)}}" title="Редактировать">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        <span class="sr-only">Редактировать</span>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('category.destroy', $category->id)}}" method="POST" id="delete_one">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {!! csrf_field() !!}
                                        <button class="btn actionButtons" title="Удалить">
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
                    <div class="col-md-10">
                        {!! $categories->links() !!}
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" form="store" name="newcategory" value="{{old('newcategory')}}" placeholder="Добавить категорию" title="Введите название категории" required maxlength="255">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn buttonHoverColor" form="store" title="Добавить категорию" onclick="Check()">Добавить</button>
                    </div>
                </div>

                {{-- Ошибки --}}
                <div class="row">
                    <div class="col-md-10">{!! Helpers::errorMsg($errors) !!}</div>
                    <div class="col-md-2"></div>
                </div>

                {{-- Форма добавления --}}
                <form action="{{route('category.store')}}" method="post" id="store">
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
@stop