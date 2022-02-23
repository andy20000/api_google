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
    $google_maps_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode($lat_origen)."%2c".urlencode($lon_origen)."&destinations=".urlencode($lat_destino)."%2c".urlencode($lon_destino)."&key=AIzaSyBrh7xmiOzDG6TsQ5MEMxEe15720LGsIQo";
    $google_maps_json = file_get_contents($google_maps_url);
    $google_maps_array = json_decode($google_maps_json, true);

    $status = $google_maps_array["rows"][0]["elements"][0]["status"];

    if($status != "OK"){

                         if($status == null || $status = "ZERO_RESULTS" ||  $json['insercion datos']=false   ){         
                                         $api['operacion']=false;
                                         echo json_encode($api);
                                         $json['internet']=false ;
                                       }else{
                     
                                       $api['operacion']=true;             
                                    echo json_encode($api);
                                            }
                             $json['status']=$status; 
                             $json['datos correctos']=$_GET['lat_origen'] && $_GET['lon_origen']  && $_GET['lat_destino']  && $_GET['lon_destino'] ;
                             echo json_encode($json);
        echo "stado". $status;
    } else {
        if($distancia = $google_maps_array["rows"][0]["elements"][0]["distance"]["value"]);
        {
            if($duracion = $google_maps_array["rows"][0]["elements"][0]["duration"]["value"]);
            {
                $insertar = "INSERT INTO `ddodt` (`id`, `duracion`, `distancia`, `fecha`, `db_id_origen`, `lat_origen`, `lon_origen`, `db_id_destino`,  `lat_destino`, `lon_destino`) VALUES (NULL, $duracion, $distancia, NULL, $db_id_origen, $lat_origen, $lon_origen, $db_id_destino, $lat_destino, $lon_destino)";
                $query =mysqli_query($conn, $insertar);
                if($query){      //echo "el query fue guardado ".$query;
                        
                                $json['status']='ok';
                                $api['operacion']=true;
                                   echo json_encode($api);  
                                $json['insercion datos']=$_GET['lat_origen'] && $_GET['lon_origen']  && $_GET['lat_destino']  && $_GET['lon_destino'] ;
                                echo json_encode($json);       

                }else{          $json['insercion datos']= false;
                                $api['operacion']=false;
                                echo json_encode($api);
                                echo json_encode($json);

                }
            }
        }
    }
}

//else {
  //  echo "faltan datos para efectuar la consulta";
//}

?>