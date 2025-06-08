<?php
// aquí cal posar el fus horari andorrà perquè no es queixi
date_default_timezone_set("Europe/Andorra");
// hora, dia, mes i any
$AVUI = date("r");

// cap
 echo "<font face='Monaco, Courier New' size=2 color='#5f696b'><br>".$AVUI."<br>PHP: ". phpversion()."<br></font><br><br><font face='Monaco, Courier New' size=3 color='#ff0000'><center>aquest PHP pot cridar Ghostscript i hi pot escriure PDFs a disc?</center></font><br><br><br><font face='Monaco, Courier New' size=3 color='#999999'> ...surt el prompt de Ghostscript?</font><br><br><pre><font face='Monaco, Courier New' size=3 color='#000000'>";

// comprovem si el PHP és capaç de cridar el Ghostscript 9.55 que ens van assignar a:
    $command = "/usr/local/bin/gs -sDEVICE=bbox";  // servidor RIMDA www.ub.edu/tallerdetipografia

    $LaDarrera = system($command, $ElQtorna);

// ho comprovem obrint el prompt de l'intèrpret PostScript
if($ElQtorna==0)
    echo "</font></pre><br><font face='Monaco, Courier New' size=3 color='#ff0000'> ...Ghostscript 9.55 HA ESTAT cridat <strong>correctament!</strong></font><br><br><br><pre><font face='Monaco, Courier New' size=3 color='#000000'>";
else
    echo "<br></font></pre><font face='Monaco, Courier New' size=3 color='#ff0000'> ...Ghostscript 9.55 <strong>NO HA ESTAT</strong> cridat correctament!</font><br><br><br><pre><font face='Monaco, Courier New' size=3 color='#000000'>";

// comprovem si el PHP és capaç de cridar el Ghostscript 9.52 que ens van assignar a:
// GPL Ghostscript 9.52 (2020-03-19) actualització de juny/juliol de 2024 al servidor www.ub.edu/cursusductus
    $command = "/usr/bin/gs -sDEVICE=bbox";

    $LaDarrera = system($command, $ElQtorna);
    
// ho comprovem obrint el prompt de l'intèrpret PostScript
if($ElQtorna==0)
    echo "</font></pre><br><font face='Monaco, Courier New' size=3 color='#ff0000'> ...Ghostscript 9.52 HA ESTAT cridat <strong>correctament!</strong></font><br>";
else
    echo "</font></pre><br><font face='Monaco, Courier New' size=3 color='#ff0000'> ...Ghostscript 9.52 de cursusductus/ <strong>NO HA ESTAT</strong> cridat correctament!</font><br>";

// fent la prova d'escriptura?
    echo "<br><br><pre><font face='Monaco, Courier New' size=3 color='#5f696b'> . . . h i    p o d e m    e s c r i u r e ?</font></pre><br><br>";

//+ + + + + + + + + + + + + + + +  GS 9.55    
$pdfFile = "siPHPcridaGS9.55_ihiDeixaEscriureB.pdf";

//$PSapplet = "siPHPcridaGS9.55_ihiDeixaEscriure.ps";
$PSapplet = "mesuresBlancs_interlinies_prompt.ps";

$command = "/usr/local/bin/gs -q -dNOSAFER -o pdfs/'" . $pdfFile . "' -dALLOWPSTRANSPARENCY -sDEVICE=pdfwrite -dAutoRotatePages=/None -f '" . $PSapplet . "'";

// aquest és un mètode per capturar el prompt i presentar-lo embolicat d'html
ob_start();
$LaDarrera = passthru($command, $ElQtorna);  // $LaDarrera queda buida
$prompt = ob_get_contents();
ob_end_clean();

// demostra com treballa amb la captura de la darrera linia i el parametre de tornada
// echo '</p><hr />La darrera Linia: ' . $LaDarrera . '<hr />El que ens torna: ' . $ElQtorna;
// $LaDarrera és la darrera línia del prompt
// anàlisi d' $ElQtorna
// si torna 127 és que el gs no s'ha executat?
// si torna 1 és que hi ha hagut un ofendingcommand (error a l'execució del ps) o el directori on escriure el PDF no existeix o no té permisos
// o hi hagi un error al nom o el fitxer .ps a interpretar no tingui prous permisos (oju amb el chmod), també genera un valor de 1!
// si torna 0 és que el .ps s'ha executat sense errors

