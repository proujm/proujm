$(window).load(function(){
    var href = window.location.href;
    if(href.includes('category')){
        $(".fieldCategory").addClass('active');
    }
    else if(href.includes('category')){
        $(".fieldCategory").addClass('active');
    }
    else if(href.includes('product')){
        $(".fieldProduct").addClass('active');
    }
    else if(href.includes('comment')){
        $(".fieldComment").addClass('active');
    }
    else if(href.includes('banner')){
        $(".fieldBanner").addClass('active');
    }
    else if(href.includes('carusel')){
        $(".fieldCarusel").addClass('active');
    }
    else if(href.includes('news')){
        $(".fieldNews").addClass('active');
    }
    else if(href.includes('admin')){
        $(".fieldAdmin").addClass('active');
    }
});