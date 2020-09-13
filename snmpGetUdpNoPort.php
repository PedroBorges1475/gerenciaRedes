<?php
    $udpInnnNo =  snmp2_get('192.168.100.7','gerencia','1.3.6.1.2.1.7.2.0');
    $udpInnnNoV = explode(" ",$udpInnnNo);
    $udpInnnNo  = (int)$udpInnnNo[1];
    echo $udpInnnNo ;
    ?>