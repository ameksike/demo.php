<?php

namespace Xetid\ServidorImpresionBundle\Controller;

use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Xetid\ServidorImpresionBundle\Utils\Utils;

/**
 * Class DefaultController
 * @package Xetid\ServidorImpresionBundle\Controller
 */

class DefaultController extends Controller
{
    /**
     * Función para renderizar la vista de historial
     *
     * @return Response
     *
     * @author José M, Zaldivar
     * @version 1.0.1
     */
    public function renderAction()
    {
        $dirApp = $this->get('kernel')->getRootDir();
        $arrays = Utils::getConfigCups($dirApp);
        $dirCups = $arrays['dirCups'];
        $dirHelp = $arrays['dirHelp'];
        return $this->render('ServidorImpresionBundle:Default:index.html.twig', array('dirCups' => $dirCups,
            'dirHelp' => $dirHelp));
    }

    /**
     * Función que lista las impresoras
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function getPrintersAction()
    {

        $em = $this->getDoctrine()->getManager();
        $printer_all = $em->getRepository('ServidorImpresionBundle:Printers')->findAllPrinters();
        $arrays = array();
        foreach ($printer_all['data'] as $printer) {
            $tmp = array(
                "name" => $printer['printername'],
                "id" => $printer['id']
            );
            array_push($arrays, $tmp);

        }
        return new Response(json_encode($arrays));

    }

    /**
     * Función para listar los trabajos
     *
     * @return Response
     *
     * @author José M. Zaldivar
     * @version 1.0.1
     */
    public function getJobHistoryAction()
    {
        $request = $this->get('request');

        $start = $request->query->get('start');
        $limit = $request->query->get('limit');

        $json = $request->query->get('json');
        $arrays = json_decode($json, true);

        $em = $this->getDoctrine()->getManager();

        $jobhistory = $em->getRepository('ServidorImpresionBundle:Jobhistory')->findAllJobHistory($start, $limit, $arrays);
        //var_dump($arrays);die;
        $arrays = array();
        $total = 0;
        foreach ($jobhistory['data'] as $job) {
            $action = 'Cancelado';
            switch ($job['action']) {
                case 'ALLOW':
                    $action = 'Permitido';
                    break;
                case 'DENY':
                    $action = 'Denegado';
                    break;
                case 'WARN':
                    $action = 'Advertencia';
                    break;
            }
            $idgrupo = $job['groupid'];
            $printer = $em->getRepository('ServidorImpresionBundle:Printers')->findOneById($idgrupo);
            $tmp = array(
                'id' => $job['id'],
                'user' => $job['username'],
                'name' => $job['description'],
                'idusuario' => $job['idusuario'],
                'action' => $action,
                'impresora' => $job['printername'],
                'pag' => $job['jobsize'],
                'priceperpage' => $job['priceperpage'],
                'priceperjob' => $job['priceperjob'],
                'costo' => $job['jobprice'],
                'dirip' => $job['hostname'],
                'fecha' => $job['jobdate'],
                'copy' => $job['copies'],
                'pages' => $job['pages'],
                'filename' => $job['filename'],
                'title' => $job['title'],
                'groupname' => $job['groupname'],
                'groupprinter' => $printer->getPrintername()
            );
            array_push($arrays, $tmp);
        }
        return new Response(json_encode(array('data' => $arrays, 'data_count' => $jobhistory['count'])));
    }

    /**
     * Función para listar los grupos de impresoras
     *
     * @return Response
     *
     * @author José M. Zaldivar
     * @version 1.0.1
     */
    public function getGrupoPrintersAction()
    {
        $request = $this->get('request');
        $boolean = ($request->query->get('param') === 'true') ? true : false;
        $checked = ($request->query->get('check') === 'true') ? true : false;
        $node = $request->query->get('node');
        $idGroupUser = $request->query->get('idG');
        $em = $this->getDoctrine()->getManager();

        if ($node != 'rootGPrinters' && $node != "grupoprinter") {
            $group_printer = $em->getRepository('ServidorImpresionBundle:Printers')->findPrinterByGrupo($node);
        } else {
            $group_printer = $em->getRepository('ServidorImpresionBundle:Printers')->findGroupPrinter();
        }
        $arrays = array();
        foreach ($group_printer as $grupo) {
            if (!$checked) {
                $tmp = array(
                    "idpadre" => $node,
                    "text" => str_replace("#", " ", $grupo['printername']),
                    "id" => $grupo['id'],
                    "leaf" => $boolean,
                    "printername" => str_replace("#", " ", $grupo['printername']),
                    "description" => $grupo['description']
                );
            } else {
                $quota = 0;
                if ($idGroupUser != 0) {
                    $group_quota = $em->getRepository("ServidorImpresionBundle:Grouppquota")->findGuotaByIdprinterAndIdidGrupo($idGroupUser, $grupo['id']);
                    $quota = (count($group_quota) > 0 && isset($group_quota[0]['hardlimit'])) ? $group_quota[0]['hardlimit'] : 0;
                }
                $tmp = array(
                    "idpadre" => $node,
                    "text" => str_replace("#", " ", $grupo['printername']),
                    "id" => $grupo['id'],
                    "leaf" => $boolean,
                    "printername" => str_replace("#", " ", $grupo['printername']),
                    "description" => $grupo['description'],
                    "checked" => ($quota == 0) ? false : true,
                    "cuota" => $quota
                );
            }

            array_push($arrays, $tmp);
        }

        return new Response(json_encode($arrays));
    }

    /**
     * Función parar listar los grupos de usuarios
     *
     * @return Response
     *
     * @author José M. Zaldivar
     * @version 1.0.1
     */
    public function getGroupUsersAction()
    {
        $request = $this->get('request');
        $boolean = ($request->query->get('param') === 'true') ? true : false;
        $node = $request->query->get('node');

        $em = $this->getDoctrine()->getManager();
        $array_grupos = array();
        if ($node != 'grupopuser' && $node != 'rootGusers' && !is_null($node)) {
            $grupo = $em->getRepository('ServidorImpresionBundle:Groups')->findUersbyIdGroup($node);
            if (is_array($grupo) && count($grupo) > 0) {
                $users = $grupo[0]['userid'];

                foreach ($users as $user) {
                    $array = array(
                        "text" => $user['username'],
                        "id" => $user['id'],
                        "idpadre" => $node,
                        "leaf" => $boolean,
                        "username" => $user['username'],
                        "description" => $user['description'],

                    );
                    array_push($array_grupos, $array);
                }
            }


        } else {
            $groups = $em->getRepository('ServidorImpresionBundle:Groups')->findAll();
            foreach ($groups as $grupo) {
                $array = array(
                    "text" => str_replace("#", " ", $grupo->getGroupname()),
                    "id" => $grupo->getId(),
                    "idpadre" => $node,
                    "leaf" => $boolean,
                    "description" => $grupo->getDescription(),
                    "qtip" => $grupo->getDescription()

                );
                array_push($array_grupos, $array);
            }
        }


        return new Response(json_encode($array_grupos));
    }
}
