<?php
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       10/01/2013
 * @version    1.5
 */
//---------------------------------------------------------------------------
if ( sizeof($argv)<2 ) {
        echo "Usage: $argv[0] stat|send|receive|remove msgType MSG [msg] \n\n" ;
        echo "   EX: $argv[0] send 1 \"This is no 1\" \n" ;
        echo "       $argv[0] receive ID \n" ;
        echo "       $argv[0] stat \n" ;
        echo "       $argv[0] remove \n" ;
        exit;
}

$MSGKey = "123456" ;

## Create or attach to a message queue
$seg = msg_get_queue($MSGKey) ;


switch ( $argv[1] ) {
    case "send":
        msg_send($seg, $argv[2], $argv[3]);
        echo "msg_send done...\n" ;
        break;
       
    case "receive":

	while(1)
	{
		$stat = msg_stat_queue( $seg );
		
		if ( $stat['msg_qnum'] > 0 ) {
			msg_receive($seg, $argv[2], $msgtype, 1024, $data);
			echo 'Messages in the queue: ';	
			echo "type:$msgtype  data:$data =>" .$stat['msg_qnum']."\n";
		}
		sleep(5);
		/*else {
		    echo "No Msg...\n";
		}*/
	}
		
        break;
   
    case "stat":
      print_r( msg_stat_queue($seg) );
        break;
       
    case "remove":
        msg_remove_queue($seg);
        break;
}
?>
