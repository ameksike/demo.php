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
interface ExporterInterface {
    /**
     * Returns the exporter Manager
     * @param string $title
     * @param string $author
     * @param string $subject
     * @param string $keywords
     * @return mixed
     */
    public function driver($title=' ', $author='XETID', $subject='Reposts', $keywords='XETID, PDF, example, test, guide');
    /**
     * Returns the View
     * @param $view
     * @param string $title
     * @return Response
     */
    public function export($view, $title=' ');

} 
