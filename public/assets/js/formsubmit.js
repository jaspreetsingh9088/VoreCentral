function addLoader(e) {

    var button = $(e);

    $(e).data("btn", button.html());

    button.html(spiner).attr("disabled", "disabled");

}



function removeLoader(e) {

    var button = $(e);

    button.html($(e).data("btn")).attr("disabled", false);

}







function printErrorMsg(msg) {

    $(".print-error-msg").find("ul").html("");

    $(".print-error-msg").css("display", "block");

    $(".print-success-msg").css("display", "none");

    $.each(msg, function (key, value) {

        $(".print-error-msg")

            .find("ul")

            .append("<li>" + value + "</li>");

    });

}



let spiner = `<div class="spinner-border text-light size-px-24" role="status"><span class="sr-only">Loading...</span></div>`;



let ignoreSubmit = false;

$("button.ignore-submit").on("click", function () {
    ignoreSubmit = true;
});

$("form").on("submit", function (event) {
    if (ignoreSubmit) {
        ignoreSubmit = false; 
        return true; 
    }

    event.preventDefault();

    $(".validation-errors").remove();

    $("form").find(":input,:radio,:checkbox,select").removeClass("in-valid");

    var form = $(this);

    data = new FormData(this);

    var redirecturl = $(this).attr("redirect");

    var submitBtn = $(this).find("button:submit");

    var table = $(this).attr("table");

    var modal = $(this).attr("modal");

    addLoader(submitBtn);

    $.ajax({

        url: $(this).attr("action"),

        type: $(this).attr("method"),

        data: data,

        cache: false,

        processData: false,

        contentType: false,

        success: function (response) {

            if (redirecturl) {

                // $(document).Toasts("create", {

                //     title: response.message,

                // });

                window.location.replace(redirecturl);

                // } else {

                //     $(document).Toasts("create", {

                //         title: response.message,

                //     });

                //     if ($("#commonModal").is(":visible")) {

                //         $("#commonModal").toggle("fast");

                //     }

            }

            if (response.code==200) {

            

                if (submitBtn) {

                removeLoader(submitBtn);

                showSnackbar(response.message);

                }

                

            } 

          

        },

        error: function (response) {

            if (submitBtn) {

                removeLoader(submitBtn);

            }

            if (response.status === 422) {

                if (

                    Object.keys(response.responseJSON).length > 0 &&

                    Object.keys(response.responseJSON.errors).length > 0

                ) {

                    show_validation_error(response.responseJSON.errors);



                    printErrorMsg(response.responseJSON.errors);

                }

            } else {

                $(document).Toasts("create", {

                    title: response.responseJSON.message,

                });

            }

        },

    });

});



function show_validation_error(msg) {

    if ($.isPlainObject(msg)) {

        $data = msg;

    } else {

        $data = $.parseJSON(msg);

    }



    $.each($data, function (index, value) {

        if ($('form [name="' + index + '[]"]').length > 0) {

            if ($('form [name="' + index + '[]"]').hasClass("select2")) {

                $('form [name="' + index + '[]"]')

                    .next()

                    .after(

                        '<span class="text-danger validation-errors">' +

                            value +

                            "</span>"

                    );

            } else {

                $('form [name="' + index + '[]"]').after(

                    '<span class="text-danger validation-errors">' +

                        value +

                        "</span>"

                );

            }

        } else {

            $('form [name="' + index + '"]').addClass("in-valid");

            $('form [name="' + index + '"]').after(

                '<span class="text-danger validation-errors">' +

                    value +

                    "</span>"

            );

        }

    });

}





function showSnackbar(msg) {

  var x = document.getElementById("snackbar");

  x.innerHTML = msg ;

  x.className = "show";

  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

}

