@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Основной контейнер   --}}
            <div class="col-md-12">
                <h3>Редактирование комментария</h3>
                <br><br>
                {{-- Ошибки --}}
                {!! Helpers::errorMsg($errors) !!}

                <form action="{{route('comment.update', $comment->id)}}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{csrf_field()}}

                    <table class="table table-sm">
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="email"
                                       placeholder="{{$comment->name}}"
                                       title="Введите email"
                                       value="{{$comment->name}}"
                                       maxlength="255">
                            </td>
                        </tr>
                        <tr>
                            <td>Продукт</td>
                            <td title="Выберите продукт">
                                {!! Helpers::select($products, $comment->product_id, 'Выберите продукт', ['class'=>'form-control', 'name' => 'commentProduct'], 0, 'title') !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Комментарий</td>
                            <td>
                                <textarea name="commentTextEdit"
                                          class="form-control"
                                          placeholder="{{$comment->text}}"
                                          title="Заметки о баннере"
                                          cols="50" rows="15">{{$comment->text}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="pull-right">
                                    <input type="submit" class="btn buttonHoverColor" title="Сохранить изменения" name="submitSave" value="Сохранить"/>
                                    <a class="btn buttonHoverColor" title="Вернуться назад к товарам" href="{{route('comment.index')}}">Отмена</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/adminBannerCreate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lightbox2/js/lightbox.js') }}" type="text/javascript"></script>
@stop