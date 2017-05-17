<div class="row userMenuUpContainer">
    <div class="container userMenuSubContainer">
        <nav>
            <ul class="mcd-usermenu" id="containerUserMenu">
                <li>
                    <a href="{{route('index')}}" class="fieldHome">
                        <i class="fa fa-home"></i>
                        <strong>Домой</strong>
                        <small>на главную страницу</small>
                    </a>
                </li>
                <li>
                    <a href="{{route('web.product.index')}}" class="fieldProduct">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <strong>Продукты</strong>
                        <small>раздел с товарами</small>
                    </a>
                </li>
                <li>
                    <a href="{{route('web.info.index')}}" class="fieldInfo">
                        <i class="fa fa-globe"></i>
                        <strong>Новости</strong>
                        <small>полезная информация</small>
                    </a>
                </li>
                <li>
                    <a href="{{route('web.contacts.index')}}" class="fieldContacts">
                        <i class="fa fa-envelope-o"></i>
                        <strong>Написать нам</strong>
                        <small>обратная связь</small>
                    </a>
                </li>
                <li class="float">
                    <form action="{{ route('web.search')}}" method="POST"  id="search">
                        {!! csrf_field() !!}
                        <a class="search">
                            <input type="text" name="searchInput" value="{{old('searchInput')}}" placeholder="поиск..."  id="autocomplete-ajax">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>
<script src="{{ asset('js/userMenu.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/jquery.autocomplete.js') }}"></script>