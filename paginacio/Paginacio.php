<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classe_paginacio
 *
 * @author vador
 */
class Paginacio {
    
    private $_numPagines;
    private $_pagActual;
    private $_pagSeguent;
    private $_pagAnterior;
    private $_url;
    
    public function __construct($numPagines,$pagina,$url) {
        
        $this->_numPagines=$numPagines;
        $this->_pagActual=$pagina;
        $this->_pagAnterior=$pagina-1;
        $this->_pagSeguent=$pagina+1;
        $this->_url=$url;
    }
   
    public function __toString() {
        
        
        $pagina=$this->_pagActual;
        
        /*CONFIGURACIO D'ANTERIOR*/
        
        if($this->_pagActual==1)
        {
            echo "<table class='paginacio'><tr><td class='paginacioLletres'> [Ant] </td>";
        }
        else if($this->_pagActual>1)
        {
           echo "<table class='paginacio'><tr>".
               "<td class='paginacioLletres'><a href='./".$this->_url."?pag=1'> [Primer] </a></td>".
               "<td class='paginacioLletres'><a href='./".$this->_url."?pag=".$this->_pagAnterior."'> [Ant] </a></td>";
        }
        
        /*CONFIGURACIO NUMEROS CENTRALS */
        if($this->_numPagines<5)
        {
            for ($n=1;$n<=$this->_numPagines;$n++)
           {
             echo "<td class='paginacioNum'><a href='./".$this->_url."?pag=".$n."'> ".$n." </a></td>"; 
           }
        }
        
        else
        {
        if ($this->_pagActual<5)
        {
           
           for ($n=1;$n<=5;$n++)
           {
             echo "<td class='paginacioNum'><a href='./".$this->_url."?pag=".$n."'> ".$n." </a></td>"; 
           }
        }
        else if($this->_pagActual==5 or ($this->_pagActual>5 && $this->_pagActual<$this->_numPagines))
        {
           $Pag=$this->_pagActual-4;
           for ($n=1;$n<=5;$n++)
           {
             echo "<td class='paginacioNum'><a href='./".$this->_url."?pag=".$Pag."'> ".$Pag." </a></td>"; 
             $Pag++;
           }
            
        }
        else if($this->_pagActual==$this->_numPagines)
        {
           $Pag=$this->_pagActual-4;
           for ($n=1;$n<=5;$n++)
           {
             echo "<td class='paginacioNum'><a href='./".$this->_url."?pag=".$Pag."'> ".$Pag." </a></td>"; 
             $Pag++;
           }
           
        }
        }
        /*Configuracio de SEGUENT*/
        
        if($this->_pagActual==$this->_numPagines)
        {
            echo "<td class='paginacioLletres'> [Seg] </td>".
                    "</tr></table>";
        }
        else if($this->_pagActual<$this->_numPagines)
        {
           echo "<td class='paginacioLletres'><a href='./".$this->_url."?pag=".$this->_pagSeguent."'> [Seg] </a></td>".
                   "<td class='paginacioLletres'><a href='./".$this->_url."?pag=".$this->_numPagines."'>[Últim]</a></td>".
                   "</tr></table>";
        }
        
        echo "<div id='numPag'>Pàgina:".$this->_pagActual." de ".$this->_numPagines."</div>";
        
        ;
    }
}

?>
