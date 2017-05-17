@extends('layouts.app')
@section('content')
    {!! Helpers::userMenu() !!}
    <div class="container contactsUpContainer">
        {!! Breadcrumbs::render('contacts') !!}
        <div class="row contactsContainer">
            <div class="newsTitle text-center col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <h1>Обратная связь</h1>
            </div>
            <div class="contactsText">
                <p>
                    -У вас возникли вопросы?<br>
                    -Вы хотите разместить рекламу на нашем ресурсе?<br>
                    -У вас есть коммерческое предложение?<br><br>

                    В любое время вы можете позвонить нам по телефонам: <b>+7(707)2510220, +7(701)2366000</b>.<br>
                    Или просто напишите нам, заполнив форму ниже, и наш оператор свяжется с вами в самые короткие сроки.<br>
                    <b> С уважением администрация ресурса.</b>
                </p>
            </div>
            <hr>
            <div class="msgForm">
                Форма обратной связи:
            </div>
            <form action="{{route('web.contacts.store')}}" method="post">
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}
                <div class="messageContainer col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    @if (Auth::guest())
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <input class="form-control"
                                   type="text"
                                   name="name"
                                   value="{{old('name')}}"
                                   placeholder="имя"
                                   title="Введите ваше имя"
                                   maxlength="255"
                                   required>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <input class="form-control"
                                   type="email"
                                   name="email"
                                   value="{{old('email')}}"
                                   placeholder="email"
                                   title="Введите ваш email"
                                   maxlength="255"
                                   required>
                        </div>
                    @else
                        <input name="name"
                               value="{{ Auth::user()->name }}"
                               type="hidden">
                        <input name="email"
                               value="{{ Auth::user()->email }}"
                               type="hidden">
                    @endif
{{---------------------------------------------}}
                    @if(!Auth::guest() && Auth::user()->phone)
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <input class="form-control"
                                   id="phone"
                                   type="text"
                                   name="phone"
                                   value="{{Auth::user()->phone}}"
                                   placeholder="телефон +7(999) 999-9999"
                                   title="Введите ваш телефон"
                                   maxlength="255"
                                   required>
                        </div>
                    @else
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <input class="form-control"
                                   id="phone"
                                   type="text"
                                   name="phone"
                                   value="{{old('commentPhone')}}"
                                   placeholder="телефон +7(999) 999-9999"
                                   title="Введите ваш телефон"
                                   maxlength="255"
                                   required>
                        </div>
                    @endif
{{---------------------------------------------}}
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <textarea class="form-control"
                                  name="newMessage"
                                  id="newMessage"
                                  placeholder="сообщение"
                                  title="Введите ваше сообщение"
                                  cols="50" rows="5" maxlength="25000">{{old('newMessage')}}</textarea>
                    </div>
                    <div class="pull-right commentSubmitDiv">
                        <input type="submit" class="btn buttonHoverColor" title="Отправить сообщение" name="submitAdd" value="Отправить"/>
                    </div>
                    <div class="commentError" id="commentError">
                        {!! Helpers::errorMsg($errors) !!}
                    </div>
                </div>
            </form>
        </div>
    </div>
    {!! Helpers::horisontalBanner($horisontalBanners) !!}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>--}}
    <script src="{{ asset('js/jquery.mask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/contacts.js') }}" type="text/javascript"></script>
@stop