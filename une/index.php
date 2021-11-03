<?php
    include __DIR__."/UNE.php";
    include __DIR__."/util.php";

    $list = include __DIR__."/config.php";

    $UNE = new UNE();

    echo " ";
    check($UNE, $list);

    format($UNE->process(179*2));