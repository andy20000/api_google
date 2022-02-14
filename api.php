<?php  
require 'conexion.php';

if(isset($_GET['db_id_origen']) && isset($_GET['lat_origen']) && isset($_GET['lon_origen']) && isset($_GET['db_id_destino']) && isset($_GET['lat_destino']) && isset($_GET['lon_destino']))
{
    $db_id_origen = $_GET['db_id_origen'];
    $lat_origen = $_GET['lat_origen'];
    $lon_origen = $_GET['lon_origen'];
    $db_id_destino = $_GET['db_id_destino'];
    $lat_destino = $_GET['lat_destino'];
    $lon_destino = $_GET['lon_destino'];
    $google_maps_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode($lat_origen)."%2c".urlencode($lon_origen)."&destinations=".urlencode($lat_destino)."%2c".urlencode($lon_destino)."&key=AIzaSyDq9HWFYk9w0o8CqY3HazYGY1qIdq1dj2A";
    $google_maps_json = file_get_contents($google_maps_url);
    $google_maps_array = json_decode($google_maps_json, true);

    $status = $google_maps_array["rows"][0]["elements"][0]["status"];

    if($status != "OK"){
        echo $status;
    } else {
        if($distancia = $google_maps_array["rows"][0]["elements"][0]["distance"]["value"]);
        {
            if($duracion = $google_maps_array["rows"][0]["elements"][0]["duration"]["value"]);
            {
                $insertar = "INSERT INTO `ddodt` (`id`, `duracion`, `distancia`, `fecha`, `db_id_origen`, `lat_origen`, `lon_origen`, `db_id_destino`,  `lat_destino`, `lon_destino`) VALUES (NULL, $duracion, $distancia, NULL, $db_id_origen, $lat_origen, $lon_origen, $db_id_destino, $lat_destino, $lon_destino)";
                $query =mysqli_query($conn, $insertar);
                if($query){

                }else{

                }
            }
        }
    }
} else {
    echo "faltan datos para efectuar la consulta";
}

?>