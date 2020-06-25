console.log = function () { };

function getPhoto(code = "random") {
    $("#screenshot").attr("src", "loading.gif");
    $(".vr-js-like").addClass("invisible");
    $("#like").addClass("disabled");
    $("#newimg").addClass("disabled");

    if (code == "random") {
        choices = "abcdefghijklmnopqrstuvwxyz123456789".split("");
        var code = "";

        for (i = 0; i < 6; i++) {
            code += choices[Math.floor(Math.random() * choices.length)];
        }
    }

    $.ajax({
        url: "backend.php?img=" + code,
        method: "GET",
        success: function (data) {
            if (data == "error") {
                return getPhoto();
            }
            $("#code").html(code);

            $("#like").attr("data-code", code);
            $("#likes").html(data);

            $(".vr-js-like").removeClass("invisible");
            $("#like").removeClass("disabled");
            $("#newimg").removeClass("disabled");

            $("#screenshot").attr("src", "backend.php?img=" + code + "&view=true");
        }
    })
}

$(document).ready(function () {
    //View img modal
    $(".vr-js-viewlarge").on("click", function () {
        $("#imagepreview").attr('src', $(this).attr("src"));
        $("#gotoimg").attr("href", $(this).attr("src"));
        $("#imagemodal").modal("show");
    });

    //Like
    $("#like").on("click", function () {
        $.ajax({
            url: "backend.php",
            method: "post",
            data: {
                "like": $(this).attr("data-code")
            }
        });
        likes = parseInt($("#likes").html());
        $("#likes").html(likes + 1);
    })

    //On click new img
    $("#newimg").on("click", function() {
        getPhoto();
    });

    //On click goto img
    $(".gotoImg").on("click", function() {
        code = $(this).attr("data-code");
        getPhoto(code);
    })

    getPhoto();
});