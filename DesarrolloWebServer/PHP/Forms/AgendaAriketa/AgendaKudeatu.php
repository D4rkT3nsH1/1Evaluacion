<?php

$agenda = array(
    'Iker' => '666 777 888',
    'Jon' => '666 777 889',
    'Gontzal' => '666 777 890',
    'Gaizka' => '666 777 891',
    'Kaiet' => '666 777 892'
);

$gorde = filter_input(INPUT_POST, 'gorde');
$ikusi = filter_input(INPUT_POST, 'ikusi');

if (isset($gorde)) {
    $izena = filter_input(INPUT_POST, 'izena');
    $tel = filter_input(INPUT_POST, 'tel');

    if (!empty($izena) && !empty($tel)) {
        if (!array_key_exists($izena, $agenda)) {
            if (in_array($tel, $agenda)) {
                echo "El número indicado ya existe en la agenda";
            } else {
                echo "Nuevo contacto agendado";
                $agenda[$izena] = $tel;
            }
        } else if (array_key_exists($izena, $agenda) && !in_array($tel, $agenda)) {
            echo "Contacto editado";
            $agenda[$izena] = $tel;
        }
    } else if (empty($izena) && !empty($tel)) {
        echo "Falta el nombre del contacto";
    } else if (array_key_exists($izena, $agenda) && !empty($izena) && empty($tel)) {
        echo "El contacto ha sido eiminado";
        unset($agenda[$izena]);
    }

    echo "<table border='1'";
    foreach ($agenda as $nombre => $num) {
        echo "<tr><td>", $nombre, "</td><td>", $num, "</td></tr>";
    }
    echo "</table>";
}

if (isset($ikusi)) {
    echo "<table border='1'";
    foreach ($agenda as $nombre => $num) {
        echo "<tr><td>", $nombre, "</td><td>", $num, "</td></tr>";
    }
    echo "</table>";
}

echo "<a href='Agenda.html'>Itzuli formularioa</a>";

?>