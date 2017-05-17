function imageLoaded(){
    var x = document.getElementById("uploadfile");
    var txt = "";
    if ('files' in x) {
        updateSelector();
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
    updateSelectorAdd(imgName, imgName);
    return txt;
}
function deleteImage(idImage){
    elements = document.getElementsByClassName(idImage);
    elements[0].outerHTML = "";
    delete elements[0];
    updateSelectorDel(idImage);
}

function updateSelectorDel(idImage) {
    idMainImage = idImage.substring(3);
    //console.log(idMainImage);
    $('.mainImage option').each(function() {
        if ( $(this).val() == idMainImage) {
            $(this).remove();
        }
    });
}
function updateSelectorAdd(value, text) {
    //console.log('value = ' + value + ', text = ' + text);
    $("#mainImage").append(new Option(text, value));
}
function updateSelector() {
    $("#mainImage option").remove();//очищаем селектор
    updateSelectorAdd('', 'Выберите изображение');
    //закидываем в селектор фотки которые уже в бд
    dbImages = $(".dbImg");
    for (var i = 0; i < dbImages.length; i += 1) {
        src = dbImages[i].src;
        start = src.indexOf('normal') + 7;
        text = src.substring(start);

        strClasses = dbImages[i].className;
        startIndex = strClasses.indexOf('imgid') + 5;
        dbImgId = strClasses.substring(startIndex);

        updateSelectorAdd(dbImgId, text);
    }
    $("#mainImage").attr('selected','selected');
    selectedId = $("#selectorDbImgs")[0].value;
    $('#mainImage option[value="' +  selectedId + '"]').prop('selected', true);
    selected = $("#mainImage")[0].selectedOptions[0].value;
    if(!selected){
        $("#selectorDbImgs")[0].value = '';
    }
}

function deleteImageOver(idImage) {
    elements = document.getElementsByClassName(idImage);
    elements[0].classList.add('deleteImageHover');
}
function deleteImageOut(idImage) {
    elements = document.getElementsByClassName(idImage);
    elements[0].classList.remove('deleteImageHover');
}
$(document).ready(function() { // Ждём загрузки страницы
    $(".image").click(function(){	// Событие клика на маленькое изображение
        var img = $(this);	// Получаем изображение, на которое кликнули
        var src = img.attr('src'); // Достаем из этого изображения путь до картинки
        $("body").append("<div class='popup'>"+ //Добавляем в тело документа разметку всплывающего окна
            "<div class='popup_bg'></div>"+ // Блок, который будет служить фоном затемненным
            "<img src='"+src+"' class='popup_img' />"+ // Само увеличенное фото
            "</div>");
        $(".popup").fadeIn(800); // Медленно выводим изображение
        $(".popup_bg").click(function(){	// Событие клика на затемненный фон
            $(".popup").fadeOut(800);	// Медленно убираем всплывающее окно
            setTimeout(function() {	// Выставляем таймер
                $(".popup").remove(); // Удаляем разметку всплывающего окна
            }, 800);
        });
    });
    $('#mainImage').on('change', function () {
        var selectedValue = this.selectedOptions[0].value;
        //var selectedText  = this.selectedOptions[0].text;
        $("#selectorDbImgs")[0].value = selectedValue;
    });
});
function getDbImages() {
    document.getElementsByClassName('dbImgInput')[0].value = getDbImagesStr();
}
function getDbImagesStr() {
    dbImages = document.getElementsByClassName('dbImg');
    dbImagesStr = '';
    for (var i = 0; i < dbImages.length; i += 1) {
        src = dbImages[i].src;
        start = src.indexOf('normal') + 7;
        result = src.substring(start);
        dbImagesStr += result + ',';
    }
    return dbImagesStr;
}