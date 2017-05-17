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
                @if(count($news) == 0)
                    <div class="nullHorisontalBanners">
                        <div class="nullHorisontalBannersTitle">
                            <h3>Нет новостей</h3>
                        </div>
                        <div class="nullHorisontalBannersText">
                            <h5>добавьте новость</h5>
                        </div>
                    </div>
                @else
                    <table class="table table-sm adminNewsTable adminTables tableTextCenter">
                        <thead>
                        <tr class="borderbottom">
                            <th>Заголовок</th>
                            <th>Изображение</th>
                            <th>Видео</th>
                            <th>Контент</th>
                            <th class="edit"></th>
                            <th class="delete"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $item)
                            <tr>
                                <td>{{mb_strimwidth($item->title,0,30,'...')}}</td>
                                <td>
                                    @if($item->image)
                                        <a href="{{ asset('images/news/'.$item->image) }}" class="fullScreenImage" data-lightbox="example-set" data-title="">
                                            <img src="{{ asset('images/news/'.$item->image) }}" class="bannerImg fullScreenImage">
                                        </a>
                                    @endif
                                </td>
                                <td class="video">{{mb_strimwidth($item->video,0,160,'...')}}</td>
                                <td class="note">{{mb_strimwidth($item->note,0,160,'...')}}</td>
                                <td>
                                    <a class="btn actionButtons" href="{{route('news.edit', $item->id)}}" title="Редактировать">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        <span class="sr-only">Редактировать</span>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route('news.destroy', $item->id)}}" method="POST">
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
                        {!! $news->links() !!}
                    </div>
                    <div class="col-md-10"></div>
                    <div class="col-md-2" align="right">
                        <a class="btn buttonHoverColor" href="{{route('news.create')}}" title="Добавить новость">Добавить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('lightbox2/js/lightbox.js') }}" type="text/javascript"></script>
@stop