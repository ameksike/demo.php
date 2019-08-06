<?php

namespace Xetid\ServidorImpresionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Xetid\ServidorImpresionBundle\Utils\Utils;

/**
 * Controlador utilizado para gestionar las acciones
 *
 * @package Xetid\ServidorImpresionBundle\Controller
 *
 * @author Jose M. Zaldivar
 * @version 1.0.1
 */
class AdministrationController extends Controller
{
    /**
     * Acción que renderiza la vista
     *
     * @return Response
     *
     * @author Jose M. Zaldivar
     * @version 1.0.1
     */
    public function renderAction()
    {
        $dirApp = $this->get('kernel')->getRootDir();
        $arrays = Utils::getConfigCups($dirApp);
        $dirCups = $arrays['dirCups'];
        $dirHelp = $arrays['dirHelp'];
        return $this->render('ServidorImpresionBundle:Default:logger.html.twig', array('dirCups' => $dirCups,
            'dirHelp' => $dirHelp));
    }

    /**
     * Acción que adiciona una impresora
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function addPrinterAction()
    {
        Utils::addPrinter();
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que adiciona un grupo de usuarios
     *
     * @param string group Nombre del grupo
     * @param string descrip Descripción del grupo de usuarios
     * @param array una o varias impresoras con su cuota de papel para el grupo
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function addGroupsAction()
    {
        $request = $this->get('request');
        $group = str_replace(" ", "#", $request->request->get('tfuserCuota'));
        $descrip = $request->request->get('taDescrip');
        $data = $request->request->get('data');
        $em = $this->getDoctrine()->getManager();
        $g = $em->getRepository("ServidorImpresionBundle:Groups")->findGroupsByName($group);
        if (count($g) == 0) {
            $array = json_decode($data);
            if (count($array) > 0) {
                $var = "\"";
                $description = $var . $descrip . $var;
                $comando = "sudo pkusers --add --groups --description " . $description . " " . $group;
                shell_exec($comando);

                foreach ($array as $key => $valor) {
                    $printer = $valor->printername;
                    $quota = $valor->cuota;
                    if ($quota != 0) {
                        if ($quota > 10) {
                            $quotaw = $quota - 10;
                        } else {
                            $quotaw = $quota - 1;
                        }
                        $valorq = "-S " . $quotaw . " -H " . $quota;
                        $comando = "sudo edpykota --add --printer " . $printer . " -g " . $valorq . " " . $group;
                        shell_exec($comando);
                    }
                }
            } else {
                $var = "\"";
                $description = $var . $descrip . $var;
                $comando = "sudo pkusers --add --groups --description " . $description . " " . $group;
                shell_exec($comando);
            }
            return new Response(json_encode(array('success' => true,
                                                  'msg' => "El Grupo ha sido adicionado satisfactoriamente")));
        } else {
            return new Response(json_encode(array('failure' => true,
                                                  'msg' => "El grupo que deseas adicionar ya existe")));
        }
    }

    /**
     * Acción que adiciona un usuario
     *
     * @param string users Nombre del usuario
     * @param string descrip Descripción del usuario (Nombre y Apellidos)
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function addUsersAction()
    {
        $request = $this->get('request');
        $users = $request->request->get('user');
        $descrip = $request->request->get('descrip');
        $em = $this->getDoctrine()->getManager();
        $u = $em->getRepository("ServidorImpresionBundle:Users")->findUserssByName($users);
        if (count($u) == 0) {
            $var = "\"";
            $description = $var . $descrip . $var;
            $comando = "sudo pkusers --add --skipexisting --description " . $description . " " . $users;
            shell_exec($comando);
            return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
        } else {
            return new Response(json_encode(array('success' => true, 'msg' => "El usuario ya existe")));
        }
    }

    /**
     * Acción que adiciona un usuario a un grupo
     *
     * @param string user Nombre del usuario
     * @param string groupName Nombre del grupo al que será asignado
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function addUserToGroupsAction()
    {
        $request = $this->get('request');
        $user = $request->request->get('name');
        $groupName = $request->request->get('nameParent');
        $em = $this->getDoctrine()->getManager();
        $quotas = $em->getRepository("ServidorImpresionBundle:Groups")->findQuotasGroups($groupName);

        $array = array();
        foreach ($quotas as $q) {
            array_push($array, $q['printerid']['printername']);
        }
        $cant = count($array);
        if ($cant > 0) {
            $comandoAdd = "sudo pkusers --ingroups " . $groupName . " " . $user;
            shell_exec($comandoAdd);
            foreach ($array as $ipm) {
                $comando1 = "sudo edpykota --add --printer " . $ipm . " --noquota " . $user;
                $comando = "sudo edpykota --add --printer " . $ipm . " " . $user;
                shell_exec($comando1);
                shell_exec($comando);
            }
        } else {
            $comandoAdd = "sudo pkusers --ingroups " . $groupName . " " . $user;
            shell_exec($comandoAdd);
        }
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que elimina a un usuario de un grupo
     *
     * @param string user Nombre del usuario
     * @param string groupName Nombre del grupo al que pertenece el usuario
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function deleteUserFromGroupsAction()
    {
        $request = $this->get('request');
        $user = $request->request->get('name');
        $groupName = $request->request->get('nameParent');
        $em = $this->getDoctrine()->getManager();
        $quotas = $em->getRepository("ServidorImpresionBundle:Groups")->findQuotasGroups($groupName);
        $array = array();
        foreach ($quotas as $q) {
            array_push($array, $q['printerid']['printername']);
        }
        $cant = count($array);
        if ($cant > 0) {
            $comandoDel = "sudo pkusers --ingroups " . $groupName . " --remove " . $user;
            shell_exec($comandoDel);
            foreach ($array as $ipm) {
                $comando = "sudo edpykota --printer " . $ipm . " -S 0 -H 0 " . $user;
                shell_exec($comando);
            }
        } else {
            $comandoDel = "sudo pkusers --ingroups " . $groupName . " --remove " . $user;
            shell_exec($comandoDel);
        }
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que elimina un grupo de usuarios
     *
     * @param string groupName Nombre del grupo
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function deleteGroupsAction()
    {
        $request = $this->get('request');
        $groupName = str_replace(" ", "#", $request->request->get('name'));
        $node = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $grupo = $em->getRepository('ServidorImpresionBundle:Groups')->findUersbyIdGroup($node);
        if (is_array($grupo) && count($grupo) > 0) {
            $usersInGroups = Utils::userInGroups($grupo);
            $quotas = $em->getRepository("ServidorImpresionBundle:Groups")->findQuotasGroups($groupName);
            if (count($quotas) > 0) {
                $arrayPrinter = array();
                foreach ($quotas as $q) {
                    array_push($arrayPrinter, $q['printerid']['printername']);
                }
                foreach ($arrayPrinter as $a) {
                    foreach ($usersInGroups as $users) {
                        $comandodisableusersq = "sudo edpykota --printer " . $a . " -S 0 -H 0 " . $users;
                        shell_exec($comandodisableusersq);
                    }
                }
                Utils::deleteGroup($groupName);
            } else {
                Utils::deleteGroup($groupName);
            }
        } else {
            Utils::deleteGroup($groupName);
        }
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que elimina un usuario
     *
     * @param string user Nombre de usuario a eliminar
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function deleteUsersAction()
    {
        $request = $this->get('request');
        $user = $request->request->get('arrayNomb');
        $username = json_decode($user);
        if (is_array($username) && count($username) > 0) {
            foreach ($username as $u) {
                $comandodel = "sudo pkusers --delete " . $u;
                shell_exec($comandodel);
            }
        }
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que adiciona un grupo de impresoras
     *
     * @param string groupPrinterName Nombre del grupo de impresoras
     * @param string descrip Descripción del grupo de impresoras
     * @param int id Id del grupode impresoras a modificar
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function addGroupPrinterAction()
    {
        $request = $this->get('request');
        $groupPrinterName = str_replace(' ', '#', $request->request->get('user'));
        $descrip = $request->request->get('descrip');
        $id = $request->request->get('id');
        $em = $this->getDoctrine()
            ->getManager();
        if (!is_null($id)) {
            /*Modificar Grupo*/
            $result = $em->getRepository('ServidorImpresionBundle:Printers')->updateGroupPrinter($id,
                $groupPrinterName, $descrip);

