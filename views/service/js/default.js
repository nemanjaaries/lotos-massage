$(document).ready(function () {

//SERVICE STRANCIA

    var dateInput =     $('.date'),
        resButton =     $('#service .button'),
        hide =          $('.hide'),
        cover =         $('#cover'),
        exitButton =    $('.exit'),
        item =          $('.item'),
        antiCelSec =    $('#anticelulit'),
        relaxSec =      $('#relax'),
        detoxSec =      $('#detox');     

    dateInput.dateDropper();
    

// izlazi pop-up
    resButton.on('click', function () {
        hide.removeClass("res-pop-up");
        $(this).next().addClass("res-pop-up");
        $.ajax({
            url: url+"/xhrSessionExist",
            type: "get",
            success: function (response) {
                if (response === "postoji") {
                    $(".res-pop-up").fadeIn('slow');
                    cover.fadeIn('slow');
                    disableScrolling();
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


// sakriva se pop-up
    exitButton.on('click', function () {
        $(".res-pop-up").fadeOut('slow');
        cover.fadeOut('slow');
        enableScrolling();
    });
    cover.on('click', function () {
        $('.res-pop-up').fadeOut('slow');
        $(this).fadeOut('slow');
        enableScrolling();
    });


    function disableScrolling() {
        var x = window.scrollX;
        var y = window.scrollY;
        window.onscroll = function () {
            window.scrollTo(x, y);
        };
    }
    function enableScrolling() {
        window.onscroll = function () {};
    }


// na promenu datuma nude se nerezervisani termini
    dateInput.change(function () {
        var that = $(this),
                name = that.attr("name"),
                value = that.val();
        var data = {};
        data[name] = value;

        $.ajax({
            url: url+"/xhrTerm",
            type: "post",
            data: data,
            success: function (response) {
                response = JSON.parse(response);
                $("select").html("");
                for (var i = 0; i < response.length; i++) {
                    $("select").append("<option value='" + response[i].id + "'>" + response[i].time + "</option>");
                }

            }
        });

    });

//pomera kategorije masaze na gore
    item.on('mouseover', function () {
        $(this).css('cursor', 'pointer');
        $(this).animate({
            top: '-8',
            opacity: 1
        }, 200);
    }).on('mouseleave', function () {

        $(this).animate({
            top: '0',
            opacity: 0.8

        }, 200);
    });
    
    
//skroluje i boji sekciju
    item.on("click", function () {
        var id = $(this).attr("id");
        switch (id) {
            case "1":
                $('html, body').animate({
                    scrollTop: ($('#anticelulit').offset().top)
                }, 300);
                detoxSec.css("background-color","white");
                relaxSec.css("background-color","white");
                antiCelSec.css("background-color","#f9d996");
                break;
            case "2":
                $('html, body').animate({
                    scrollTop: ($('#relax').offset().top)
                }, 500);
                antiCelSec.css("background-color","white");
                detoxSec.css("background-color","white");
                relaxSec.css("background-color","#bbd3f5");
                break;
            case "3":
                $('html, body').animate({
                    scrollTop: ($('#detox').offset().top)
                }, 700);
                antiCelSec.css("background-color","white");
                relaxSec.css("background-color","white");
                detoxSec.css("background-color","#ccfc99");
                break;

        }
    });

});


