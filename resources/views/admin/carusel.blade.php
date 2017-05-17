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
                @if(count($banners) == 0)
                    <div class="nullHorisontalBanners">
                        <div class="nullHorisontalBannersTitle">
                            <h3>Баннеры в каруселе не созданы</h3>
                        </div>
                        <div class="nullHorisontalBannersText">
                            <h5>добавьте новый баннер в карусель</h5>
                        </div>
                    </div>
                @else
                    <table class="table table-sm adminBannerTable adminTables tableTextCenter">
                        <thead>
                        <tr class="borderbottom">
                            <th>Изображение</th>
                            <th>Ссылка</th>
                            <th>Заметки</th>
                            <th class="edit"></th>
                            <th class="delete"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <td>
                                    <a href="{{ asset('images/carusel/'.$banner->img_name) }}" class="fullScreenImage" data-lightbox="example-set" data-title="">
                                        <img src="{{ asset('images/carusel/'.$banner->img_name) }}" class="bannerImg fullScreenImage">
                                    </a>
                                </td>
                                <td>{{mb_strimwidth($banner->redirect_url,0,30,'...')}}</td>
                                <td class="bannerNote">{{mb_strimwidth($banner->note,0,160,'...')}}</td>
                                <td>
                                    <a class="btn actionButtons" href="{{route('carusel.edit', $banner->id)}}" title="Редактировать">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        <span class="sr-only">Редактировать</span>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route('carusel.destroy', $banner->id)}}" method="POST">
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
                        {!! $banners->links() !!}
                    </div>
                    <div class="col-md-10"></div>
                    <div class="col-md-2" align="right">
                        <a class="btn buttonHoverColor" href="{{route('carusel.create')}}" title="Добавить новый баннер">Добавить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('lightbox2/js/lightbox.js') }}" type="text/javascript"></script>
@stop