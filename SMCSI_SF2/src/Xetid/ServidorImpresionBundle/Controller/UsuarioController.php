<?php
/**
 * Created by PhpStorm.
 * User: jmzaldivar
 * Date: 17/03/15
 * Time: 14:53
 */

namespace Xetid\ServidorImpresionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\HttpFoundation\Session\Session;

class UsuarioController extends Controller{

 public function loginAction(){
     $request  = $this->get('request');
     $user  = $request->request->get('_username');
     $password  = $request->request->get('_password');
     $yaml = new Parser();
     $dir_seguridad = $this->get('kernel')->getRootDir().'/config/security.yml';
     $value = $yaml->parse(file_get_contents($dir_seguridad));
     $user_valid = 'administrador';
     $pass_valid = $value['security']['providers']['in_memory']['memory']['users']['administrador']['password'];
     $ressults = array();
     if($user == $user_valid && sha1($password) == $pass_valid){
         $session = new Session();
         $id = $session->getId();
         $tokens = $session->get('tokens');
         $tokens['administrador']= $id;
         $session->set('tokens',$tokens);
         $ressults = array(
             'success'=>true,
             'msg'=>'login_success'
         );
     }elseif($user != $user_valid){
         $ressults = array(
             'success'=>false,
             'msg'=>'user_failure'
         );
     }elseif($pass_valid!=$password){
         $ressults = array(
             'success'=>false,
             'msg'=>'password_failure'
         );
     }
     return new Response(json_encode($ressults));
 }
    public function isAuthenticateAction(){
        $session = new Session();
        $id = $session->getId();
        $token = $session->get('tokens');
        $session_id = (isset($token['administrador'])) ? $token['administrador'] : "";
        $arrays = array();
        if($id === $session_id && isset($session_id) && $session_id != "" && !is_null($session) && $session_id){
            $arrays=array(
                'success'=>true,
                'msg'=>'is_authenticate'
            );
        }else{
            $arrays=array(
                'success'=>false,
                'msg'=>'not_authenticate'
            );
        }
        return new Response(json_encode($arrays));
    }
    public function changePasswordAction(){
        $request = $this->get('request');
        $newpassword = $request->request->get('password_one');

        $dir_seguridad = $this->get('kernel')->getRootDir().'/config/security.yml';
        $arrays = array();
        if(is_writable($dir_seguridad) && is_readable($dir_seguridad)){
            $yaml = new Parser();
            $value = $yaml->parse(file_get_contents($dir_seguridad));
            $value['security']['providers']['in_memory']['memory']['users']['administrador']['password'] =
                sha1($newpassword);
            $dumper = new Dumper();
            $yaml = $dumper->dump($value);
            file_put_contents($dir_seguridad,$yaml);
            $arrays=array(
                'success'=>true,
                'msg'=>'change_password_success'
            );
        }else{
            $arrays=array(
                'failure'=>true,
                'msg'=>'permission_deny'
            );
        }
        return new Response(json_encode($arrays));
    }
    public function logoutAction(){
        $session = new Session();
        $session->clear();
        return new Response(json_encode(array('success'=>true)));
    }
} 