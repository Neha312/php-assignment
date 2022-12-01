<?php
    //include conection
    include('connection.php');

    //fetch data from database for dynamic selection of data
    $sid=$_REQUEST['Update'];
    $select="Select * from state where sid='$sid'";
    $d=mysqli_query($con,$select);
    $display=mysqli_fetch_array($d);

    //include Header file
    include ('nav.php');

    //include footer file
    include('footer.php');
?>
<html>
    <head>
    <!-- include a css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
         <!--Designing of Update page-->
          <form action="#" method="POST">
                <center>
                     <h3>State Update</h3>
                            <table class="table" border="0">
                                <tr>
                                        <td><input class="input" type="hidden" name="sid" value="<?php echo $display['sid']?>" /></td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>:</td>
                                        <td><input class="input" type="text" name="state" value="<?php echo $display['name']?>" /></td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center"><input class="submit" type="submit" name="Update" value="Update" id="Update"></td>
                                    </tr>
                            </table>
               </center>
         </form>
       
    </body>
</html>

<?php

//code of updation
if(isset($_POST['Update'])) 
{
    //fetching data from database
     $sid=$_POST['sid'];
     $state=$_POST['state'];
     
    //update query
     $updt="Update state set name='$state' where sid='$sid' ";
     $q1=mysqli_query($con,$updt);
      
      if($q1)
      {
        echo "<script> alert('Data updated')</script>";
        header ("location:state.php");     
      }
      else
      {
         echo "<script> alert('Problem in Updation')</script>";
      } 
}  
?>

 