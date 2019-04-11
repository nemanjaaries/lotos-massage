$(document).ready(function () {

    var btnKom = $("#btn-com");
    var formKom = $("#form-komentar");

    btnKom.on("click", function () {
        $.ajax({
            url: "http://localhost/massage/service/xhrSessionExist",
            type: "get",
            success: function (response) {
                if (response == "postoji") {
                    if (formKom.css("display") === "none") {
                        formKom.slideDown();
                    } else {
                        formKom.slideUp();
                    }
                } else {
                    var conf = confirm("Morate se ulogovati");
                    if (conf === true) {
                        window.location.replace("http://localhost/massage/login");
                    }
                }
            }
        });



        return false;
    });

   


});
