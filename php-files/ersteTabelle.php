
<table style='border:1px solid black'>
<?php
//Zelle 1#1
for ($x = 1; $x <= 3; $x++) {
    echo "<tr>";
    for ($y = 1; $y <= 3; $y++){
        echo "<td style='border:1px solid black'> Zelle ".$x. "#" . $y. "</td> ";
    }
    echo " </tr>";
}

?>

</table>