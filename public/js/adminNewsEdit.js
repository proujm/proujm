function deleteImageOver(idImage) {
    elements = document.getElementsByClassName(idImage);
    elements[0].classList.add('deleteImageHover');
}
function deleteImageOut(idImage) {
    elements = document.getElementsByClassName(idImage);
    elements[0].classList.remove('deleteImageHover');
}
function deleteImage(idImage){
    elements = document.getElementsByClassName(idImage);
    elements[0].outerHTML = "";
    delete elements[0];
}
function getDbImages() {
    document.getElementsByClassName('dbImgInput')[0].value = getDbImagesStr();
}
function getDbImagesStr() {
    dbImages = document.getElementsByClassName('dbImg');
    dbImagesStr = '';
    for (var i = 0; i < dbImages.length; i += 1) {
        src = dbImages[i].src;
        start = src.indexOf('news') + 5;
        result = src.substring(start);
        dbImagesStr += result;
    }
    return dbImagesStr;
}