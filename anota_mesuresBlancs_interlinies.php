<?php

  // adreça absoluta al directori dels PDFs resultants
  //$somaPDF = "/var/www/html/www.ub.edu/tallerdetipografia/caixista/pdfs/re.pdf";  // localhost Tuxedo
  $somaPDF = "/wub/tallerdetipografia/caixista/pdfs/re.pdf";  // al servidor ub.edu/tallerdetipografia
  // $somaGS = "/usr/bin/";  // path a l'executable de Ghostscript al localhost de Tuxedo
  $somaGS = "/usr/local/bin/";  // path a l'executable de Ghostscript al servidor ub.edu/tallerdetipografia
  $PSapplet = "mesuresBlancs_interlinies_prompt.ps";
  //
  // @EP aquesta pel gs 9.55 localhost de Tuxedo
  $command = $somaGS . "gs -q -dNOSAFER -o '" . $somaPDF . "' -sDEVICE=pdfwrite -f '" . $PSapplet . "'";

  // si posem </pre> ens llistarà els missatges respectant la sintaxi que ve del PS
  // anotem el contingut de la taula d'interlínies en format PS
  echo "<center><span style='color:#ff0000;font-family:monospace;font-size:24px'><br><br>&gt;&gt;&gt; Taula de Mesures de Blancs d'Interl&iacute;nies &lt;&lt;&lt;</span></center>";
  //echo "<br><br><span style='color:#999999;font-family:monospace;font-size:24px'>".$prompt." + ".$ElQtorna."<br></span></center>";

   echo "<pre style='color:#999999;font-family:monospace;font-size:24px;padding-left: 2em'>";
   // mètode normal de llistat del prompt
   $LaDarrera = system($command, $ElQtorna);

   echo "<br><center style='color:#000000;font-family:monospace;font-size:16px'>L'&iacute;ndex zero del primer array indica les unitats /p (punts), la resta d'&iacute;ndex indiquen el valor del cos<br>Les subarrays de cadascun dels cossos duen tamb&eacute; a l'&iacute;ndex zero les unitats /c (c&iacute;ceros) i la resta de valors s&oacute;n les mesures d'amplada de cada pe&ccedil;a</center><br></pre>";

   //exit("- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -");

?>
