<?php
    $udpInnn =  snmp2_get('192.168.100.7','gerencia','1.3.6.1.2.1.7.1.0');
    $udpInnnV = explode(" ",$udpInnn);
    $udpInnn = (int)$udpInnnV[1];
    echo $udpInnn;
    ?>