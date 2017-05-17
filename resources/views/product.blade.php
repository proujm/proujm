@extends('layouts.app')
@section('content')
    {!! Helpers::userMenu() !!}
    <div class="container productUpContainer">
        {!! Breadcrumbs::render('product', $product) !!}
        <div class="row detailProduct">
            <div class="col-md-12 detailContainer">
                <div class="col-md-4">
                    <div class="row detailImages">
                        <div class="col-md-2">
                            @foreach($product->images as $image)
                                <a href="{{ asset('images/product/normal/'.$image->name) }}" class="fullScreenProductImage" data-lightbox="example-set" data-title="">
                                    <img class="littleImg fullScreenProductImage"
                                         src="{{ asset('images/product/normal/'.$image->name) }}"
                                         onmouseover="detailProductLittleImg(this)"
                                    />
                                </a>
                            @endforeach
                        </div>
                        <div class="col-md-10">
                            <a href="{{ asset('images/product/normal/'.$mainImage->name) }}" class="fullScreenProductImage2" id="mainImageDetailA" data-lightbox="example-set" data-title="">
                                <img src="{{ asset('images/product/min/'.$mainImage->name) }}" class="mainImageDetail" id="mainImageDetail" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 textDetailProduct">
                    <div class="text-center detailProductTitle col-sm-12 col-md-12 col-xs-12 col-lg-12"><h1>{{$product->title}}</h1></div>
                    <div class="detailProductPrice col-sm-12 col-md-12 col-xs-12 col-lg-12">
                        <div class="pull-right">
                            {{$product->price.' тг.'}}
                        </div>
                    </div>
                    <div class="detailProductTitle2 col-sm-12 col-md-12 col-xs-12 col-lg-12">
                        <hr>Описание:
                    </div>
                    <div class="detailProductDescription col-sm-12 col-md-12 col-xs-12 col-lg-12">
                        {{$product->description}}
                        <hr>
                    </div>
                    <div class="productBuy col-sm-12 col-md-12 col-xs-12 col-lg-12">
                        <div class="pull-right">
                            <input type="button" class="buttonOrder" title="Хочу купить этот товар" name="submitAdd" value="Купить"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 productComments">
                <div class="commentsTitle text-center" id="mainComments"><h1 class="productCommentTitle">Отзывы покупателей</h1></div>
                <div class="comments">
                    @if(count($comments) == 0)
                        <div class="noCommentsText">Отзывов пока нет. Оставьте свой отзыв о данном товаре.</div>
                    @else
                        <div class="commentContainer">
                            @foreach($comments as $comment)
                                <div class="commentName">{{$comment->name}}</div>
                                <div class="commentText">{{$comment->text}}</div>
                                <div class="pull-right commentDate">{{date("d-m-Y", strtotime($comment->created_at))}}</div>
                                <hr class="commentDivider">
                            @endforeach
                                {!! $comments->links() !!}
                        </div>
                    @endif

                    <form action="{{route('web.comment.store', $product->id)}}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="commentContainer">
                            @if (Auth::guest())
                                <div class="">
                                    <input class="form-control"
                                           type="email"
                                           name="commentName"
                                           value="{{old('commentName')}}"
                                           placeholder="Ваш email"
                                           title="Введите ваш email"
                                           maxlength="255"
                                           required>
                                </div>
                            @else
                                <input name="commentName"
                                       value="{{ Auth::user()->name }}"
                                       type="hidden"
                                >
                            @endif
                            <div class="newCommentDiv">
                            <textarea class="form-control"
                                      name="newComment"
                                      id="newComment"
                                      placeholder="Ваш отзыв о данном товаре"
                                      title="Введите ваш отзыв"
                                      cols="50" rows="5" maxlength="25000">{{old('newComment')}}</textarea>
                            </div>
                            <div class="pull-right commentSubmitDiv">
                                <input type="submit" class="btn buttonHoverColor" title="Оставить отзыв" name="submitAdd" value="Оставить отзыв"/>
                            </div>
                            <div class="commentError" id="commentError">
                                {!! Helpers::errorMsg($errors) !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {!! Helpers::horisontalBanner($horisontalBanners) !!}
    <script src="{{ asset('js/detailProduct.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lightbox2/js/lightbox.js') }}" type="text/javascript"></script>
@stop