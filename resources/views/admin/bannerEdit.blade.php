@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Основной контейнер   --}}
            <div class="col-md-12">
                <h3>Редактирование баннера</h3>
                <br><br>
                {{-- Ошибки --}}
                {!! Helpers::errorMsg($errors) !!}

                <form action="{{route('banner.update', $banner->id)}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    {{csrf_field()}}

                    <table class="table table-sm">
                        <tr>
                            <td>Ссылка</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="bannerUrl"
                                       placeholder="{{$banner->redirect_url}}"
                                       title="Введите ссылку для переадресаци"
                                       value="{{$banner->redirect_url}}"
                                       maxlength="255">
                            </td>
                        </tr>
                        <tr>
                            <td>Заметки</td>
                            <td>
                                <textarea name="bannerNote"
                                          class="form-control"
                                          placeholder="{{$banner->note}}"
                                          title="Заметки о баннере"
                                          cols="50" rows="15">{{$banner->note}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Изображение</td>
                            <td>
                                @if(!$banner->img_name)
                                    <div>
                                        <br><img src="{{ asset('images/product/min/noImg.jpg') }}">
                                        <br><p>нет изображения</p>
                                        <hr>
                                    </div>
                                @else
                                    <a href="{{ asset('images/banners/'.$banner->img_name) }}" class="fullScreenImage" data-lightbox="example-set" data-title="">
                                        <img src="{{ asset('images/banners/'.$banner->img_name) }}" class="fullScreenImage">
                                    </a>
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
                                <div class="bannerRecomend">Рекомендуемый размер баннера: 400x150px</div>
                                <p id="demo"></p>
                                <img id="previewImg" />
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <div class="pull-right">
                                    <input type="submit" class="btn buttonHoverColor" title="Сохранить изменения" name="submitSave" value="Сохранить"/>
                                    <a class="btn buttonHoverColor" title="Вернуться назад к товарам" href="{{route('banner.index')}}">Отмена</a>
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