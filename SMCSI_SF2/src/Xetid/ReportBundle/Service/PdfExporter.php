<?php
/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		05/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
namespace Xetid\ReportBundle\Service;
use Symfony\Component\HttpFoundation\Response;
class PdfExporter implements ExporterInterface {

	public function __construct(){
		$path = __DIR__.'/../Vendor/tcpdf';
		require_once("{$path}/config/tcpdf_config.php");
		require_once("{$path}/tcpdf.php");
	}
    /**
     * Returns the exporter Manager
     * @param string $title
     * @param string $author
     * @param string $subject
     * @param string $keywords
     * @return mixed
     */
    public function driver($title = 'XETID', $author = 'XETID', $subject = 'Reports', $keywords = 'XETID, PDF, booking, invoice, guide')
    {
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($author);
        $pdf->SetTitle($title);
        $pdf->SetSubject($subject);
        $pdf->SetKeywords($keywords);

/*
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING, array(0,0,0), array(0,0,0));
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
*/
        $pdf->setFooterData(array(0,0,0), array(0,0,0));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 9, '', true);
        //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        return $pdf;
    }
    /**
     * Returns the View
     * @param $view
     * @param string $title
     * @return Response
     */
    public function export($view, $title = 'Report')
    {
        $pdf = $this->driver($title);
        $html = $view->getContent();
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $pdf->Output('tmp.pdf', 'I');
        $response = new Response('');
        $response->headers->set('Content-Type', 'application/pdf');
        return $response;
    }
}
