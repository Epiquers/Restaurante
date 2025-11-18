<?php
  require_once('vendor/autoload.php');

    $mpdf= new \Mpdf\Mpdf([


    ]);

      $mpdf->writeHtml("<p>Hola mundo</p>", \Mpdf\HTMLParserMode::HTML_BODY);
      $mpdf->Output();
?>