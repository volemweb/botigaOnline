
 function missatge(element, message) {
   alert(message);
   element.focus();
}
 function validar(form)
 {
    var validat=false;

   if (form.password.value != form.pswdAntic.value ) 
   {
      missatge(form.pswdAntic, "El password Antic no es correcta!!!.");
   }
   else if (form.pswdNou.value.length <6  ) 
   {
      missatge(form.pswdNou, "El nou password ha de tenir com a minim 6 caracters.");
   }
   else validat=true;
   return validat;
   
 }