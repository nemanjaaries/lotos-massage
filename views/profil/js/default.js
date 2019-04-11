$(document).ready(function () {


    var navBtn = $(".nav-btn"),
    ressDiv = $("#profil #ress"),
    noticeDiv = $("#profil #notice");
    
    
    navBtn.on("click", function () {
   
        switch ($(this).text()) {
            case "rezervacije":
                noticeDiv.css("display","none");
                ressDiv.css("display","block");
                break;
            case "obavestenja":
                ressDiv.css("display","none");
                noticeDiv.css("display","block");
                break;
        }
    });
    
    // obavestenje
    
    var btnKom = $("#btn-kom");
    var formKom = $("#form-komentar");
    
    btnKom.on("click",function(){
        if(formKom.css("display") === "none"){
            formKom.slideDown();
        }else{
            formKom.slideUp();
        }
        
        
        return false;
    });


});


