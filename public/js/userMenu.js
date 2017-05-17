$(window).load(function(){
    var href = $(location).attr('href');
    var indexProduct = href.indexOf('product');

    // if(indexProduct != -1 && href.substr(indexProduct+7) == ''){
    if(href.includes('product')){
        $(".fieldProduct").addClass('active');
    }
    else if(href.includes('info')){
        $(".fieldInfo").addClass('active');
    }
    else if(href.includes('contacts')){
        $(".fieldContacts").addClass('active');
    }
    else if(href.includes('search')){
        return;
    }
    else if(indexProduct == -1){
        $(".fieldHome").addClass('active');
    }
});