//@SOM aquí
//exit($ElQtorna . " ...que ha fet?");

// com avaluem si s'ha generat el pdf correctament?
if ($ElQtorna == 127)
{  // el gs NO s'ha executat
// exit("...sembla que el GS no s'ha executat");
 echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; l'int&egrave;rpret Ghostscript 9.55 no s'ha executat &lt;&lt;&lt;</span>";
//@@RIMDAUB
 echo "<br><p><br><p><span style='color:#ff0000;font-family:monospace;font-size:24px'><a style='color:#ff0000;font-family:monospace;font-size:24px' href='mailto:marcantoni.malagarriga.picas@ub.edu'>podeu documentar-nos l'error via email? (copieu i enganxeu el text en gris) gr&agrave;cies!</a><br><br><a style='color:#ff0000;font-family:monospace;font-size:18px' href='https://www.ub.edu/tallerdetipografia/caixista/index_componedoraRIMDA00.html'>Taller de Tipografia en Plom</a></center>";

//echo "</body></html>";
}
{
 //      if (file_exists($pdfFile))
 if ($ElQtorna == 0)
 {
	 echo "<br><br><span style='color:#ff0000;font-family:monospace;font-size:24px'> AQUÍ HAURÍEM DE XUTAR EL PDF ".$pdfFile."</span><br><br>";
 }
 else
 { // podem provocar errors executant sense interfície amb només comandes via URL (captura GET)
  // aquí també hi arriben els errors de sintax PostScript
//@RIMDAUB en el cas que manqui o hi hagi un error al nom del directori de sortida /pdfs o el fitxer .ps a interpretar no tingui prous permisos, genera un valor de 1!


//@RIMDAUB * aquí és on ens en anem si cancel·lem
// si pot ser útil fer una captura de la URL aquí tenim el mètode, però:
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
// tenint en compte de si s'afegeixen dues barres // al principi de l'adreça (en localhost passa) que cal eliminar si volem que la URL sigui útil
// tenint en compte també que la notació d'aquesta string segueix la pauta de p.e. esciure els espais en blanc com a %20 (el seu valor hexa)
$urlplana = urldecode($url);  // aplanem la URL per tal que p.e. els espais en blanc no surtin com a %20

  // aquí llistem l'ERROR del prompt i demanem que s'enviï
  echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; ERROR d'execuci&oacute; de l'algorisme al GS 9.55 &lt;&lt;&lt;</span>";
  echo "<br><br><span style='color:#999999;font-family:monospace;font-size:24px'>".$prompt." + ".$ElQtorna."<br></span>";
//@RIMDAUB localhost
  echo "<br><p><br><p><span style='color:#ff0000;font-family:monospace;font-size:24px'><a style='color:#ff0000;font-family:monospace;font-size:24px' href='mailto:marcantoni.malagarriga.picas@ub.edu'>podeu documentar-nos l'error via email? (<i>copieu i enganxeu el text en gris i la URL en groc</i>) gr&agrave;cies!</a><br><br><a style='color:#0000ff;font-family:monospace;font-size:18px' href=''>La URL que heu executat...</a></span><br><pre style='color:#ff0000;font-family:monospace;font-size:16px;background-color:#ffffbb'>http:$urlplana</pre><br><br><br></center>";
 }

}


//+ + + + + + + + + + + + + + + +  GS 9.52 
$pdfFile2 = "siPHPcridaGS9.52_ihiDeixaEscriure.pdf";
$PSapplet2 = "siPHPcridaGS9.52_ihiDeixaEscriure.ps";

$command = "/usr/bin/gs -q -dNOSAFER -o pdfs/'" . $pdfFile2 . "' -dALLOWPSTRANSPARENCY -sDEVICE=pdfwrite -dAutoRotatePages=/None -f '" . $PSapplet2 . "'";

