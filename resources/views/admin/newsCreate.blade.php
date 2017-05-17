@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Основной контейнер   --}}
            <div class="col-md-12">
                <h3>Добавление новости</h3>
                <br><br>
                {{-- Ошибки --}}
                {!! Helpers::errorMsg($errors) !!}

                <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    {{csrf_field()}}
                    <table class="table table-sm">
                        <tr>
                            <td>Заголовок</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="title"
                                       placeholder="заголовок новости"
                                       title="Введите заголовок"
                                       value="{{old('title')}}"
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
                                       value="{{old('video')}}"
                                       maxlength="2500">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fileUpload blue-btn btn width100">
                                    <span style="color: #27a9e0">Загрузить изображение</span>
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
                                          placeholder="контект новости"
                                          title="Контект новости"
                                          cols="50" rows="20">{{old('note')}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="pull-right">
                                    <input type="submit" class="btn buttonHoverColor" title="Добавить товар" name="submitAdd" value="Добавить"/>
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
@stop