<?php 

header("Content-Type: application/json; charset=UTF-8");

require_once 'config.php';

$query = "SELECT * FROM staff ORDER BY id DESC ";
$result = mysqli_query($conn, $query);
$response = array();

$server_name = $_SERVER['SERVER_ADDR'];

while( $row = mysqli_fetch_assoc($result) ){

    array_push($response, 
    array(
        'id'        =>$row['id'], 
        'name'      =>$row['name'], 
        'age'=>$row['age'],
        'address'     =>$row['address'],
        'phone'    =>$row['phone'],
        'date'     =>date('d M Y', strtotime($row['date'])),
        'image'   =>"http://$server_name".$row['image']
        ) 
    );
}


echo json_encode($response);

mysqli_close($conn);

?>