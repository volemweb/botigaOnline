function vacio(q) {  
        for ( i = 0; i < q.length; i++ )
		 {  
                if ( q.charAt(i) != " " ) 
				{  
                        return true  
                }  
        }  
        return false  
 }
 //Aquesta funcio et comprova que no hi hagin ceracters extranys
 function caractersInvalids(q) {  
        for ( i = 0; i < q.length; i++ )
		 {  
                if ( q.charAt(i) == "/" || q.charAt(i) == "?" || q.charAt(i) == "%" || q.charAt(i) == "=" || q.charAt(i) == ":" )
				 {  
                        return true  
                }  
        }  
        return false  
 }
 
 function numCaracters(q)
 {
     var ok=false;
     if(q.length <6){ ok= false}
     else if(q.length>=6){ok= true}
 
    return ok;
 }
 
 function validarEmail(valor) 
 {
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor))
   {return true}   
   else 
   {return false}
}

 function missatge(element, message) {
   alert(message);
   element.focus();
}
 function validar(form)
 {
    var validat=false;

   if (vacio(form.nom.value)== false  ) 
   {
      missatge(form.nom, "El camp\"Nom\" no pot estar en blanc.");
   }
   else if (vacio(form.cognoms.value)== false  ) 
   {
      missatge(form.cognoms, "El camp\"Cognoms\" no pot estar en blanc.");
   }
   
   else if (vacio(form.email.value)==false || validarEmail(form.email.value)==false)
   {
      missatge(form.email, "El camp \"Email\" no pot estar en blanc o ha de ser correcte.");
   }
   else if (vacio(form.direccio.value)== false  ) 
   {
      missatge(form.direccio, "El camp\"Direcció\" no pot estar en blanc.");
   }
   else if (vacio(form.poblacio.value)== false  ) 
   {
      missatge(form.poblacio, "El camp\"Població\" no pot estar en blanc.");
   }
   else if (vacio(form.codipostal.value)== false  ) 
   {
      missatge(form.codipostal, "El camp\"Codi Postal\" no pot estar en blanc.");
   }
   else if (vacio(form.nickUsuari.value)== false  ) 
   {
      missatge(form.nickUsuari, "El camp\"Usuari\" no pot estar en blanc.");
   }
   else if (vacio(form.passwordUsuari.value)== false  ) 
   {
      missatge(form.passwordUsuari, "El camp\"Password\" no pot estar en blanc.");
   }
   else if(numCaracters(form.passwordUsuari.value)==false )
   {
      missatge(form.passwordUsuari, "El camp\"Password\" Mínim 6 caracters");
   }
   else validat=true;
   return validat;
   
 }