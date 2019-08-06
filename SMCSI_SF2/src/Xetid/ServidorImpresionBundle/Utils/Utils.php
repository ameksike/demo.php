<?php
/**
 * Created by PhpStorm.
 * User: jmzaldivar
 * Date: 17/03/15
 * Time: 10:11
 */

namespace Xetid\ServidorImpresionBundle\Utils;


use Xetid\ServidorImpresionBundle\Entity\Jobhistory;
use Xetid\ServidorImpresionBundle\ServidorImpresionBundle;

/**
 * Clase con metodos complementarios
 * @package Xetid\ServidorImpresionBundle\Utils
 * @autor Jose M. Zaldivar
 * @version 1.0.1
 */

class Utils
{
    /**
     * Función que lista los trabajos realizados
     *
     * @param int start  Número de páginas del listado
     * @param int limit  Límite de registros de cada página
     * @param array arraysJob Listado de trabajos
     * @param array arraysPrinters Listado de impresoras
     * @return array
     *
     * @author Jose M. Zaldivar
     * @version 1.0.1
     */
    static public function getObjectbyArrays($start, $limit, $arraysJob, $arraysPrinters)
    {
        $arrtmp = array();
        foreach ($arraysJob as $key => $job) {
            $tmpprinter = $job['userid']['printerid'];
            if (self::in_arrays('id', $tmpprinter['id'], $arraysPrinters)) {
                array_push($arrtmp, $job);
            }
        }
        return self::get_arrays_start_limit($start, $limit, $arrtmp);
    }

    /**
     * Función que comprueba si ahi trabajos con esa impresora
     *
     * @param string key identificador
     * @param string value Impresora a buscar
     * @param arrays array Arreglo de trabajos
     * @return bool
     *
     * @author Jose M. Zaldivar
     * @version 1.0.1
     */
    static public function in_arrays($key, $value, $arrays)
    {
        foreach ($arrays as $value1) {
            if ($value == $value1[$key]) {
                return true;
            }
        }
        return false;
    }

    /**
     * Función que lista impresoras que pertenezcan a un grupo
     *
     * @param int idgroup Id del grupo de impresoras
     * @param array arraysGrupo Listado de grupos
     * @return array
     *
     * @author Jose M. Zaldivar
     * @version 1.0.1
     */
    static public function getArraysPrinterByIdGroup($idgroup, $arraysGrupo)
    {
        foreach ($arraysGrupo as $grupo) {
            if ($grupo['id'] == $idgroup) {
                return $grupo['printerid'];
            }
        }
        return array();
    }

    /**
     * Función que retorna un listado a mostrar por páginas
     *
     * @param int start  Número de páginas del listado
     * @param int limit  Límite de registros de cada página
     * @param array arrays Listado a mostrar
     * @return array
     *
     * @author Jose M. Zaldivar
     * @version 1.0.1
     */
    static public function  get_arrays_start_limit($start, $limit, $arrays)
    {
        $length = (count($arrays) - $start >= $limit) ? $start + $limit : count($arrays);
        $tmpArrays = array();
        for ($i = $start; $i < $length; $i++) {
            array_push($tmpArrays, $arrays[$i]);
        }
        return $tmpArrays;
    }

    /**
     * Función para saber los usuarios que pertenecen a un grupo
     *
     * @param string grupo Nombre del grupo
     * @return array
     *
     * @author Jose M. Zaldivar
     * @version 1.0.1
     */
    static public function userInGroups($grupo)
    {
        $arrayuser = array();
        if (count($grupo) > 0) {
            foreach ($grupo as $valor) {
                foreach ($valor['userid'] as $user) {
                    array_push($arrayuser, $user['username']);
                }
            }
        }
        return $arrayuser;
    }

