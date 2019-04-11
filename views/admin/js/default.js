$(document).ready(function () {



// FUNKCIJE

    function capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    

    function confDelMass(param){
        var conf = confirm("da li zelis da izbrises masazu?"); 
        if(conf === true){
            window.location.href = url + "/deleteMass/"+param;
        }
    }
    
    function confDelBlog(param){
        var conf = confirm("da li zelis da izbrises blog?"); 
        if(conf === true){
            window.location.href = url + "/deleteBlog/"+param;
        }
    }

//iskljucuje skrolovanje
    function disableScrolling() {
        var x = window.scrollX;
        var y = window.scrollY;
        window.onscroll = function () {
            window.scrollTo(x, y);
        };
    }
//ukljucuje skrolovanje
    function enableScrolling() {
        window.onscroll = function () {};
    }

//salje zahtev na server i crta tabelu sa korisnicima
    var usersCont = $('#content-users');   
    function userTable(data) {
        ajax(url + "/xhrSearchUser", "post", data, function (response) {
            usersCont.html("");
            if ($.isEmptyObject(response)) {
                usersCont.html("<span style='font-size: 20px; color: #e84e1b;'>Nema rezultata za trazeni pojam</span>");
            } else {
                var output = "<table class='clear'>";
                output += "<tr><th>id</th><th>ime</th><th>email</th><th>pol</th><th>status</th></tr>";
                for (var i = 0; i < response.length; i++) {
                    output += "<tr>";
                    output += "<td>" + response[i].id + "</td>";
                    output += "<td><a href='" + url + "/user/" + response[i].id + "'>" + capitalize(response[i].name) + "</td>";
                    output += "<td>" + response[i].email + "</td>";
                    output += "<td>" + response[i].gender + "</td>";
                    output += "<td>" + response[i].role + "</td>";
                    output += "</tr>";
                }
                output += "</table>";
                usersCont.append(output);
            }
        });
    }
 
//salje zahtev na server i crta tabelu sa blogovima
    var blogCont = $('#content-blog');  
    function blogTable(data) {
        ajax(url + "/xhrSearchBlog", "post", data, function (response) {
            blogCont.html("");
            if ($.isEmptyObject(response)) {
                blogCont.html("<span style='font-size: 20px; color: #e84e1b;'>Nema rezultata za trazeni pojam</span>");
            } else {
                var output = "<table class='clear'>";
                output += "<tr><th>id</th><th>naslov</th><th>text</th><th>edit</th><th>delete</th></tr>";
                for (var i = 0; i < response.length; i++) {
                    output += "<tr>";
                    output += "<td>" + response[i].id + "</td>";
                    output += "<td>" + capitalize(response[i].title) + "</td>";
                    output += "<td>" + response[i].text + "</td>";
                    output += "<td><button class='button edit' name='" + response[i].id + "'>edit</button></td>";
                    output += "<td><button class='button delete' name='" + response[i].id + "'>delete</button></td>";
                    output += "</tr>";
                }
                output += "</table>";
                blogCont.append(output);

                $(".delete").on("click", function () {
                    var conf = confirm("da li zelis da izbrises blog?");
                    if (conf === true) {
                        var id = $(this).attr("name");
                        ajax(url + "/xhrDelBlog", "post", {id_blog: id}, function () {});
                    }


                    blogTable(data);
                });

                $(".edit").on("click", function () {
                    var id = $(this).attr("name");
                    window.location.href = url + "/blog/" + id;
                });
            }
        });
    }
    
    
//salje zahtev na server i crta tabelu sa masazama  
    var massCont = $('#content-massage');  
    function massageTable(data) {
        ajax(url + "/xhrSearchMass", "post", data, function (response) {
            massCont.html("");
            if ($.isEmptyObject(response)) {
                massCont.html("<span style='font-size: 20px; color: #e84e1b;'>Nema rezultata za trazeni pojam</span>");
            } else {
                var output = "<table class='clear'>";
                output += "<tr><th>naziv</th><th>opis</th><th>cena</th><th>edit</th><th>delete</th></tr>";
                for (var i = 0; i < response.length; i++) {
                    output += "<tr>";
                    output += "<td>" + capitalize(response[i].name) + "</td>";
                    output += "<td>" + response[i].text + "</td>";
                    output += "<td>" + response[i].price + "</td>";
                    output += "<td><button class='button edit' name='" + response[i].id + "'>edit</button></td>";
                    output += "<td><button class='button delete' name='" + response[i].id + "'>delete</button></td>";
                    output += "</tr>";
                }
                output += "</table>";
                massCont.append(output);

                $(".delete").on("click", function () {
                    var conf = confirm("da li zelis da izbrises?");
                    if (conf === true) {
                        var id = $(this).attr("name");
                        ajax(url + "/xhrDelMass", "post", {id_massage: id}, function () {});
                    }


                    massageTable(data);
                });

                $(".edit").on("click", function () {
                    var id = $(this).attr("name");
                    window.location.href = url + "/massage/" + id;
                });
            }
        });
    }
//salje ajax zahtev i vraca rezultat kroz collback funkciju   
    function ajax(url, method, data, cbf) {

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function (response) {
                var res = JSON.parse(response);
                cbf(res);
            }
        });
    }




