<?php
/*
 * Tenemos 3 arrays :
 * 
 * -  Un array asociativo que tiene como keys los nombres de paises y values
 *    los habitantes del pais
 *    
 *    ejem :  $paises=array('Francia'=>67000000,'Mali'=>250000,'Brasil'=>300000000,'Pakistan'=>350000000,
 *                           'Islas Marshall'=>55000);
 *    
 *  - Otro array num�rico con la clasificacion de los paises en funci�n del num de habitantes
 *  
 *    ejem :  
 *    $poblaciones=array('0-100000-Deshabitado',                // entre 0 y 100 mil
 *                      '100001-1000000-Poco Poblado',         // entre 100 mil+1 y 1 millon
 *                      '1000001-100000000-Poblado',           // entre 1 millon+1 y 100 millones
 *                      '100000001-1000000000-Muy Poblado')    // entre 100 millones+1 y 1000 millones
 * 
 * -  Otro array asociativo con los paises por continente
 *    
 *    ejem: 
 *    $continentes=array('Europa'=>'Francia, Portugal, Italia',
 *                       'Asia'=>'China, Turquia, Pakistan',
 *                       'Africa'=>'Nigeria, Marruecos, Mali',
 *                       'America'=>'EEUU, Brasil, Argentina',
 *                       'Occeania'=>'Australia, Polinesia, Islas Marshall' )
 *                       
 *    El resultado es asi : 
 *    
 *    Francia es un pais poblado de Europa
 *    Mali es un pais poco poblado de Africa
 *    Brasil es un pais muy poblado de America
 *    Pakistan es un pais muy poblado de Asia
 *    Islas Marshall es un pais deshabitado de Oceania
 *    
 */

$paises = array('Francia' => 67000000, 'Mali' => 250000, 'Brasil' => 300000000, 'Pakistan' => 350000000, 'Islas Marshall' => 55000);

$poblaciones = array(
    '0-100000-Deshabitado',
    // entre 0 y 100 mil
    '100001-1000000-Poco Poblado',
    // entre 100 mil+1 y 1 millon
    '1000001-100000000-Poblado',
    // entre 1 millon+1 y 100 millones
    '100000001-1000000000-Muy Poblado'
); // entre 100 millones+1 y 1000 millones

$continentes = array(
    'Europa' => 'Francia, Portugal, Italia',
    'Asia' => 'China, Turquia, Pakistan',
    'Africa' => 'Nigeria, Marruecos, Mali',
    'America' => 'EEUU, Brasil, Argentina',
    'Occeania' => 'Australia, Polinesia, Islas Marshall'
);

foreach ($paises as $key => $value) //recorre paises
{
    $poblado = "";
    for ($i = 0; (($i < sizeof($poblaciones)) && ($poblado == "")); $i++) // recorre poblaciones
    {
        $tab = explode('-', $poblaciones[$i]); //en $tab se guarda min-max-poblado

        if (($value >= $tab[0]) && ($value <= $tab[1])) {
            $poblado = $tab[2];
        }
    }
    //miramos los continentes
    $cont = "";
    foreach ($continentes as $key2 => $value2) {
        if (str_contains($value2, $key)) {
            $cont = $key2;
            break;
        }
    }

    echo $key . ' es un pais ' . $poblado . ' y pertenece al continente ' . $cont . '</br>';
}