<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        date_default_timezone_set('Etc/GMT-1');
        $time = date('H:i');
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, moment, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$time}', '{$message}')") or die();
        }
        elseif(!empty($_FILES['file'])){
            $file = $_FILES['file']['name'];
            $file_name = $_FILES['file']['tmp_name'];
            $tim = time();
            $file_send = $tim.$file;
            move_uploaded_file($file_name,"images/".$file_send);
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, moment, imageset)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$time}', '{$file_send}')") or die();
            
        } elseif(!empty($message) && !empty($file)){ 
            $file = $_FILES['file']['name'];
            $file_name = $_FILES['file']['tmp_name'];
            $tim = time();
            $file_send = $tim.$file;
            move_uploaded_file($file_name,"images/".$file_send);
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, moment, msg, imageset)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$time}','{$message}','{$file_send}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>