            return new Response(json_encode(array('success' => $result, 'msg' => "Exitos")));
        } else {
            $var = "\"";
            $description = $var . $descrip . $var;
            $comando = "sudo pkprinters --add --description " . $description . " " . $groupPrinterName;
            shell_exec($comando);
            $ciudad = $em->getRepository('ServidorImpresionBundle:Printers')
                ->findOneByPrintername($groupPrinterName);
            $ciudad->setIsgroups('TRUE');
            $em->persist($ciudad);
            $em->flush();

            return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
        }

        /*
         * return new Response(json_encode(array('failure'=>true, 'msg'=>"Exitos")));
         * */
    }

    /**
     * Acción que adiciona una impresora a un grupo de impresoras
     *
     * @param string printer Nombre de la impresora
     * @param string groupName Nombre del grupo de impresoras
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function addPrinterToGroupsAction()
    {
        $request = $this->get('request');
        $printer = $request->request->get('name');
        $groupName = $request->request->get('nameParent');
        $comando = "sudo pkprinters --groups " . $groupName . " " . $printer;
        shell_exec($comando);
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que elimina una impresora de un grupo de impresoras
     *
     * @param string printer Nombre de la impresora
     * @param string groupName Nombre del grupo de impresoras
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function deletePrinterFromGroupsAction()
    {
        $request = $this->get('request');
        $printer = $request->request->get('name');
        $groupName = $request->request->get('nameParent');
        $comando = "sudo pkprinters --groups " . $groupName . " --remove " . $printer;
        shell_exec($comando);
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que modifica una impresora
     *
     * @param array data Una o varias impresoras con los datos modificados
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function modPrinterAction()
    {
        $request = $this->get('request');
        $data = $request->request->get('data');
        $array = json_decode($data);
        $var = "\"";
        foreach ($array as $key => $valor) {
            $printer = $valor->printername;
            $description = $valor->description;
            $precioporpagina = $valor->priceperpage;
            $precioportrabajo = $valor->priceperjob;
            $maxnumeropaginas = $valor->maxjobsize;
            $descript = $var . $description . $var;
            $comando = "sudo pkprinters --description " . $descript . " --charge " . $precioporpagina . "," . $precioportrabajo . " --maxjobsize " . $maxnumeropaginas . " " . $printer;
            shell_exec($comando);
        }
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }


    /**
     * Acción que elimina un grupo de impresoras
     *
     * @param string groupName Nombre del grupo de impresoras
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function deletePrinterGroupAction()
    {
        $request = $this->get('request');
        $groupName = str_replace(" ", "#", $request->request->get('name'));
        $comando = "sudo pkprinters --delete " . $groupName;
        shell_exec($comando);
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que elimina una impresoras
     *
     * @param string printerName Nombre de la impresora a eliminar
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function deletePrinter()
    {
        $request = $this->get('request');
        $printerName = $request->request->get('name');
        $comando = "sudo pkcupsdel " . $printerName;
        shell_exec($comando);
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que modifica un grupo de usuarios y establece una cuota de papel con una o varias impresoras
     *
     * @param string groupName Nombre del grupo de usuarios
     * @param string descrip Descripción del grupo de usuarios
     * @param array data Listado de impresoras y cantidad de papel para establecer cuotas en el grupo
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function modGroupsAction()
    {
        $request = $this->get('request');
        $groupName = $request->request->get('tfuserCuota');
        $descrip = $request->request->get('taDescrip');
        $data = $request->request->get('data');
        $node = $request->request->get('idG');
        $var = "\"";
        $description = $var . $descrip . $var;
        $comdesc = "sudo pkusers --groups --description " . $description . " " . $groupName;
        shell_exec($comdesc);
        $arrayPrinterNew = json_decode($data);
        $em = $this->getDoctrine()->getManager();
        $grupo = $em->getRepository('ServidorImpresionBundle:Groups')->findUersbyIdGroup($node);
        $printersQuotas = $em->getRepository("ServidorImpresionBundle:Groups")->findQuotasGroups($groupName);
        $arrayPrintersExist = array();
        if (count($printersQuotas) > 0) {
            foreach ($printersQuotas as $q) {
                array_push($arrayPrintersExist, $q['printerid']['printername']);
            }
            if (count($arrayPrinterNew) > 0) {
                $arrayPrinterComp = array();
                foreach ($arrayPrinterNew as $key => $valor) {
                    $printer = $valor->printername;
                    array_push($arrayPrinterComp, $printer);
                }
                $arrayDisabledQuota = array_diff($arrayPrintersExist, $arrayPrinterComp);
                if (count($arrayDisabledQuota) > 0) {
                    $arrysUser = Utils::userInGroups($grupo);
                    foreach ($arrayDisabledQuota as $a) {
                        $comandoDisable = "sudo edpykota --printer " . $a . " -g -S 0 -H 0 " . $groupName;
                        shell_exec($comandoDisable);
                        if (count($arrysUser) > 0) {
                            foreach ($arrysUser as $u) {
                                $comandoDisableUsersq = "sudo edpykota --printer " . $a . " -S 0 -H 0 " . $u;
                                shell_exec($comandoDisableUsersq);
                            }
                        }
                    }
                }
                Utils::groupPrinterQuota($arrayPrinterNew, $groupName, $grupo);
            } else {
                $arrysUser = Utils::userInGroups($grupo);
                foreach ($arrayPrintersExist as $a) {
                    $comandoDisable = "sudo edpykota --printer " . $a . " -g -S 0 -H 0 " . $groupName;
                    shell_exec($comandoDisable);
                    if (count($arrysUser) > 0) {
                        foreach ($arrysUser as $u) {
                            $comandoDisableUsersq = "sudo edpykota --printer " . $a . " -S 0 -H 0 " . $u;
                            shell_exec($comandoDisableUsersq);
                        }
                    }
                }
            }
        } else {
            if (count($arrayPrinterNew) > 0) {
                Utils::groupPrinterQuota($arrayPrinterNew, $groupName, $grupo);
            }
        }
        return new Response(json_encode(array('success' => true, 'msg' => "El (Los) cambio(s) se han guardado satisfactoriamente.")));
    }


    /**
     * Acción que lista los usuarios
     *
     * @param int start Número de páginas del listado
     * @param int limit Límite de registros de cada página
     * @param string Filtre Filtro empleado para listar los usuarios
     * @return Response
     *
     * @author Jose M. Zaldivar
     * @version 1.0.1
     */
    public function getUsersAction()
    {
        $request = $this->get('request');
        $limit = $request->query->get('limit');
        $start = $request->query->get('start');
        $filtre = $request->query->get('filtre');
        $em = $this->getDoctrine()->getManager();
        // $users = $em->getRepository("ServidorImpresionBundle:Users")->findUserNotGroup($start,$limit);
        $users = $em->getRepository("ServidorImpresionBundle:Users")
            ->findAllUser($start, $limit, $filtre);
        $arrays = array();
        foreach ($users['data'] as $key => $user) {
            $total = $em->getRepository("ServidorImpresionBundle:Jobhistory")
                ->getGastoTotalByUser($user['id']);
            $groupName = $em->getRepository("ServidorImpresionBundle:Groups")
                ->findGrupoByUser($user['id']);
            $tmp = array(
                'text' => $user['username'],
                'leaf' => true,
                'id' => $user['id'],
                'username' => $user['username'],
                'description' => $user['description'],
                'overcharge' => $user['overcharge'],
                'lifetimepaid' => (!is_null($total)) ? $total : 0,
                'groupname' => (!is_null($groupName)) ? $groupName : "",
                'isgroup' => (!is_null($groupName)) ? true : false,
            );
            array_push($arrays, $tmp);
        }
        return new Response(json_encode(array('data' => $arrays, 'data_count' => $users['data_count'])));
    }

    /**
     * Acción que lista las impresoras
     *
     * @param int número de páginas del listado
     * @param int límite de registros de cada página
     * @param string filtre Filtro empleado para listar las impresoras
     * @return Response
     *
     * @author José M. Zaldivar
     * @version 1.0.1
     */
    public function getPrintersAction()
    {
        $request = $this->get('request');
        $limit = $request->query->get('limit');
        $start = $request->query->get('start');
        $filtre = $request->query->get('filtre');
        $em = $this->getDoctrine()->getManager();
        /* $not_group_printer = $em->getRepository('ServidorImpresionBundle:Printers')->findPrinterNotGroup($start,
             $limit);*/
        $not_group_printer = $em->getRepository('ServidorImpresionBundle:Printers')->findAllPrinters($start, $limit,
            $filtre);
        $arrays = array();
        foreach ($not_group_printer['data'] as $printer) {
            $namegroup = $em->getRepository('ServidorImpresionBundle:Printers')
                ->findGrupoNameByIdPrinter($printer['id']);
            array_push($arrays, array(
                'id' => $printer['id'],
                'text' => $printer['printername'],
                'leaf' => true,
                'printername' => $printer['printername'],
                'description' => $printer['description'],
                'priceperpage' => $printer['priceperpage'],
                'priceperjob' => $printer['priceperjob'],
                'maxjobsize' => $printer['maxjobsize'],
                'groupname' => (!is_null($namegroup)) ? $namegroup : "",
                'isgroup' => (!is_null($namegroup)) ? true : false,
            ));
        }
        return new Response(json_encode(array('data' => $arrays, 'data_count' => $not_group_printer['data_count'])));
    }

    /**
     * Acción que lista las cuotas papel total y consumida de un grupo de usuarios con una o varias impresoras
     *
     * @param int número de páginas del listado
     * @param int límite de registros de cada página
     * @param int idGrupo Id del grupo de usuarios
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function getQuotaAndConsumoAction()
    {
        $request = $this->get('request');
        $limit = $request->query->get('limit');
        $start = $request->query->get('start');
        $idGrupo = $request->query->get('idgrupo');
        $em = $this->getDoctrine()
            ->getManager();
        $datos = $em->getRepository('ServidorImpresionBundle:Groups')
            ->findQuotaAndGastoForPrinterByGrupo($idGrupo, $start, $limit);

        $counts = $em->getRepository('ServidorImpresionBundle:Groups')
            ->findQuotaAndGastoForPrinterByGrupo($idGrupo);

        return new Response(json_encode(array('data' => $datos, 'data_count' => count($counts))));

    }

    /**
     * Acción que modifica uno o varios usuarios
     *
     * @param array data uno o varios usuarios con los datos a modificar
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function modUsersAction()
    {
        $request = $this->get('request');
        $data = $request->request->get('data');
        $arrays = json_decode($data, true);
        $em = $this->getDoctrine()
            ->getManager();

        foreach ($arrays as $user) {
            $em->getRepository("ServidorImpresionBundle:Users")
                ->updateUser($user);
        }
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que resetea la cuota usada por un grupo de usuarios
     *
     * @param string nameGroup Nombre del grupo
     * @param string namePrinter Nombre de la impresora
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function resetAction()
    {
        $request = $this->get('request');
        $nameGroup = $request->request->get('nameGroup');
        $namePrinter = $request->request->get('namePrinter');
        $comando = "sudo edpykota --printer " . $namePrinter . " --reset -g " . $nameGroup;
        shell_exec($comando);
        return new Response();
    }

    /**
     * Acción que prepara el sistema para modificar una impresora a través de CUPS
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function preparaParaModificarAction()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $comando = "sudo pkutil --allow " . $ip;
        shell_exec($comando);
        shell_exec("sudo pkutil -d");
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que modifica una impresora a través de CUPS
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function modPrinterByCupsAction()
    {
        $dir_app = $this->get('kernel')->getRootDir();
        $dir_py = $dir_app . '/Resources/sh/printers.py';
        $cmd = "python $dir_py";
        $var = shell_exec($cmd);
        $printers = json_decode(str_replace("'", '"', trim($var)), true);

        /*  $array = explode("]",$var);
          $limite = count($array)/2;
          $array = array_slice($array, 0, $limite);
          $array1 = array();
          foreach($array as $a){
              $b = ltrim($a,", ) ");
              if($b != ""){
                  array_push($array1,$b);
              }
          }
          $array1 = implode(",", $array1);
          $array = explode(",",$array1);
          $printers = array();
          foreach($array as $a){
              $b = trim($a,"[ ( ' )");
              if($b != "printer-name" && $b != "nameWithoutLanguage"){
                  $b = trim($b," ");
                  array_push($printers, $b);
              }
          }*/
        //no borrar en algunas maq no me funciona el anterior
        /* $var = rtrim($var);

         $array = explode(",",$var);

         $printers = array();
         foreach($array as $a){
             $b = trim($a," ]['");
             if($b != ""){
                 array_push($printers,$b);
             }
         }*/

        $em = $this->getDoctrine()->getManager();
        $datos = $em->getRepository('ServidorImpresionBundle:Printers')->findAllPrinters();
        $printerPykota = array();
        foreach ($datos['data'] as $value) {
            array_push($printerPykota, $value['printername']);
        }
        $dif = array_diff($printerPykota, $printers);
        if (count($dif) > 0) {
            foreach ($dif as $value) {
                $comando = "sudo pkprinters --delete " . $value;
                shell_exec($comando);
            }
        }
        $shell = "sudo pkutil --add";
        $ip = $_SERVER['REMOTE_ADDR'];
        $comando = "sudo pkutil --deny " . $ip;
        shell_exec($comando);
        shell_exec($shell);
        shell_exec($shell);
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción que lista las direcciones ip con acceso a las impresoras
     *
     * @param int número de páginas del listado
     * @param int límite de registros de cada página
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function getIpAction()
    {
        $request = $this->get('request');
        $limit = $request->query->get('limit');
        $start = $request->query->get('start');
        $filter = $request->query->get('filter');

        $arrayIp = Utils::arrayIp();
        $newArrays = array();
        $length = ($arrayIp["data_count"] < $start + $limit) ? $arrayIp["data_count"] : $start + $limit;
        for ($i = $start; $i < $length; $i++) {
            if (isset($filter)) {
                if (strpos($arrayIp["data"][$i]['ip'], $filter) !== false) {
                    array_push($newArrays, $arrayIp["data"][$i]);
                }
            } else {
                array_push($newArrays, $arrayIp["data"][$i]);
            }

        }
        return new Response(json_encode(array("data" => $newArrays, "data_count" => $arrayIp["data_count"])));
    }

    /**
     * Acción que guarda los cambios luego de modificar una o varias dirección ip autorizada a acceder a las impresoras
     *
     * @param array una o varias direcciones ip(s) modificadas
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function saveChangesIpAction()
    {
        $request = $this->get('request');
        $data = json_decode($request->request->get('data'), true);
        $countip = 0;
        $countsubr = 0;
        foreach ($data as $ip) {
            $ipViejo = $ip['viejo'];
            $ipNuevo = $ip['nuevo'];
            if ($ip != NULL) {
                $octetos = explode(".", $ipNuevo);
                if ($octetos[count($octetos) - 1] != 0) {
                    $esta = Utils::elIpYaEsta($ipNuevo);
                    if ($esta != 1) {
                        $comando = "sudo pkutil --setip " . $ipViejo . " " . $ipNuevo;
                        shell_exec($comando);
                    } else {
                        $countip++;
                    }
                } else {
                    $subred = Utils::subRed($octetos, count($octetos) - 1);
                    $esta = Utils::laSubRedYaEsta($subred);
                    if ($esta != 1) {
                        $ipNuevo = Utils::formatSubRed($subred, "save");
                        $octectold = explode(".", $ipViejo);
                        if ($octectold[count($octectold) - 1] != 0) {
                            $comando = "sudo pkutil --dellip " . $ip;
                            shell_exec($comando);
                            Utils::buscaEliminaIpEnSubRed($subred);
                            $comando = "sudo pkutil --addip " . $ipNuevo;
                            shell_exec($comando);
                        } else {
                            $subredold = Utils::subRed($octectold, count($octectold) - 1);
                            $ipViejo = Utils::formatSubRed($subredold, "save");
                            $comando = "sudo pkutil --dellip " . $ipViejo;
                            shell_exec($comando);
                            Utils::buscaEliminaIpEnSubRed($subred);
                            $comando = "sudo pkutil --addip " . $ipNuevo;
                            shell_exec($comando);
                        }
                    } else {
                        $countsubr++;
                    }
                }
            }
        }
        if ($countip != 0 || $countsubr != 0) {
            $msg = "Uno o Varios IP/Subredes no han sido modificados por encontrarse dentro de subredes Autorizadas.";
            $cod = 2;
        } else {
            $msg = "El (Los) cambio(s) se han guardado satisfactoriamente.";
            $cod = 1;
        }
        shell_exec("sudo pkutil --cupsrestart");
        return new Response(json_encode(array('success' => true, 'msg' => $msg, "cod" => $cod)));
    }

    /**
     * Acción que elimina una o varias ip de la lista de ip(s) con acceso a las impresoras
     *
     * @param array data lista de direcciones ip a eliminar de la lista de ip(s) con acceso a las impresoras
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function deleteIpAction()
    {
        $request = $this->get('request');
        $data = json_decode($request->request->get('data'), true);
        if (is_array($data)) {
            foreach ($data as $ip) {
                $octetos = explode(".", $ip);
                if ($octetos[count($octetos) - 1] != 0) {
                    $comando = "sudo pkutil --dellip " . $ip;
                    shell_exec($comando);
                } else {
                    $subred = Utils::subRed($octetos, count($octetos) - 1);
                    $ip = Utils::formatSubRed($subred, "save");
                    $comando = "sudo pkutil --dellip " . $ip;
                    shell_exec($comando);
                }
            }
        }
        shell_exec("sudo pkutil --cupsrestart");
        return new Response(json_encode(array('success' => true, 'msg' => "El (Los) cambio(s) se han eliminado
        satisfactoriamente.")));
    }

    /**
     * Acción que adiciona una dirección ip a la lista de ip(s) con acceso a las impresoras
     *
     * @param string ip Dirección ip a adicionar
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function addIpAction()
    {
        $request = $this->get('request');
        $ip = $request->request->get('idIps');
        $octetos = explode(".", $ip);
        if ($octetos[count($octetos) - 1] != 0) {
            $esta = Utils::elIpYaEsta($ip);
            if ($esta != 1) {
                $comando = "sudo pkutil --addip " . $ip;
                shell_exec($comando);
            } else {
                return new Response(json_encode(array('failure' => true, 'msg' => "La dirección IP que deseas
                adicionar ya esta autorizada.")));
            }
        } else {
            $subred = Utils::subRed($octetos, count($octetos) - 1);
            $esta = Utils::laSubRedYaEsta($subred);
            if ($esta != 1) {
                Utils::buscaEliminaIpEnSubRed($subred);
                $ip = Utils::formatSubRed($subred, "save");
                $comando = "sudo pkutil --addip " . $ip;
                shell_exec($comando);
            } else {
                return new Response(json_encode(array('failure' => true, 'msg' => "La subred que deseas adicionar ya
                esta autorizada.")));
            }
        }
        shell_exec("sudo pkutil --cupsrestart");
        return new Response(json_encode(array('success' => true, 'msg' => "La dirección IP ha sido adicionada
        satisfactoriamente.")));
    }

    /**
     * Acción que que activa el acceso a las impresoras desde cualquier dirección ip
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function activavteAllAction()
    {
        $ipAllow = shell_exec("sudo pkutil --getip");
        $ipAllow = rtrim($ipAllow);
        $ipAllow = explode(" ", $ipAllow);
        foreach ($ipAllow as $ip) {
            $comando = "sudo pkutil --dellip " . $ip;
            shell_exec($comando);
        }
        $all = "all";
        $comando = "sudo pkutil --addip " . $all;
        shell_exec($comando);
        shell_exec("sudo pkutil --cupsrestart");
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     * Acción para saber si se autoriza el acceso a las impresoras a todas las direcciones ip o a ninguna
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function allowAllOrNotAction()
    {
        $ipAllow = shell_exec("sudo pkutil --getip");
        $ipAllow = rtrim($ipAllow);
        $ipAllow = explode(" ", $ipAllow);
        if (is_array($ipAllow) && $ipAllow[0] == "all") {
            return new Response(json_encode(array('success' => true, 'msg' => "all")));
        }
        return new Response(json_encode(array('success' => true, 'msg' => "notall")));
    }

    /**
     * Acción que deniega el acceso a tododas las direcciones ip
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function deactivateAllAction()
    {
        $comando = "sudo pkutil --dellip all";
        shell_exec($comando);
        shell_exec("sudo pkutil --cupsrestart");
        return new Response(json_encode(array('success' => true)));
    }

    /**
     *Acción que permite o deniega realizar operaciones de administración usando CUPS
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    public function allowDenyAction()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $comando = "sudo pkutil --allow " . $ip;
        shell_exec($comando);
        shell_exec("sudo pkutil --cupsrestart");
        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     *Acción que guarda información relacionada con el servidor de impresión
     *
     * @param string denominacion Denominación del servidor de impresión
     * @param string noInventario Número de inventario de la máquina
     * @param string local local donde se instala el servidor
     * @param string operario Nombre del operario del servidor de impresión
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.2
     */
    public function saveConfigSAction()
    {
        $request = $this->get('request');
        $denominacion = $request->request->get('iddenominacion');
        $noInventario = $request->request->get('idNoInventario');
        $local = $request->request->get('idlocal');
        $operario = $request->request->get('idoperario');
        $arrayParameter = array('denominacion'=>$denominacion, 'noInventario'=>$noInventario, 'local'=>$local, 'operario'=>$operario);
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('ServidorImpresionBundle:Server')->updateConfigServer($arrayParameter);

        return new Response(json_encode(array('success' => true, 'msg' => "Exitos")));
    }

    /**
     *Acción que permite cargar información relacionada con el servidor de impresión
     *
     * @return Response
     *
     * @author Adonis Fdez
     * @version 1.0.2
     */
    public function loadConfigSAction()
    {
        $em = $this->getDoctrine()->getManager();
        $serverConfig = $em->getRepository('ServidorImpresionBundle:Server')->loadConfigServer();
        $denominacion = $serverConfig[0]['denomination'];
        $noInventario = $serverConfig[0]['serialnumber'];
        $local = $serverConfig[0]['place'];
        $operario = $serverConfig[0]['supporter'];
        $serverArray = array('iddenominacion' =>$denominacion,'idNoInventario'=>$noInventario,'idlocal'=>$local,'idoperario'=>$operario);
        return new Response(json_encode(array('data' => $serverArray)));
    }

}
