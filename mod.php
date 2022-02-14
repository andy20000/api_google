<?php  
require 'conexion.php';

$array = array();

$sql = "SELECT * FROM `intersecciones_semaforizadas`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $arrayInterseccion = array();
        //echo "db_id: " . $row["db_id"]. " - Direccion: " . $row["dirsem"]. " - Coordenadas: " . $row["lon"] . "," . $row["lat"] . "<br>";
        array_push($arrayInterseccion, $row["db_id"], $row["dirsem"], $row["lon"], $row["lat"]);
        array_push($array, $arrayInterseccion);
        //echo "<br>";
        //print_r($arrayInterseccion);
    }
} else {
  echo "0 results";
}
//echo "<br>";
//print_r($array);
mysqli_close($conn);


for ($i = 0; $i < count($array); $i++)
{
    print_r($array[$i][0]);
    echo "<br>";

    for ($j = 0; $j < count($array); $j++)
    {
        if ($i != $j){
            print_r($array[$i][0]);
            echo " -> ";
            print_r($array[$j][0]);
            echo "<br>";
            echo $query_api = "http://localhost/api_g/api.php?lat_origen=".urlencode(str_replace(",",".",$array[$i][3]))."&lon_origen=".urlencode(str_replace(",",".",$array[$i][2]))."&lat_destino=".urlencode(str_replace(",",".",$array[$j][3]))."&lon_destino=".urlencode(str_replace(",",".",$array[$j][2]));
            echo "<br>";
            $respuesta_api = file_get_contents($query_api);
        }
    }
}

?>