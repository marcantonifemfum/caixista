<?php

// creem una galeta JS de l'hora del client
echo "<script>var _quinHoraEs = new Date().toLocaleTimeString();setCookie('quinHoraEs', _quinHoraEs, 1);</script>";

/*
echo "<!-- TEST de si la galeta via JS es capta aquí? -->
<script>
alert(_quinHoraEs);
</script>
";
*/

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{  // Si fem GET: passem el valor de les variables dins la mateixa URL

// exit('GET!');

 // esborrem les anteriors per si les mosques?

 putenv('mesura=');  // M1
 putenv('reng=');  // M2
 putenv('cos=');  // M3


 // capturem les variables de la URL

 $mesura=$_GET['mesura'];  // M1
 //echo($mesura.'<br>');

 $reng=$_GET['reng'];  // M2
 //echo($reng.'<br>');

 $cos=$_GET['cos'];  // M3
 //echo($cos.'<br>');

}
else
{  // Si fem POST: les variables vindran triades des d'index_##.php o index.html

 exit('no fem POST ara!');

}

//@RIMDAUB
//amb l'hora del servidor en prou com a nom únic?
$PDFunic = date("d"."B"."H"."i"."s");
// EP! aquí cal veure si al servidor UB podem posar-hi o no les 3 www al davant
$baseURL = "http://localhost/www.ub.edu/tallerdetipografia/caixista/";  // localhost de Tuxedo
// adreça absoluta al directori dels PDFs resultants
$somaPDF = "/var/www/html/www.ub.edu/tallerdetipografia/caixista/pdfs/";  // localhost Tuxedo
$somaGS = "/usr/bin/";  // path a l'executable de Ghostscript al localhost de Tuxedo
$baseurlPDF = "http://localhost/www.ub.edu/tallerdetipografia/caixista/pdfs/";  // base url al pdf al localhost de Tuxedo
$PSapplet = $somaPS . "tallerdetipografia_componedoraRIMDA00.ps";

// i la cridarem després de l'execució
$pdfnomes = $PDFunic . "_tallerdetipografia_componedoraRIMDA00.pdf";
$pdfFile = $somaPDF . $pdfnomes;


//@EP aquí desem $PDFunic com a variable d'entorn per tal de capturar-la, si calgués, p.e. per desar-hi un HTML amb les dades de composició
putenv("MRCT_PDFunic=$PDFunic");  // desem el numèric únic a la variable d'entorn
// variables definides dins la URL
putenv("MRCT_mesura=$mesura");  // paràmetre de la llargada de línia (reng) al motlle de composició
putenv("MRCT_reng=$reng");  // noms i valors de cadascuna de les Mesures de Blancs amb les que componem el reng d'esquerra a dreta
putenv("MRCT_cos=$cos");  // cos fix per a tot el reng

// crida a partir de la versió GS 9.55 al localhost del MacBookAir
//$command = $somaGS . "gs -q -dNOSAFER -o '" . $pdfFile . "' -dALLOWPSTRANSPARENCY -sDEVICE=pdfwrite -dAutoRotatePages=/None -dNEWPDF=false  -f '" . $PSapplet . "'";
// @EP aquesta pel gs 9.55 localhost de Tuxedo
$command = $somaGS . "gs -q -dNOSAFER -o '" . $pdfFile . "' -dALLOWPSTRANSPARENCY -sDEVICE=pdfwrite -dAutoRotatePages=/None -f '" . $PSapplet . "'";
// aquesta crida encara és valida pel GS 9.27 del nou servidor de commonscloud.coop
//$command = $somaGS . "gs -q -dNOSAFER -o '" . $pdfFile . "' -sDEVICE=pdfwrite -dAutoRotatePages=/None -c .setpdfwrite -f '" . $PSapplet . "'";

//exit($command);

