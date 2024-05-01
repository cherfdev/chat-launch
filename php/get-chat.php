<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    if ($row['imageset']) {
                        $output .= '<div class="chat outgoing">
                        </div>
                        <div class="details">
                        <div>
                        <img src="php/images/'.$row['imageset'].'" alt="" class="rowimg">
                            <p>'. $row['msg'] .'</p>
                            <div class="moment">
                        '.$row['moment'].'1
                        </div>
                        </div>
                        
                        </div>';
                    }elseif ($row['msg']) {
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                <div class="moment">
                                '.$row['moment'].'
                                </div>
                                </div>
                                </div>';
                    }elseif ($row['msg'] ==="") {
                        $output .= '<div class="chat outgoing">
                                
                                <div class="details">
                                <div>
                                <img src="php/images/'.$row['imageset'].'" alt="" class="rowimg">
                                </div>
                                    <div class="moment">
                                '.$row['moment'].'
                                </div>
                                </div>
                                
                                </div>';
                    }elseif (empty($row['imageset'])) {
                        $output .= '<div class="chat outgoing">
                                <div class="details">4
                                </div>
                                
                                </div>';
                    }
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="" class="img">
                                <div class="details">

                                    <p>'. $row['msg'] .'</p>
                                    <div class="moment">
                                '.$row['moment'].'
                                </div>
                                </div>
                                
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">Pas de message. Les nouveaux messages envoyés apparaitront ici.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>