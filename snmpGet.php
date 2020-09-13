<?php
    $ifInOctets =  snmp2_get('192.168.100.7','gerencia','1.3.6.1.2.1.2.2.1.10.19');
    $ifInOctetsV = explode(" ",$ifInOctets);
    $ifInOctets = (int)$ifInOctetsV[1];
    echo $ifInOctets;
    ?>