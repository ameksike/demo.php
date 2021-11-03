<?php


function format($out, $month="TEST"){
    echo " | read1 << ".$out->read1 . " | read2 << ".$out->read2 . " | kwh << ".$out->kws. " | COST << ".$out->cost ." | month << ".$month ." \n ";
}
function check($obj, $list){
    foreach($list as $i){
        $out = $obj->set($i['read1'], $i['read2'])->process();
        format($out, $i['month']);
    }
}