// elementi sa strane admin
    var navButton = $(".nav-btn");
   var reservationSec = $("#admin-reservation"),
            massageSec = $("#admin-massage"),
            blogSec = $("#admin-blog"),
            usersSec = $("#admin-users");


//elementi sa strane korisnik
    var ressSec = $("#user #ress"),
    corrSec = $("#user #corr");


    navButton.on("click", function () {
        switch ($(this).text()) {
            case "sve rezervacije":
                blogSec.css("display", "none");
                usersSec.css("display", "none");
                massageSec.css("display", "none");
                reservationSec.css("display","block");
                break;
            case "masaze":
                reservationSec.css("display","none");
                blogSec.css("display", "none");
                usersSec.css("display", "none");
                massageSec.css("display", "block");
                break;
            case "blog":
                reservationSec.css("display","none");
                massageSec.css("display", "none");
                usersSec.css("display", "none");
                blogSec.css("display", "block");
                break;
            case "korisnici":
                reservationSec.css("display","none");
                massageSec.css("display", "none");
                blogSec.css("display", "none");
                usersSec.css("display", "block");
                break;
            case "rezervacije":
                corrSec.css("display", "none");
                ressSec.css("display", "block");
                break;
            case "prepiska":
                ressSec.css("display", "none");
                corrSec.css("display", "block");
                break;
        }
    });

//pretrazuje masaze
    var search = $("#search");
    search.on("keyup", function () {
        var value = $(this).val();
        var data = {name_massage: value};
        massageTable(data);
    });
    
//pretrazuje blogove
    var searchBlog = $("#search-blog");
    searchBlog.on("keyup", function () {
        var value = $(this).val();
        var data = {title_blog: value};
        blogTable(data);
    });

//pretrazuje korisnike
    var searchUser = $("#search-users");
    searchUser.on("keyup", function () {
        var value = $(this).val();
        var data = {name_user: value};
        userTable(data);
    });
    
//prikazuje pop-up formu za unos nove masaze
    var addBtnMass = $("#btn-add-mass");
    addBtnMass.on("click", function () {
        $(this).next().addClass("form-bar");
        $(".form-bar").fadeIn('slow');
        $('#cover').fadeIn('slow');
        disableScrolling();
    });

//sakriva pop-up
    $('#cover').on('click', function () {
        $('.form-bar').fadeOut('slow');
        $(this).fadeOut('slow');
        enableScrolling();
    });

//brise masazu
    $(".delete-mass").on("click",function(){
            var id = $(this).attr("name");
            confDelMass(id);    
    });
    
//brise blog
    $(".delete-blog").on("click",function(){
            var id = $(this).attr("name");
            confDelBlog(id);    
    });
    
    var addBtnBlog = $("#btn-add-blog");
    addBtnBlog.on("click", function () {
        $(this).next().addClass("form-bar");
        $(".form-bar").fadeIn('slow');
        $('#cover').fadeIn('slow');
        disableScrolling();
    });
    


});


//    $('.button').on('click', function () {
//        $(this).next().addClass("form-bar");
//        $.ajax({
//            url: "http://localhost/masaze/usluga/xhrSessionExist",
//            type: "get",
//            success: function (response) {
//                if (response == "postoji") {
//                    $(".form-bar").fadeIn('slow');
//                    $('#cover').fadeIn('slow');
//                    disableScrolling();
//                }else{
//                    alert("sesija ne postoji");
//                }
//            }
//        });
//
//
//        return false;
//    });




//    search.on("keyup",function(){
//        var value = $(this).val();
//        var data = {naziv_masaza: value};
//        ajax("http://localhost/masaze/admin/xhrSearchMass", "post",data,function(response){
//           $("#masaze-tabela").html("");
//           var output = "<table class='default clear'>";
//                output += "<tr><th>id</th><th>naziv</th><th>opis</th><th>slika</th><th>cena</th><th>edit</th><th>delete</th></tr>";
//                for (var i = 0; i < response.length; i++) {
//                    output += "<tr>";
//                    output += "<td>" + response[i].id_masaza + "</td>";
//                    output += "<td>" + response[i].naziv_masaza + "</td>";
//                    output += "<td>" + response[i].opis_masaza + "</td>";
//                    output += "<td>" + response[i].slika_masaza + "</td>";
//                    output += "<td>" + response[i].cena_masaza + "</td>";
//                    output += "<td><button>edit</button></td>";
//                    output += "<td><button id='"+response[i].id_masaza+"' class='delete' >delete</button></td>";
//                    output += "</tr>";
//                }
//                output += "</table>";
//                $("#masaze-tabela").append(output);
//                
//                $(".delete").on("click",function(){
//                   var conf = confirm("da li zelis da izbrises?");
//                    if(conf === true){
//                     var id = $(this).attr("id");
//                     ajax("http://localhost/masaze/admin/xhrDelMass","post",{id_masaza: id},function(){});
//                 }
//                 });
//       });
//    });