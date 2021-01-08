$( document ).ready(function() {
    $('#submenu0').toggle();
    $('#submenu1').toggle();
    $('#submenu2').toggle();
    $('#submenu3').toggle();

    $('#menu0').click(function(){
       $('#submenu0').toggle();
       $('#submenu1').hide();
       $('#submenu2').hide();
       $('#submenu3').hide();
    })
    $('#menu1').click(function(){
        $('#submenu1').toggle();
        $('#submenu0').hide();
        $('#submenu2').hide();
        $('#submenu3').hide();
     })
     $('#menu2').click(function(){
        $('#submenu2').toggle();
        $('#submenu1').hide();
        $('#submenu0').hide();
        $('#submenu3').hide();
     })
     $('#menu3').click(function(){
        $('#submenu3').toggle();
        $('#submenu1').hide();
        $('#submenu2').hide();
        $('#submenu0').hide();
     })

    
})