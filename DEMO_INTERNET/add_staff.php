<?php 

require_once 'config.php';

$key = $_POST['key'];

$name       = $_POST['name'];
$age   = $_POST['age'];
$address      = $_POST['address'];
$phone     = $_POST['phone'];
$date      = $_POST['date'];
$image    = $_POST['image'];

if ( $key == "insert" ){

    $birth_newformat = date('Y-m-d', strtotime($date));

    $query = "INSERT INTO staff (name,age,address,phone,date)
    VALUES ('$name', '$age', '$address', '$phone', '$birth_newformat') ";

        if ( mysqli_query($conn, $query) ){

            if ($image == "") {

                $finalPath = "/demo_internet/picture/images.png"; 
                $result["value"] = "1";
                $result["message"] = "Success";
    
                echo json_encode($result);
                mysqli_close($conn);

            } else {

                $id = mysqli_insert_id($conn);
                $path = "picture/$id.jpeg";
                $finalPath = "/DEMO_INTERNET/".$path;

                $insert_picture = "UPDATE student SET image='$finalPath' WHERE id='$id' ";
            
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