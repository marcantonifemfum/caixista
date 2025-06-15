<?php

//$pr0mpt = "\\n\\n[#13] ERROR EN EL VALOR DE L\'AMPLE D\'UNA PEÇA DE LA VARIABLE &reng=\\n\\n>> l\'ample de la peça… /imposicio [ 6 c 96 p p g ]";
       
//	…no existeix a la taula d\'amples del cos… 96\n\n[#18] LA COMPOSICIÓ DE LES PECES DEL &reng= NO ARRIBA A L\'AMPLE DE LA VARIABLE &mesura=\n\n>> la línia de composició &mesura=\n6 punts Didot (0 cíceros amb 6 punts)\n2.2554 mm\n6.39326 punts de Pica PS\n\n>> sumades les mesures de totes les peces del &reng=\n0 punts Didot (0 cíceros)\n0.0 mm\n0 punts de Pica PS\n\n>> hi manca encara:\n6.00002 punts Didot (0 cíceros amb 6.00002 punts)\n2.25541 mm\n6.39326 punts de Pica PS\n\n>> el màxim llindar d\'error permès, és de:\n0.938491 punts Didot (0.0782076 cíceros)\n0.352779 mm\n1 punts de Pica PS\n\n\n________________________T E N I U E R R O R S________________________\n\nSi prems… [ Cancel·la ] …et mantindràs en aquesta mateixa pàgina en blanc\n\nSi prems… [ D\'acord ] …s\'obrirà un PDF amb els errors transcrits en una nova pestanya del navegador";

$pr0mpt = "(13) \\n\\n[#13] ERROR EN EL VALOR DE L\'AMPLE D\'UNA PEÇA DE LA VARIABLE &reng=\\n\\n>> l\'ample de la peça… /imposicio [ 6 c 96 p p g ] …no existeix a la taula d\'amples del cos… 96\\n\\n[#18] LA COMPOSICIÓ DE LES PECES DEL &reng= NO ARRIBA A L\'AMPLE DE LA VARIABLE &mesura=\\n\\n>> la línia de composició &mesura=\\n6 punts Didot (0 cíceros amb 6 punts)\\n2.2554 mm\\n6.39326 punts de Pica PS\\n\\n>> sumades les mesures de totes les peces del &reng=\\n0 punts Didot (0 cíceros)\\n0.0 mm\\n0 punts de Pica PS\\n\\n>> hi manca encara:\\n6.00002 punts Didot (0 cíceros amb 6.00002 punts)\\n2.25541 mm\\n6.39326 punts de Pica PS\\n\\n>> el màxim llindar d\'error permès, és de:\\n0.938491 punts Didot (0.0782076 cíceros)\\n0.352779 mm\\n1 punts de Pica PS\\n\\n\\n________________________T E N I U E R R O R S________________________\\n\\nSi prems… [ Cancel·la ] …et mantindràs en aquesta mateixa pàgina en blanc\\n\\nSi prems… [ D\'acord ] …s\'obrirà un PDF amb els errors transcrits en una nova pestanya del navegador";

         // exit("QUEFA? ".$pr0mpt);
         //$pr1mpt = ltrim($pr0mpt);  // ltrim sembla que no li cal
         
 // exit($prompt);
 // echo "<script>alert('" . "$pr0mpt" . "');</script>";
          
          // assagem via recodificat?
          //$pr3mpt = mb_convert_encoding($prompt, "ISO-8859-1", "auto");
          //echo mb_internal_encoding($prompt);

// si cancel·lem ens en anem aquí * i si fem OK anem cap al PDF que s'ha generat amb un nom únic
echo "<script>if (window.confirm('" . $pr0mpt . "')) {window.location.href='';};</script>";



?>