// aquest és un mètode per capturar el prompt i presentar-lo embolicat d'html
ob_start();
$LaDarrera = passthru($command, $ElQtorna);  // $LaDarrera queda buida
$prompt = ob_get_contents();
ob_end_clean();

// demostra com treballa amb la captura de la darrera linia i el parametre de tornada
// echo '</p><hr />La darrera Linia: ' . $LaDarrera . '<hr />El que ens torna: ' . $ElQtorna;
// $LaDarrera és la darrera línia del prompt
// anàlisi d' $ElQtorna
// si torna 127 és que el gs no s'ha executat?
// si torna 1 és que hi ha hagut un ofendingcommand (error a l'execució del ps) o el directori on escriure el PDF no existeix o no té permisos
// o hi hagi un error al nom o el fitxer .ps a interpretar no tingui prous permisos (oju amb el chmod), també genera un valor de 1!
// si torna 0 és que el .ps s'ha executat sense errors

//@SOM aquí
//exit($ElQtorna . " ...que ha fet?");

// com avaluem si s'ha generat el pdf correctament?
if ($ElQtorna == 127)
{  // el gs NO s'ha executat
// exit("...sembla que el GS no s'ha executat");
 echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; l'int&egrave;rpret Ghostscript 9.52 no s'ha executat &lt;&lt;&lt;</span>";
//@@RIMDAUB
 echo "<br><p><br><p><span style='color:#ff0000;font-family:monospace;font-size:24px'><a style='color:#ff0000;font-family:monospace;font-size:24px' href='mailto:marcantoni.malagarriga.picas@ub.edu'>podeu documentar-nos l'error via email? (copieu i enganxeu el text en gris) gr&agrave;cies!</a><br><br><a style='color:#ff0000;font-family:monospace;font-size:18px' href='https://www.ub.edu/tallerdetipografia/caixista/index_componedoraRIMDA00.html'>Taller de Tipografia en Plom</a></center>";

//echo "</body></html>";
}
{
 //      if (file_exists($pdfFile))
 if ($ElQtorna == 0)
 {
	 echo "<br><br><span style='color:#ff0000;font-family:monospace;font-size:24px'> AQUÍ HAURÍEM DE XUTAR EL PDF ".$pdfFile2."</span><br><br>";
 }
 else
 { // podem provocar errors executant sense interfície amb només comandes via URL (captura GET)
  // aquí també hi arriben els errors de sintax PostScript
//@RIMDAUB en el cas que manqui o hi hagi un error al nom del directori de sortida /pdfs o el fitxer .ps a interpretar no tingui prous permisos, genera un valor de 1!


//@RIMDAUB * aquí és on ens en anem si cancel·lem
// si pot ser útil fer una captura de la URL aquí tenim el mètode, però:
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
// tenint en compte de si s'afegeixen dues barres // al principi de l'adreça (en localhost passa) que cal eliminar si volem que la URL sigui útil
// tenint en compte també que la notació d'aquesta string segueix la pauta de p.e. esciure els espais en blanc com a %20 (el seu valor hexa)
$urlplana = urldecode($url);  // aplanem la URL per tal que p.e. els espais en blanc no surtin com a %20

  // aquí llistem l'ERROR del prompt i demanem que s'enviï
  echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; ERROR d'execuci&oacute; de l'algorisme al GS 9.52 &lt;&lt;&lt;</span>";
  echo "<br><br><span style='color:#999999;font-family:monospace;font-size:24px'>".$prompt." + ".$ElQtorna."<br></span>";
//@RIMDAUB localhost
  echo "<br><p><br><p><span style='color:#ff0000;font-family:monospace;font-size:24px'><a style='color:#ff0000;font-family:monospace;font-size:24px' href='mailto:marcantoni.malagarriga.picas@ub.edu'>podeu documentar-nos l'error via email? (<i>copieu i enganxeu el text en gris i la URL en groc</i>) gr&agrave;cies!</a><br><br><a style='color:#0000ff;font-family:monospace;font-size:18px' href=''>La URL que heu executat...</a></span><br><pre style='color:#ff0000;font-family:monospace;font-size:16px;background-color:#ffffbb'>http:$urlplana</pre><br><br><br></center>";
 }

}
?>
