<?php

require_once('reporte.class.php');

require_once 'C:/xampp/htdocs/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


$id_evento = null;
$accion = null;
if (isset($_GET['accion'])) {
    $id_evento = isset($_GET['id_evento']) ? $_GET['id_evento'] : null;
    $accion = $_GET['accion'];
}


switch ($accion) {
    case 'lista':
        $reporte -> lista($id_evento);
        $content = ob_get_contents();
       // $content = 'panel/views/reporte/lista.php';
        break;

   

    default:
        $content = "nada";
        
}
$html2pdf = new Html2Pdf('P', 'A4', 'fr');
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content);
ob_end_clean();
$html2pdf->output('example00.pdf');

?>