    /**
     * Función para establecer la cuota de impresoras por grupos
     *
     * @param array arrayPrinterNew Arreglo de impresoras
     * @param groupName Nombre del grupo
     * @param grupo Grupo
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function groupPrinterQuota($arrayPrinterNew, $groupName, $grupo)
    {
        $users = self::userInGroups($grupo);
        foreach ($arrayPrinterNew as $key => $valor) {
            $printer = $valor->printername;
            $quota = $valor->cuota;
            if ($quota != 0) {
                if ($quota > 10) {
                    $quotaw = $quota - 10;
                } else {
                    $quotaw = $quota - 1;
                }
                $valorq = "-S " . $quotaw . " -H " . $quota;
                $comandoqp = "sudo edpykota --add --printer " . $printer . " -g " . $valorq . " " . $groupName;
                shell_exec($comandoqp);
                if (count($users) > 0) {
                    foreach ($users as $u) {
                        $com1 = "sudo edpykota --add --printer " . $printer . " --noquota " . $u;
                        $com = "sudo edpykota --add --printer " . $printer . " " . $u;
                        shell_exec($com1);
                        shell_exec($com);
                    }
                }
            } else {
                $comandoqp = "sudo edpykota --add --printer " . $printer . " -g " . $groupName;
                shell_exec($comandoqp);
                if (count($users) > 0) {
                    foreach ($users as $u) {
                        $com1 = "sudo edpykota --add --printer " . $printer . " --noquota " . $u;
                        $com = "sudo edpykota --add --printer " . $printer . " " . $u;
                        shell_exec($com1);
                        shell_exec($com);
                    }
                }
            }
        }
    }

    /**
     * Función que elimina un grupo
     *
     * @param string groupName Nombre del grupo
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function deleteGroup($groupName)
    {
        $comando = "sudo pkusers --delete --groups " . $groupName;
        shell_exec($comando);
    }

    /**
     * Función que adiciona una impresora
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function addPrinter()
    {
        shell_exec("sudo pykadd");
        $ip = $_SERVER['REMOTE_ADDR'];
        $comando = "sudo pkutil --deny " . $ip;
        shell_exec($comando);
        shell_exec("sudo pkutil --cupsrestart");
    }

    /**
     * Función para obtener la marka y modelo
     *
     * @param string makemodel Marka modelo
     * @return string
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function makeModel($makemodel)
    {
        if (stripos($makemodel, "Foomatic") !== false) {
            $mm = strstr($makemodel, 'Foomatic', true);
            $mm = rtrim($mm);
        } elseif (stripos($makemodel, "hpijs") !== false) {
            $mm = strstr($makemodel, 'hpijs', true);
            $mm = rtrim($mm);
        } elseif (stripos($makemodel, "hpcups") !== false) {
            $mm = strstr($makemodel, ',', true);
            $mm = rtrim($mm);
        } else {
            $array = explode(" - ", $makemodel);
            $mm = $array[0];
            $mm = rtrim($mm);
        }
        return $mm;
    }

    /**
     * Función para acceder a la configuración de CUPS
     *
     * @param string rootDir Dirección de la configuración
     * @return mixed
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function getConfigCups($rootDir)
    {
        $dirConfigCups = $rootDir . '/config/cups.json';
        return json_decode(file_get_contents($dirConfigCups), true);
    }

    /**
     * Función para comprobar que la dirección es una subred
     *
     * @param array array Números por octetos del ip
     * @param int count Cantidad de números
     * @return string
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function subRed($array, $count)
    {
        if ($array[$count] != 0) {
            $subred = implode(".", $array);
            return $subred;
        } else {
            array_pop($array);
            return self::subRed($array, $count - 1);
        }
    }

    /**
     * Función para establecer el formato de la subred aceptada por CUPS
     *
     * @param string subred Subred
     * @param string value Valor para saber si se va a guardar la subred o se va a mostrar
     * @return array|string
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function formatSubRed($subred, $value)
    {
        if ($value == "save") {
            $format = "*";
        } else {
            $format = 0;
        }
        $subred = explode(".", $subred);
        $count = 4 - count($subred);
        $i = 0;
        while ($i < $count) {
            array_push($subred, $format);
            $i++;
        }
        $subred = implode(".", $subred);
        return $subred;
    }

    /**
     * Función para saber si una ip se encuentra en una subred existente
     *
     * @param string subred Subred
     * @return int
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function buscaEliminaIpEnSubRed($subred)
    {
        $ipAllow = shell_exec("sudo pkutil --getip");
        $ipAllow = rtrim($ipAllow);
        $ipAllow = explode(" ", $ipAllow);

        $count = 4 - count(explode(".", $subred));
        $i = 0;
        $ipdell = 0;
        if (count($ipAllow) > 0) {
            foreach ($ipAllow as $ip) {
                $sub = explode(".", $ip);

                while ($i < $count) {
                    array_pop($sub);
                    $i++;
                }
                $i = 0;
                //var_dump($sub);die;
                $sub = implode(".", $sub);
                if ($subred == $sub) {
                    $comando = "sudo pkutil --dellip " . $ip;
                    shell_exec($comando);
                    $ipdell++;
                }
            }
        }
        return $ipdell;
    }

    /**
     * función que retorna un listado de direcciones ip
     *
     * @return array
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function arrayIp()
    {
        $ipAllow = shell_exec("sudo pkutil --getip");
        $ipAllow = rtrim($ipAllow);
        $ipAllow = explode(" ", $ipAllow);
        $arrayIp = array('data' => array(), 'data_count' => 0);
        $count = 0;
        foreach ($ipAllow as $ip) {
            $octetos = explode(".", $ip);
            if ($octetos[count($octetos) - 1] != "*") {
                if ($ip != "") {
                    $array = array("ip" => $ip);
                    array_push($arrayIp['data'], $array);
                    $count++;
                }
            } else {
                $subred = self::subRed($octetos, count($octetos) - 1);
                $ip = Utils::formatSubRed($subred, "show");
                $array = array("ip" => $ip);
                array_push($arrayIp['data'], $array);
                $count++;
            }
        }
        $arrayIp["data_count"] = $count;
        return $arrayIp;
    }

    /**
     * Función para saber si un ip existe en el listado de acceso a las impresoras
     *
     * @param string ip Ip a buscar
     * @return bool|int
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function elIpYaEsta($ip)
    {
        $arrayIpSubRed = self::arrayIp();
        $arrayIp = array();
        $arraySubRed = array();
        $array = $arrayIpSubRed['data'];
        if (count($array) > 0) {
            foreach ($array as $ipSubred) {
                $octetos = explode(".", $ipSubred['ip']);
                if ($octetos[count($octetos) - 1] != 0) {

                    array_push($arrayIp, $ipSubred['ip']);
                } else {

                    $sub = self::subRed($octetos, count($octetos) - 1);

                    $subred = Utils::formatSubRed($sub, "show");
                    array_push($arraySubRed, $subred);
                }
            }
            if (count($arrayIp) > 0) {
                foreach ($arrayIp as $p) {
                    if ($p == $ip) {
                        return true;
                    }
                }
            }
            if (count($arraySubRed) > 0) {
                $var = self::estaEnSubred($arraySubRed, $ip);
                if ($var != 0) {
                    return true;
                }
            }
        }
        return 0;
    }

    /**
     * Función para saber si un ip esta en una subred especifica
     *
     * @param array arraySubRed Octetos de la subred
     * @param string ip Ip a buscar
     * @return int
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function estaEnSubred($arraySubRed, $ip)
    {
        foreach ($arraySubRed as $s) {
            $value = explode(".", $s);
            array_pop($value);
            if ($value[count($value) - 1] != 0) {
                $s1 = implode(".", $value);
                $subIp = explode(".", $ip);
                array_pop($subIp);
                $subIp = implode(".", $subIp);
                if ($s1 == $subIp) {
                    return true;
                }
            } elseif ($value[count($value) - 2] != 0) {
                array_pop($value);
                $s1 = implode(".", $value);
                $subIp = explode(".", $ip);
                array_pop($subIp);
                array_pop($subIp);
                $subIp = implode(".", $subIp);
                if ($s1 == $subIp) {
                    return 1;
                }
            } else {
                array_pop($value);
                array_pop($value);
                $s1 = implode(".", $value);
                $subIp = explode(".", $ip);
                array_pop($subIp);
                array_pop($subIp);
                array_pop($subIp);
                $subIp = implode(".", $subIp);
                if ($s1 == $subIp) {
                    return 1;
                }
            }
        }
        return 0;
    }

    /**
     * Función para saber si la subred ya existe
     *
     * @param string subred Subred a buscar
     * @return bool|int
     *
     * @author Adonis Fdez
     * @version 1.0.1
     */
    static public function laSubRedYaEsta($subred)
    {
        $subred = Utils::formatSubRed($subred, "show");
        $arrayIpSubRed = self::arrayIp();
        $arraySubRed = array();
        $array = $arrayIpSubRed['data'];
        foreach ($array as $sub) {
            $s = $sub['ip'];
            $s = explode(".", $s);
            if ($s[count($s) - 1] == 0) {
                $s = implode(".", $s);
                array_push($arraySubRed, $s);
            }
        }
        if (count($arraySubRed) > 0) {
            $var = self::estaEnSubred($arraySubRed, $subred);
            if ($var != 0) {
                return true;
            }
        }
        return 0;
    }


}
