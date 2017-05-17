function imageLoaded(){
    var x = document.getElementById("uploadfile");
    var txt = "";
    if ('files' in x) {
        if (x.files.length == 0) {
            txt = "Выберите одно или несколько изображений.";
        } else {
            for (var i = 0; i < x.files.length; i++) {
                txt = takeImage(x.files[i], txt, i+1);
            }
        }
        document.getElementById("demo").innerHTML = txt;
        return;
    }
    if (x.value == "") {
        txt += "Выберите одно или несколько изображений.";
    } else {
        txt += "The files property is not supported by your browser!";
        txt  += "<br>The path of the selected file: " + x.value;
    }
    document.getElementById("demo").innerHTML = txt;
}
function takeImage(image, txt, num) {
    imgName = '';
    txt += "<br><strong>" + num + ". Изображение</strong><br>";
    if ('name' in image) {
        txt += "Имя: ";
        if(image.name.length > 20) {
            imgName = image.name.substr(0,13) + " ... " + image.name.substr(image.name.length-7, image.name.length);
            txt +=  imgName+ "<br>";
        }
        else {
            imgName = image.name;
            txt += "Имя: " + imgName + "<br>";
        }
    }
    if ('size' in image) {
        txt += "Размер: " + image.size + " bytes <br>";
    }
    return txt;
}