<?php 
 $conn = mysqli_connect("localhost", "root", "", "manichat");
 if ($conn) {
     echo "Connecté à la base de donnée";
 }else{
     echo "Erreur de connection"; 
 }
?>
