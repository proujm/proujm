@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Основной контейнер   --}}
            <div class="col-md-12">
                <h3>Добавление баннера в карусель</h3>
                <br><br>
                {{-- Ошибки --}}
                {!! Helpers::errorMsg($errors) !!}

                <form action="{{route('carusel.store')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    {{csrf_field()}}
                    <table class="table table-sm bannerCreateTable">
                        <tr>
                            <td>Ссылка</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="bannerUrl"
                                       placeholder="ссылка переадресации"
                                       title="Введите ссылку для переадресации"
                                       value="{{old('bannerUrl')}}"
                                       maxlength="255">
                            </td>
                        </tr>
                        <tr>
                            <td>Заметки</td>
                            <td>
                                <textarea name="bannerNote"
                                          class="form-control"
                                          placeholder="дополнительные заметки"
                                          title="Заметки о баннере"
                                          cols="50" rows="5">{{old('bannerNote')}}</textarea>
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
                                <div class="bannerRecomend">Рекомендуемый размер баннера: 1200x300px</div>
                                <p id="demo"></p>
                                <img id="previewImg" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="pull-right">
                                    <input type="submit" class="btn buttonHoverColor" title="Добавить товар" name="submitAdd" value="Добавить"/>
                                    <a class="btn buttonHoverColor" title="Вернуться назад к товарам" href="{{route('carusel.index')}}">Отмена</a>
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