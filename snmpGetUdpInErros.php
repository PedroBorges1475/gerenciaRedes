<?php
    $udpInnnError =  snmp2_get('192.168.100.7','gerencia','1.3.6.1.2.1.7.3.0');
    $udpInnnErrorV = explode(" ",$udpInnnError);
    $udpInnnError = (int)$udpInnnErrorV[1];
    echo $udpInnnError;
    ?>