
<?php

function appendix_specific($appendix_nuber){
    $tokutei = [1,2,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,31,41,43];
    $hi_tokutei = [11,29,30,32,33,34,35,36,37,38,39,40,42,44,45,46,47,48];

    if(in_array($appendix_nuber,$tokutei)) {
        return "特定防火対象物";
    } elseif(in_array($appendix_nuber,$hi_tokutei)) {
        return "非特定防火対象物";
    }
}




?>