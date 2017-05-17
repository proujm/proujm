@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Основной контейнер   --}}
            <div class="col-md-12">
                <h3>Редактирование новости</h3>
                <br><br>
                {{-- Ошибки --}}
                {!! Helpers::errorMsg($errors) !!}

                <form action="{{route('news.update', $item->id)}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    <input type="hidden" name="dbImg" class="dbImgInput"/>
                    {{csrf_field()}}

                    <table class="table table-sm">
                        <tr>
                            <td>Заголовок</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="title"
                                       placeholder="{{$item->title}}"
                                       title="Введите заголовок новости"
                                       value="{{$item->title}}"
                                       maxlength="255" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Видео</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="video"
                                       placeholder="ссылка на youtube видео"
                                       title="Введите ссылку на youtube видео"
                                       value="{{$item->video}}"
                                       maxlength="2500">
                            </td>
                        </tr>
                        <tr>
                            <td>Изображение</td>
                            <td>
                                @if(!$item->image)
                                    <div>Нет изображений</div>
                                @else
                                    {{--<a href="{{ asset('images/news/'.$item->image) }}" class="fullScreenImage" data-lightbox="example-set" data-title="">--}}
                                        {{--<img src="{{ asset('images/news/'.$item->image) }}" class="fullScreenImage caruselEditImg">--}}
                                    {{--</a>--}}
                                    <div class="{{'img'.$item->image}}">
                                        <i class="fa fa-times imageDelete" id="{{'img'.$item->image}}" aria-hidden="true"
                                           onclick="deleteImage(this.id)"
                                           onmouseover="deleteImageOver(this.id)"
                                           onmouseout="deleteImageOut(this.id)"></i>
                                        <br>
                                        <a href="{{ asset('images/news/'.$item->image) }}" class="fullScreenImage" data-lightbox="example-set" data-title="">
                                            <img src="{{ asset('images/news/'.$item->image) }}" class="fullScreenImage caruselEditImg dbImg">
                                        </a>
                                        <br><p>{{$item->image}}</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fileUpload blue-btn btn width100">
                                    <span style="color: #27a9e0">Новое изображение</span>
                                    <input type="file" class="uploadlogo" id="uploadfile" width="200px" name="img" accept='image/*' onchange="imageLoaded()">
                                </div>
                            </td>
                            <td title="Выбранные изображения">
                                <div class="bannerRecomend">Рекомендуемый размер изображения: 1024x768px</div>
                                <p id="demo"></p>
                                <img id="previewImg" />
                            </td>
                        </tr>
                        <tr>
                            <td>Контент</td>
                            <td>
                                <textarea name="note"
                                          class="form-control"
                                          placeholder="{{$item->note}}"
                                          title="Контект новости"
                                          cols="50" rows="15">{{$item->note}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="pull-right">
                                    <input type="submit" class="btn buttonHoverColor" title="Сохранить изменения" name="submitSave" value="Сохранить" onclick="getDbImages()"/>
                                    <a class="btn buttonHoverColor" title="Вернуться назад к товарам" href="{{route('news.index')}}">Отмена</a>
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
    <script src="{{ asset('js/adminNewsEdit.js') }}" type="text/javascript"></script>
@stop