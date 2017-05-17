@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Основной контейнер   --}}
            <div class="col-md-12">
                <h3>Добавление товара</h3>
                <br><br>
                {{-- Ошибки --}}
                {!! Helpers::errorMsg($errors) !!}

                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    <table class="table table-sm productCreateTable">
                        <tr>
                            <td>Название</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="new_title_product"
                                       id="new_title_product"
                                       placeholder="название"
                                       title="Введите название товара"
                                       value="{{old('new_title_product')}}"
                                       required minlength="1" maxlength="255">
                            </td>
                        </tr>
                        <tr>
                            <td>Категория</td>
                            <td title="Выберите категорию">
                                {!! Helpers::select($categories, old('category_id'), 'Выберите категорию', ['class'=>'form-control', 'name' => 'category_id', 'id' => 'category']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Описание</td>
                            <td>
                                <textarea name="new_description_product"
                                          class="form-control"
                                          placeholder="описание"
                                          title="Введите описание товара"
                                          cols="50" rows="20">{{old('new_description_product')}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Стоимость</td>
                            <td>
                                <input type="number"
                                       min="0"
                                       class="form-control"
                                       name="new_price_product"
                                       value="{{old('new_price_product')}}"
                                       placeholder="цена"
                                       value="0"
                                       title="Введите стоимость товара">
                            </td>
                        </tr>
                        <tr>
                            <td>Статус</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="new_status_product"
                                       value="{{old('new_status_product')}}"
                                       placeholder="статус (новинка)"
                                       title="Введите статус товара">
                            </td>
                        </tr>
                        <tr>
                            <td>Колличество просмотров</td>
                            <td>
                                <input type="number"
                                       min="0"
                                       class="form-control"
                                       name="new_viewcount_product"
                                       value="{{old('new_viewcount_product')}}"
                                       placeholder="колличество просмторов"
                                       value="0"
                                       title="Введите колличество просмторов товара">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fileUpload blue-btn btn width100">
                                    <span style="color: #27a9e0">Загрузить изображение</span>
                                    <input type="file" class="uploadlogo" id="uploadfile" width="200px" multiple="true" name="img[]" accept='image/*' onchange="imageLoaded()">
                                </div>
                            </td>
                            <td title="Выбранные изображения">
                                <p id="demo"></p>
                                <img id="previewImg" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="pull-right">
                                    <input type="submit" class="btn buttonHoverColor" title="Добавить товар" name="submitAdd" value="Добавить"/>
                                    <a class="btn buttonHoverColor" title="Вернуться назад к товарам" href="{{route('product.index')}}">Отмена</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/adminImageProductCreate.js') }}" type="text/javascript"></script>
@stop