$(document).ready(main);

var contador=1;
var amagar=1;

function main()
{
    $('.btn_menu').click(function(){
        //$('nav').toggle(); Aixo fa que desapareixi i apareixi
        
        if(contador===1)
        {
            $("#menu ul").css('display','block');
            $("#menu ul").css('display','inline');
            contador=0;
            amagar=1;
        }
        else
        {
            contador=1;
            $("#menu ul").css('display','none');
        }
        
    });
    
    // Aixo seria una opció per solventar el tema del menu
    //Quant canvia el tamany de la finestra faig aquestes dues accions
    
    $(window).resize(function()
    {   
     //si la finestra es mes gran que 800 faig que es mostri la llista opcions
     if ( $(window).width()>800)
       { 
           $("#menu ul").css('display','block');
           $("#menu ul").css('display','inline');
           //indico que quant es fagi petit s'amagin les opcions
           amagar=0;
           //inicialitzo el contador una altre vegada
           contador=1;
     }
    // si la finestra es fa mes petita de 800 dic que s'amagi les opcios fins que l'usuari no cliqui el menu
    else if ( $(window).width()<800)
    {   if(amagar===0)
        {
        $("#menu ul").css('display','none');
        contador=1;
        }
   }
    });
    
    
};


