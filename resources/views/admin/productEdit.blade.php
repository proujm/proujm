@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{--    Основной контейнер   --}}
            <div class="col-md-12">
                <h3>Редактирование товара</h3>
                <br><br>
                {{-- Ошибки --}}
                {!! Helpers::errorMsg($errors) !!}

                <form action="{{route('product.update', $product->id)}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    {{csrf_field()}}
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    <input type="hidden" name="dbImg" class="dbImgInput"/>

                    <table class="table table-sm productCreateTable">
                        <tr>
                            <td>Название</td>
                            <td>
                                <input type="text"
                                       class="form-control"
                                       name="new_title_product"
                                       id="new_title_product"
                                       placeholder="{{$product->title}}"
                                       title="Введите название товара"
                                       value="{{$product->title}}"
                                       required minlength="1" maxlength="255">
                            </td>
                        </tr>
                        <tr>
                            <td>Категория</td>
                            <td title="Выберите категорию">
                                {!! Helpers::select($categories, $product->category_id, 'Выберите категорию', ['class'=>'form-control', 'name' => 'category_id', 'id' => 'category']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Описание</td>
                            <td>
                                <textarea name="new_description_product"
                                          class="form-control"
                                          placeholder="{{$product->description}}"
                                          title="Введите описание товара"
                                          cols="50" rows="20">{{$product->description}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Стоимость</td>
                            <td>
                                <input type="number"
                                       min="0"
                                       class="form-control"
                                       name="new_price_product"
                                       value="{{$product->price}}"
                                       placeholder="{{$product->price}}"
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
                                       value="{{$product->status}}"
                                       placeholder="{{$product->status}}"
                                       title="Введите статус товара" maxlength="255">
                            </td>
                        </tr>
                        <tr>
                            <td>Колличество просмотров</td>
                            <td>
                                <input type="number"
                                       min="0"
                                       class="form-control"
                                       name="new_viewcount_product"
                                       value="{{$product->view_count}}"
                                       placeholder="{{$product->view_count}}"
                                       value="0"
                                       title="Введите колличество просмторов товара">
                            </td>
                        </tr>
                        <tr>
                            <td>Загруженные изображения</td>
                            <td>
                                @if(count($product->images) == 0)
                                    <div>
                                        <br><img src="{{ asset('images/product/min/noImg.jpg') }}">
                                        <br><p>нет изображений</p>
                                        <hr>
                                    </div>
                                @else
                                    @foreach($product->images as $image)
                                        <div class="{{'img'.$image->id}}">
                                            <i class="fa fa-times imageDelete" id="{{'img'.$image->id}}" aria-hidden="true"
                                               onclick="deleteImage(this.id)"
                                               onmouseover="deleteImageOver(this.id)"
                                               onmouseout="deleteImageOut(this.id)"></i>
                                            <br><img src="{{ asset('images/product/normal/'.$image->name) }}" id="image" name="dbImg" class="image dbImg {{'imgid'.$image->id}}" onclick="imageClick({{$image->id}})">
                                            <br><p>{{$image->name}}</p>
                                            <hr>
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Основное изображение</td>
                            <td>
                                @if(count($product->images)>0)
                                    {!! Helpers::select($product->images,$mainImgId[0]->id, 'Выберите изображение', ['class'=>'form-control mainImage', 'name' => 'mainImage', 'id' => 'mainImage'], 0, 'name') !!}
                                    <input type="hidden" name="selectorDbImgs" id="selectorDbImgs" value="{{$mainImgId[0]->id}}">
                                @else
                                    {!! Helpers::select($product->images,null, 'Выберите изображение', ['class'=>'form-control mainImage', 'name' => 'mainImage', 'id' => 'mainImage'], 0, 'name') !!}
                                    <input type="hidden" name="selectorDbImgs" id="selectorDbImgs" value="">
                                @endif

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
                                    <input type="submit" class="btn buttonHoverColor" title="Сохранить изменения" name="submitSave" value="Сохранить" onclick="getDbImages()"/>
                                    <a class="btn buttonHoverColor" title="Вернуться назад к товарам" href="{{route('product.index')}}">Отмена</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/adminImageProductUpdate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/adminProductCreate.js') }}" type="text/javascript"></script>
@stop