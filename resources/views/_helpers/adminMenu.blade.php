<div class="container containerAdminMenu">
    <nav>
        <ul class="mcd-adminmenu">
            <li>
                <a href="/" class="fieldHome">
                    <i class="fa fa-home"></i>
                    <strong>Домой</strong>
                    <small>на главную страницу</small>
                </a>
            </li>
            {{--<li>--}}
                {{--<a href="{{route('admin.index')}}" class="fieldAdmin">--}}
                    {{--<i class="fa fa-user-secret" aria-hidden="true"></i>--}}
                    {{--<strong>Админка</strong>--}}
                    {{--<small>статистика</small>--}}
                {{--</a>--}}
            {{--</li>--}}
            <li>
                <a href="{{route('category.index')}}" class="fieldCategory">
                    <i class="fa fa-folder-o" aria-hidden="true"></i>
                    <strong>Категории</strong>
                    <small>добавить/удалить</small>
                </a>
            </li>
            <li>
                <a href="{{route('product.index')}}" class="fieldProduct">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <strong>Продукты</strong>
                    <small>работа с товарами</small>
                </a>
            </li>
            <li>
                <a href="{{route('comment.index')}}" class="fieldComment">
                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                    <strong>Комментарии</strong>
                    <small>о товарах</small>
                </a>
            </li>
            <li>
                <a href="{{route('banner.index')}}" class="fieldBanner">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <strong>Баннеры</strong>
                    <small>реклама на сайте</small>
                </a>
            </li>
            <li>
                <a href="{{route('carusel.index')}}" class="fieldCarusel">
                    <i class="fa fa-map-o" aria-hidden="true"></i>
                    <strong>Карусель</strong>
                    <small>редактировать фото</small>
                </a>
            </li>
            <li>
                <a href="{{route('news.index')}}" class="fieldNews">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    <strong>Новости</strong>
                    <small>новости сайта</small>
                </a>
            </li>
        </ul>
    </nav>
</div>

<script src="{{ asset('js/adminMenu.js') }}" type="text/javascript"></script>