<?php

// comprovem si el PHP �s capa� de cridar el Ghostscript
$AVUI = date("r");

// *aqui*
 echo "<font face='Monaco, Courier New' size=1 color='#5f696b'><br>".$AVUI."<br>PHP: ". phpversion()."<br></font><br><br><font face='Monaco, Courier New' size=3 color='#ff0000'><center>aquest PHP pot cridar Ghostscript?".$elPDFe."</center></font><br><p><br><br><br><font face='Monaco, Courier New' size=3 color='#999999'> ...surt el prompt de Ghostscript?<br><br><font face='Monaco, Courier New' size=3 color='#000000'><pre>";


//    $command = "gs -sDEVICE=bbox";
    $command = "gs -h";
//      echo $command;

    $LaDarrera = system($command, $ElQtorna);

// ho comprovem obrint el prompt de l'int�rpret PostScript
if($ElQtorna==0)
echo "</pre><br><br></font></font><font face='Monaco, Courier New' size=3 color='#ff0000'> ...CORRECTE!</font><br>";
else
echo "<br><font face='Monaco, Courier New' size=3 color='#ff0000'> ...Ghostscript NO ha estat cridat correctament</font><br>";

?>
