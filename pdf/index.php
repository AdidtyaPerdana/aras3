<?php

    require_once('../pdf/tcpdf/tcpdf.php');

    $pdf = new TCPDF();

    $pdf->setPageOrientation('p', 'portrait');
    $pdf->SetFont('helvetica', '', 10);
    $pdf->AddPage();

    $pdf->Write(0, 'Hello, world!');
    $pdf->Image('path/to/image.jpg', 10, 10, 30, 30, 'JPG');
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Table Header 1', 1);
    $pdf->Cell(40, 10, 'Table Header 2', 1);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Row 1, Column 1', 1);
    $pdf->Cell(40, 10, 'Row 1, Column 2', 1);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Row 2, Column 1', 1);
    $pdf->Cell(40, 10, 'Row 2, Column 2', 1);

    $pdf->Output('output.pdf', 'D');

?>