//@RIMDAUB si anem a true ens llista els missatges per la pantalla de l'html comn si fos el prompt del Terminal
if(false)
{  // si posem </pre> ens llistarà els missatges respectant la sintaxi que ve del PS
 echo '<pre>';
 // mètode normal de llistat del prompt
 $LaDarrera = system($command, $ElQtorna);

 exit("- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -");

 echo '</pre>';
}
else
{  // aquest és un mètode per capturar el prompt i presentar-lo embolicat d'html
 ob_start();
 $LaDarrera = passthru($command, $ElQtorna);  // $LaDarrera queda buida
 $prompt = ob_get_contents();
 ob_end_clean();
}

// demostra com treballa amb la captura de la darrera linia i el parametre de tornada
// echo '</p><hr />La darrera Linia: ' . $LaDarrera . '<hr />El que ens torna: ' . $ElQtorna;
// $LaDarrera és la darrera línia del prompt
// anàlisi d' $ElQtorna
// si torna 127 és que el gs no s'ha executat?
// si torna 1 és que hi ha hagut un ofendingcommand (error a l'execució del ps) o el directori on escriure el PDF no existeix o no té permisos
// o hi hagi un error al nom o el fitxer .ps a interpretar no tingui prous permisos (oju amb el chmod), també genera un valor de 1!
// si torna 0 és que el .ps s'ha executat sense errors

// exit("...que ha fet?");

