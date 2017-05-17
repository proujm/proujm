@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Меню   --}}
            <div class="col-md-3">
                {!! Helpers::adminMenu() !!}
            </div>
            {{--    Основной контейнер   --}}
            <div class="col-md-9 adminCommentsContainer">
                <div class="text-center adminCommentTitle">
                    @if($product != 'all')
                        {{'Продукт: '.mb_strimwidth($product,0,30,'...')}}
                    @else
                        Все комментарии.
                    @endif
                </div>
                @if(count($comments) == 0)
                    <div class="nullComments">
                        <div class="nullCommentsTitle">
                            <h3>комментарии не созданы</h3>
                        </div>
                        <div class="nullnullCommentsText">
                            <h5>добавьте новый комментарий</h5>
                        </div>
                    </div>
                @else
                    <table class="table table-sm adminCommentTable adminTables tableTextCenter">
                        <thead>
                        <tr class="borderbottom">
                            <th>Имя</th>
                            <th>Продукт</th>
                            <th>Комментарий</th>
                            <th class="edit"></th>
                            <th class="delete"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{mb_strimwidth($comment->name,0,30,'...')}}</td>
                                <td>
                                    <a href="{{route('comment.show', $comment->product->id)}}">
                                        {{mb_strimwidth($comment->product->title,0,30,'...')}}
                                    </a>
                                </td>
                                <td>{{mb_strimwidth($comment->text,0,70,'...')}}</td>
                                <td>
                                    <a class="btn actionButtons" href="{{route('comment.edit', $comment->id)}}" title="Редактировать">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        <span class="sr-only">Редактировать</span>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route('comment.destroy', $comment->id)}}" method="POST">
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
                <div class="row">
                    <div class="col-md-12">
                        {!! $comments->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop