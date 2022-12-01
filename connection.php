<?php
    $con=mysqli_connect("localhost","root","","User");
    // or 
    // die("Problem in Conection");
    if(!$con)
    {
        echo "Connection failed";
    }
   //echo "connected Successfully";


  
?>