<?php
    $ifOutOctets =  snmp2_get('192.168.100.7','gerencia','1.3.6.1.2.1.2.2.1.16.19');
    $ifOutOctetsV = explode(" ",$ifOutOctets);
    $ifOutOctets = (int)$ifOutOctetsV[1];
    echo $ifOutOctets;
    ?>