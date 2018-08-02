$(document).ready(main);

 var visible=0;
 var valor='';
 var valor_ant='';
 var opcio_ant;
 var amagar=1;
 var contador=1;
 
 function amagarSubmenu()
 {
    $('#submenu').hide('slow');
    $(valor).css('display','none');
    visible=0;
 }
 
 $('#submenu .tancar').click(function(){
     
     amagarSubmenu();
 });
 

function main()
{
     $('#submenu .tancar').click(function(){
          amagarSubmenu();
      });
    
     $('#menuprincipal li').click(function(event){
               
                var opcio=$(this).attr('id'); //Aqui obting l'opcio que s'aha clicat a la web
                valor='#submenu .'+opcio; //el valor es l'opcio de la llista que s'ha de mostrar
                
                
            if(opcio!=null)
            {
                if(visible==0)
                {
                   event.preventDefault();
                   $('#submenu').show(1000,function()
                   {
                       //$(valor).css('color','red');//Amb aixó faig que les lletes del submenu siguin vermelles
                   }
                   
                 );
                   $(valor).css('display','block');
                   $('#submenu').data('opcio_ant',opcio); //Aqui guardo el valor de l'opcio anterior marcada
                                                          //dins el camp data del la llista submenu
                   visible=1;
                }
                else if(visible==1 & opcio!=$('#submenu').data('opcio_ant') )
                {
                    /*Aqui faig que si el submenu es visible i la opcio seleccionada es diferent a 
                     * l'opcio seleccionada anteriorment et mostri el submenu de la opcio actual seleccionada 
                    */
                  
                    opcio_ant=$('#submenu').data('opcio_ant');//recupero el valor de la opcio anterior
                    valor_ant='#submenu .'+opcio_ant;
                    $(valor_ant).css('display','none'); //Amago la opcio anterior seleccionada
                    
                    valor='#submenu .'+opcio; //mostro la opcio actual
                    $(valor).css('display','block');
                    
                    $('#submenu').data('opcio_ant',opcio); //Guardo la opcio actual com opcio anterior
                    
                }
                else if (visible==1 & opcio==$(this).attr('id') )
                {
                    /* Aqui si la opcio seleccionada coincideix amb la opcio actualment oberta
                     * amaga el submenu. 
                     */
                   amagarSubmenu();
                }
            }
         });
         
     $('.btn_menu').click(function(){
        //$('nav').toggle(); Aixo fa que desapareixi i apareixi
        
        if(contador==1)
        {
            $("#menuprincipal ul").css('display','block');
            contador=0;
            amagar=1;
        }
        else
        { 
            amagarSubmenu();
             
            contador=1;
            $("#menuprincipal ul").css('display','none');
            
        }
        
    });
    
    
    // Aixo seria una opció per solventar el tema del menu
    //Quant canvia el tamany de la finestra faig aquestes dues accions
    $(window).resize(function()
    {
        
     //si la finestra es mes gran que 800 faig que es mostri lallista opcions
     if ( $(window).width()>600)
       { 
           amagarSubmenu();
           
           $("#menuprincipal ul").css('display','block');
           //indico que quant es fagi petit s'amagin les opcions
           amagar=0;
           //inicialitzo el contador una altre vegada
           contador=1;
         
     }
    // si la finestra es fa mes petita de 800 dic que s'amagi les opcios fins que l'usuari no cliqui el menu
    else if ( $(window).width()<600)
    {   
        if(amagar==0)
        {
        $("#menuprincipal ul").css('display','none');
        contador=1;
        
           amagarSubmenu();
        }
   }
    });
    
    /*S'HA de correguir
   
    
    var position=$("#menuprincipal").position();
    var num=position.top;
    
    var position2=$("#capçaLogo").position();
    var num2=position2.top;
     
    alert (num+'-'+num2); 
    
    var position=$("#menuprincipal").offset();
    
    num=110;
    --Aixo es perque el menu es quedi fixe a dalt.
   $(window).bind('scroll', function () { 
        
       if ($(window).scrollTop() > position.top+100) {
           
          // alert ($(window).scrollTop());
          
            $('#menuprincipal').addClass('fixed');
            $('#submenu').addClass('fixedSubmenu');
           // $('.subtitol').css("display","block");
        } else {
            $('#menuprincipal').removeClass('fixed');
            $('#submenu').removeClass('fixedSubmenu');
           // $('.subtitol').css("display","none");
        }
    }); */
               
 }
 
 
  /* EXEMPLE COM FER-HO DINTRE LA PAGINA MATEIX
  *  <script type="text/javascript">
         var visible=0;
         var valor='';
          $(document).ready( function(){
              
           $('#menuprincipal li').click(function(event){
               
                var opcio=$(this).attr('id');
                alert (opcio);
                valor='#submenu .'+opcio;
                alert (valor);
                if(visible==0)
                {
                   event.preventDefault();
                   $('#submenu').show(1000);
                   $(valor).css('display','block');
                   //$('#submenu').css('display','block');
                   visible=1;
                }
                else
                {
                    $('#submenu').hide('slow');
                   //$('#submenu').css('display','none');
                   $(valor).css('display','none');
                   visible=0;
                }
              });
              
          });
        </script>
  */
   
 