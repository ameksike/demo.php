<?php
//============================================================+
// File name   : example_009.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 009 for TCPDF class
//               Test Image
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Test Image
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
//$pdf->SetTitle('TCPDF Example 009');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
//
//// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
//
//// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
//if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//	require_once(dirname(__FILE__).'/lang/eng.php');
//	$pdf->setLanguageArray($l);
//}

// -------------------------------------------------------------------

// add a page
$pdf->setPrintHeader(false); //no imprime la cabecera ni la linea
    $pdf->setPrintFooter(false);
$pdf->AddPage();

// set JPEG quality
//$pdf->setJPEGQuality(75);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Example of Image from data stream ('PHP rules')
$imgdata = base64_decode('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');
$imgdata = '@'.$imgdata;
// The '@' character is used to indicate that follows an image data stream and not an image file name
$pdf->Image($imgdata,15, 15, 15, 15);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Image example with resizing
//$pdf->Image('images/image_demo.jpg', 15, 140, 75, 113, "", 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// test fitbox with all alignment combinations

//$horizontal_alignments = array('L', 'C', 'R');
//$vertical_alignments = array('T', 'M', 'B');
//
//$x = 15;
//$y = 35;
//$w = 30;
//$h = 30;
//// test all combinations of alignments
//for ($i = 0; $i < 3; ++$i) {
//	$fitbox = $horizontal_alignments[$i].' ';
//	$x = 15;
//	for ($j = 0; $j < 3; ++$j) {
//		$fitbox[1] = $vertical_alignments[$j];
//		$pdf->Rect($x, $y, $w, $h, 'F', array(), array(128,255,128));
//		$pdf->Image('images/image_demo.jpg', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
//		$x += 32; // new column
//	}
//	$y += 32; // new row
//}
//
//$x = 115;
//$y = 35;
//$w = 25;
//$h = 50;
//for ($i = 0; $i < 3; ++$i) {
//	$fitbox = $horizontal_alignments[$i].' ';
//	$x = 115;
//	for ($j = 0; $j < 3; ++$j) {
//		$fitbox[1] = $vertical_alignments[$j];
//		$pdf->Rect($x, $y, $w, $h, 'F', array(), array(128,255,255));
//		$pdf->Image('images/image_demo.jpg', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
//		$x += 27; // new column
//	}
//	$y += 52; // new row
//}
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// Stretching, position and alignment example
//
//$pdf->SetXY(110, 200);

//$pdf->Image('images/image_demo.jpg', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
//$pdf->Image('images/img.png', 51, '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);

//$pdf->Image('images/logo_example.jpg', 100, '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
//$pdf->Image('images/image_demo.jpg', 150, '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);


// -------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_009.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
