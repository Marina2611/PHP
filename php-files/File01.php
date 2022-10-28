<?php
define("MWT", 0.19);
function nettoToBrutto($netto) {
    return round($netto * (1+MWT), 2);
}

echo nettoToBrutto(100.12345);



?>
