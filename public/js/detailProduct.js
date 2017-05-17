function detailProductLittleImg(img) {
    $("#mainImageDetail")[0].src = img.src;
    $("#mainImageDetailA")[0].href = img.src;
}
function scroll_to_elem(elem,speed) {
    if(document.getElementById(elem)) {
        var destination = jQuery('#'+elem).offset().top;
        jQuery("html,body").animate({scrollTop: destination}, speed);
    }
}
$(document).ready(function() {
    errors = $(".errorMsgColor");
    if(errors.length>0){
        scroll_to_elem('commentError', 0);
    }
    url = window.location.href;
    if(url.includes('page')){
        scroll_to_elem('mainComments', 0);
    }
});
