$(document).ready(function(){
   
    
    $('.item').on('mouseover',function(){
        $(this).css('cursor','pointer');
        $(this).animate({
            top : '-8',
            opacity : 1
        },200);
    }).on('mouseleave',function(){
        
        $(this).animate({
            top : '0',
            opacity : 0.8
            
        },200);    
    });
    
    $('.bxslider').bxSlider({
    auto: false,
    autoControls: true,
    speed: 2000,
    pager: true,
    slideWidth: 1200
  });
  
  
  
    
});


