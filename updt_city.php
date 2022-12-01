<?php
    //include connection file
    include('connection.php');
    
    //fetching data from database 
    $cid=$_REQUEST['Update'];
    $select="Select * from city where cid='$cid'";
    $d1=mysqli_query($con,$select);
    $display1=mysqli_fetch_array($d1);

    //include Header
    include ('nav.php');
    
    //Include footer
    include('footer.php');
?>
<html>
    <head>
    <!-- include a css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
    <body>
        <!-- Designing for updation page -->
       <form method="POST">
            <center>
                 <h3>City Update</h3>
                     <table class="table" border="0">
                            <tr>
                                <td><input class="input" type="hidden" name="cid" value="<?php echo $display1['cid']?>"></td>
                                </td>
                            </tr>
                            <td>State ID</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="sid" value="<?php echo $display1['sid']?>"></td>
                                </td>
                            </tr> 
                            <tr>
                                <td>City Name</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="cname" value="<?php echo $display1['cname']?>"></td>
                                </td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="pincode" value="<?php echo $display1['pincode']?>"></td>
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
     //fetch data from database
     $sid=$_POST['sid'];
     $cid=$_POST['cid'];
     $cname=$_POST['cname'];
     $pincode=$_POST['pincode'];
     
     //update query
     $updt="Update city set sid='$sid',cname='$cname',pincode='$pincode' where cid='$cid' ";
     $q1=mysqli_query($con,$updt);
      
      if($q1)
      { 
        echo "<script> alert('Data updated')</script>";
        header("location:city.php");
      }
      else
      {
         echo "<script> alert('Problem in Updation')</script>";
      }     
}  
?>

