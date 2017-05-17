@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Редактирование категории</h3>
                <br><br><br><br><br>
                <form action="{{route('category.update', $category->id)}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">

                    <table class="table table-sm tableTextCenter categoryEditTable">
                        <thead>
                        <tr>
                            <th class="updateCategoryInput">Категория</th>
                            <th class="save"></th>
                            <th class="cancel"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="newcategory"
                                       placeholder="{{$category->title}}" value="{{$category->title}}"
                                       title="Введите новое название категории" required minlength="1" maxlength="255">
                            </td>
                            <td>
                                <input type="submit" class="btn buttonHoverColor" title="Сохранить новое название категории" name="submitSave" value="Сохранить"/>
                            </td>
                            <td title="Вернуться назад к категориям">
                                <a class="btn buttonHoverColor" title="Вернуться назад к категориям" href="{{route('category.index')}}">Отмена</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>

            </div>
        </div>
    </div>
    {!! Helpers::errorMsg($errors) !!}
@stop
