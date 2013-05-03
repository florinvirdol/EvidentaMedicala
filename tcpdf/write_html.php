<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2010-11-20
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

require_once('config/lang/eng.php');
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Autor');
$pdf->SetTitle('Model adresa');
$pdf->SetSubject('Model adresa');
$pdf->SetKeywords('Model adresa');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 14);

// add a page
$pdf->AddPage();

// create some HTML content
$html = '<p>Către,</p>
<h5><em>INSPECTORATUL GENERAL AL POLIȚIEI ROM&Acirc;NE</em></h5>
<p><em>Domnului chestor şef de poliţie Petre TOBĂ&nbsp; &ndash;Inspector General</em></p>
<p>&nbsp;</p>
<p>&Icirc;n vederea raportării măsurilor cu privire la implementarea sistemelor și serviciilor la nivel național, vă adresăm rugămintea de a ne transmite stadiul implementării detaliat pe fiecare fază parcursă pentru următoarele proiecte:</p>
<p>- &nbsp; Sistem Informatic Integrat pentru Suport Decizional şi Organizaţional privind Dezvoltarea Capacităţii Administrative a Inspectoratului General al Poliţiei Rom&acirc;ne (SIISDODCA);</p>
<p>- &nbsp; Proiectul ROCRIS.</p>
<p>Totdată, vă rugăm să ne comunicați dacă implementarea proiectelor a condus la modificări legislative pentru domeniile de activitate aferente proiectelor (spre exemplu, informatizarea sistemului de emitere a cazierului judiciar a indus modificări legislative &icirc;n sensul implementării sistemului de &icirc;nregistrare electronică a cererilor de eliberare cazier prin autentificare şi semnare electronică cu certificate digitale calificate, așa cum a fost solicitat &icirc;n documentația de atribuire).</p>
<p><em>&nbsp;</em></p>
<p><em>Cu deosebită stimă,</em></p>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+