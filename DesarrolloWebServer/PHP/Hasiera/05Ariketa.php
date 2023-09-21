<table border=2px aling=center>
<tr>
	<td width=100px>N</td>
	<td width=100px>Cuadrado</td>
	<td width=100px>Cubo</td>
</tr>

<?php
$a=20;

for ($i = 1; $i <= $a; $i++) {
    echo "<tr>";
        echo "<td> $i </td>";
        echo "<td>", $i*$i ,"</td>";
        echo "<td>", $i*$i*$i ,"</td>";
    echo "</tr>";
}

?>

</table>