<?php
// aquí cal posar el fus horari andorrà xq no es queixi
date_default_timezone_set("Europe/Andorra");

// comprovem si el PHP és capaç de cridar el Ghostscript
$AVUI = date("r");

// cap
 echo "<font face='Monaco, Courier New' size=2 color='#5f696b'><br>".$AVUI."<br>PHP: ". phpversion()."<br></font><br><br><font face='Monaco, Courier New' size=3 color='#ff0000'><center>Taller de Tipografia en Plom<br>(<i>aquest PHP pot cridar Ghostscript?</i>)".$elPDFe."</center></font><br><p><br><br><br><font face='Monaco, Courier New' size=3 color='#999999'> ...surt el prompt de Ghostscript?<br><br><font face='Monaco, Courier New' size=3 color='#000000'><pre>";


    $command = "/usr/local/bin/gs -sDEVICE=bbox";  // servidor RIMDA www.ub.edu/tallerdetipografia
//  $command = "gs -h";
//  echo $command;

    $LaDarrera = system($command, $ElQtorna);

// ho comprovem obrint el prompt de l'intèrpret PostScript
if($ElQtorna==0)
echo "</pre><br><br></font></font><font face='Monaco, Courier New' size=3 color='#ff0000'> ...CORRECTE!</font><br>";
else
echo "<br><font face='Monaco, Courier New' size=3 color='#ff0000'> ...Ghostscript NO ha estat cridat correctament</font><br>";

?>
