<?php
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', route('index'));
});
Breadcrumbs::register('products', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Все товары', route('web.product.index'));
});
Breadcrumbs::register('product', function($breadcrumbs, $product)
{
    $breadcrumbs->parent('products');
    $breadcrumbs->push($product->title, route('web.product.show', $product->id));
});
Breadcrumbs::register('info', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Полезная информация', route('web.info.index'));
});
Breadcrumbs::register('contacts', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Обратная свзяь', route('web.contacts.index'));
});
Breadcrumbs::register('search', function($breadcrumbs)
{
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Поиск по товарам', route('web.search'));
});

