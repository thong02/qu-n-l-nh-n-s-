<?php 

require_once 'config.php';

$key = $_POST['key'];
$id = $_POST['id'];
$name  = $_POST['name'];
$age         = $_POST['age'];
$address      = $_POST['address'];
$phone     = $_POST['phone'];
$date      = $_POST['date'];
$image    = $_POST['image'];

if ( $key == "update" ){

    $birth_newformat = date('Y-m-d', strtotime($date));

    $query = "UPDATE staff SET 
                                name ='$name'
                                ,age='$age'
                                ,address='$address'
                                ,phone='$phone'
                                ,date='$date'
                                WHERE id = '$id' ";

        if ( mysqli_query($conn, $query) ){

            if ($image == null) {

                
                $result["value"] = "1";
                $result["message"] = "Success";
    
                echo json_encode($result);
                mysqli_close($conn);

            } else {

         
                $path = "picture/$id.jpeg";
                $finalPath = "/DEMO_INTERNET/".$path;

                $insert_picture = "UPDATE staff SET image='$finalPath' WHERE id='$id' ";
            
                if (mysqli_query($conn, $insert_picture)) {
            
                    if ( file_put_contents( $path, base64_decode($image) ) ) {
                        
                        $result["value"] = "1";
                        $result["message"] = "Success!";
            
                        echo json_encode($result);
                        mysqli_close($conn);
            
                    } else {
                        
                        $response["value"] = "0";
                        $response["message"] = "Error! ".mysqli_error($conn);
                        echo json_encode($response);

                        mysqli_close($conn);
                    }

                }
            }

        } 
        else {
            $response["value"] = "0";
            $response["message"] = "Error! ".mysqli_error($conn);
            echo json_encode($response);

            mysqli_close($conn);
        }
}

?>