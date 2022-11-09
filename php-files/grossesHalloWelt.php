<?php
// Ausgabe mit echo
echo "Hallo Welt";

// Schleife
for ($i = 1; $i<9;$i++){
    // mit jedem Durchlauf wird die Schrift größer
    $size=$i*10;
    echo "<span style='font-size:$size%'> Hallo Welt <br> </span>";

    }
?>
