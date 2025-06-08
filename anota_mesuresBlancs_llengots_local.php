<?php

  // adreça absoluta al directori dels PDFs resultants
  //$somaPDF = "/var/www/html/www.ub.edu/tallerdetipografia/caixista/pdfs/re.pdf";  // localhost Tuxedo
  $somaPDF = "pdfs/re.pdf";  // OBLIGATS A TREBALLAR AMB EL PATH RELATIU! al servidor ub.edu/tallerdetipografia
  $somaGS = "/usr/bin/";  // path a l'executable de Ghostscript al localhost de Tuxedo
  //$somaGS = "/usr/local/bin/";  // path a l'executable de Ghostscript al servidor ub.edu/tallerdetipografia
  $PSapplet = "mesuresBlancs_llengots_prompt.ps";
  //
  // @EP aquesta pel gs 9.55 localhost de Tuxedo/servidor UB
  $command = $somaGS . "gs -q -dNOSAFER -o '" . $somaPDF . "' -sDEVICE=pdfwrite -f '" . $PSapplet . "'";

  // si posem </pre> ens llistarà els missatges respectant la sintaxi que ve del PS
  // anotem el contingut de la taula d'interlínies en format PS
  echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; Taula de Mesures de Blancs de Llengots &lt;&lt;&lt;</span></center>";
  //echo "<br><br><span style='color:#999999;font-family:monospace;font-size:24px'>".$prompt." + ".$ElQtorna."<br></span></center>";

   echo "<pre style='color:#999999;font-family:monospace;font-size:24px;padding-left: 2em'>";
   // mètode normal de llistat del prompt
   //$LaDarrera = system($command, $ElQtorna);

// mètode acurat per capturar el prompt i presentar-lo embolicat d'html
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
   echo "$prompt";

  echo "<br><center style='color:#000000;font-family:monospace;font-size:16px'>L'índex zero del primer array indica les unitats /p (punts), la resta d'índex indiquen el valor del cos<br>Les subarrays de cadascun dels cossos actius duen també a l'índex zero les unitats /c (cíceros) i la resta de valors són les mesures d'amplada de cada peça</center><br></pre>";

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

?>
