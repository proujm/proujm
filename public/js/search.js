$(function () {
    $('#autocomplete-ajax').autocomplete({
        serviceUrl: "/autocomplete?query=",
        dataType: 'json',
        contentType: "application/json",
        type: 'GET'
    });
});