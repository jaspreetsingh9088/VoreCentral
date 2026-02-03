function addLoader(e) {
    var button = $(e);
    $(e).data("btn", button.html());
    button.html(spiner).attr("disabled", "disabled");
}

function removeLoader(e) {
    var button = $(e);
    button.html($(e).data("btn")).attr("disabled", false);
}