// com avaluem si s'ha generat el pdf correctament?
if ($ElQtorna == 127)
{  // el gs NO s'ha executat
// exit("...sembla que el GS no s'ha executat");
 echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; l'int&egrave;rpret Ghostscript no s'ha executat &lt;&lt;&lt;</span>";
//@@RIMDAUB
 exit("<br><p><br><p><span style='color:#ff0000;font-family:monospace;font-size:24px'><a style='color:#ff0000;font-family:monospace;font-size:24px' href='mailto:marcantoni.malagarriga.picas@ub.edu'>podeu documentar-nos l'error via email? (copieu i enganxeu el text en gris) gr&agrave;cies!</a><br><br><a style='color:#ff0000;font-family:monospace;font-size:18px' href='$baseURL'>pliegO'Maker</a></center>");

echo "</body></html>";
}
{
 //      if (file_exists($pdfFile))
 if ($ElQtorna == 0)
 {
  if ($mapai == 7)  // assagem?
  {
   //echo ($prompt);  // el prompt del .ps llistat pel gs
   //exit("...sembla que ho ha fet bé!");

   //@RIMDAUB localhost
   // aquí llistem el mapa d'imposició com si fos el prompt del Terminal
   echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; ASSAIG DEL MAPA D'IMPOSICI&Oacute; &lt;&lt;&lt;</span>";
//   echo "<br><br><div w3-include-html='" . $baseurlMAPA . $PDFunic . ".html' style='color:#999999;font-family:monospace;font-size:24px'></div>";
   echo "<br><br><iframe src='" . $baseurlMAPA . $PDFunic . ".html'  height='100%' width='75%' title='' style='border:none' ></iframe>";
   exit("<br><p><br><p><span style='color:#0000ff;font-family:monospace;font-size:24px'><a style='color:#0000ff;font-family:monospace;font-size:18px' href='$baseURL'>Si torneu enrera per aquest vincle perdereu les opcions de men&uacute; triades, si ho feu amb el bot&oacute; del navegador les conservareu</a></span><br><p><br></center>");
  }
  else
  {
// forcem la descàrrega d'un PDF
//header('Content-type: application/pdf, text/html');
// nom del pdf per anomenar i desar
//header('Content-Disposition: attachment; filename=Fatarella18_ca.pdf');
// url
//readfile('http://femfum.com/OnEtsOncleGuillem/Fatarella18_ca.pdf');

  // forcem l'obertura del pdf a la mateixa finestra
  // header("Location:" . $baseurlPDF . $pdfnomes);  // no li agrada a SomNuvol !

// això és com un alert però més controlat per tal de redirigir un resultat cap a on es vulgui
	  $pr0mpt = rtrim($prompt);
// què caracu es desa quan llistem l'stack del ps?
//var_dump($pr0mpt);
//exit('  <<<< COMPINTA?');

	 // exit("QUEFA? ".$pr0mpt);
	  $pr1mpt = ltrim($pr0mpt);
 // exit($prompt);
 // echo "<script>alert('" . "$pr0mpt" . "');</script>";

	  // assagem via recodificat?
	  //$pr3mpt = mb_convert_encoding($prompt, "ISO-8859-1", "auto");
	  //echo mb_internal_encoding($prompt);

// si cancel·lem ens en anem aquí * i si fem OK anem el PDF que s'ha generat amb un nom únic
echo "<script>if (window.confirm('" . $pr0mpt . "')) {window.location.href='$baseurlPDF$pdfnomes';};</script>";


//@RIMDAUB * aquí és on ens en anem si cancel·lem
// si pot ser útil fer una captura de la URL aquí tenim el mètode, però:
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
// tenint en compte de si s'afegeixen dues barres // al principi de l'adreça (en localhost passa) que cal eliminar si volem que la URL sigui útil
// tenint en compte també que la notació d'aquesta string segueix la pauta de p.e. esciure els espais en blanc com a %20 (el seu valor hexa)
echo($url);

// aquí potser caldria fer un breu resum de la sintaxi, en comptes de posar cap enllaç a enlloc

//   echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; <a href='$baseurlPDF$pdfnomes'>ENLLA&Ccedil; AL PDF RESULTANT</a> &lt;&lt;&lt;</span>";

          //echo '<script type="text/javascript">window.open("http://localhost/www.pliegos.net/maker/'.$pdfnomes.'");</script>';
//@RIMDAUB localhost
//         echo "<script type='text/javascript'>window.location($baseurlPDF$pdfnomes);</script>";

//           $txerKB = ceil(filesize($pdfFile)/1024);  // si necessitem mesurar el fitxer de sortida
//   echo("<br><p><br><p><span style='color:#0000ff;font-family:monospace;font-size:24px'><a style='color:#0000ff;font-family:monospace;font-size:18px' href='$baseURL'>Torneu</a></span><br><p><br></center>");

  }

// esborrem tots els fitxers del directori pdfs que tinguin més de 24 hores
  $path="pdfs";
  if (is_dir("$path") )
  {
   $manegal=opendir($path);
   while (false!==($file = readdir($manegal)))
   {
    if ($file != "." && $file != "..")
    {
     $Diff = (time() - filectime("$path/$file"))/60/60/24;
     if ($Diff > 1) unlink("$path/$file");
    }
   }
   closedir($manegal);
  }

 }
 else
 { // podem provocar errors executant sense interfície amb només comandes via URL (captura GET)

//@RIMDAUB en el cas que manqui o hi hagi un error al nom del directori de sortida /pdfs o el fitxer .ps a interpretar no tingui prous permisos, genera un valor de 1!


  // aquí llistem l'ERROR del prompt i demanem que s'enviï
  echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; ERROR d'execuci&oacute; de l'algorisme &lt;&lt;&lt;</span>";
  echo "<br><br><span style='color:#999999;font-family:monospace;font-size:24px'>".$prompt." + ".$ElQtorna."<br></span>";
//@RIMDAUB localhost
  exit("<br><p><br><p><span style='color:#ff0000;font-family:monospace;font-size:24px'><a style='color:#ff0000;font-family:monospace;font-size:24px' href='mailto:marcantoni.malagarriga.picas@ub.edu'>podeu documentar-nos l'error via email? (copieu i enganxeu el text en gris) gr&agrave;cies!</a><br><br><a style='color:#ff0000;font-family:monospace;font-size:18px' href='$baseURL'>Torneu a executar</a></span></center>");
 }

 echo "</body></html>";
}


?>
