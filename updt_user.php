<?php
    //include conection
    include('connection.php');

    //fetch data from database for dynamic selection of data
    $did=$_REQUEST['Update'];
    $select="Select * from user_info where did='$did'";
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
        <!-- Designing for updation page -->
        <form action="#" method="POST">
            <center>
                <h3>User Update</h3>
                     <table class="table" border="0">
                        <tr> 
                                <td><input class="input" type="hidden" name="did" value="<?php echo $display['did']?>"></td>
                            </tr>
                            <tr>
                                <td>city Id</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="cid" value="<?php echo $display['cid']?>"></td>
                            </tr>
                            <tr>
                                <td>Fisrt Name</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="first_name" value="<?php echo $display['first_name']?>"></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="last_name" value="<?php echo $display['last_name'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Email ID</td>
                                <td>:</td>
                                <td><input class="input" type="email" name="email" value="<?php echo $display['email'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Address </td>
                                <td>:</td>
                                <td><input class="input" type="text" name="address" value="<?php echo $display['address'] ?>"></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center">
                                    <input class="submit" type="submit" name="Update" value="Update" ></td>
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
     $did=$_POST['did'];
     $cid=$_POST['cid'];
     $first_name=$_POST['first_name'];
     $last_name=$_POST['last_name'];
     $email=$_POST['email'];
     $address=$_POST['address'];
    
     //update query
     $updt="Update user_info set cid='$cid',first_name='$first_name',last_name='$last_name',email='$email',address='$address' where did='$did' ";
     $q1=mysqli_query($con,$updt);
  
    if($q1)
    {
        // header ("Location:http://localhost/Task/user_man.php");
        echo "<script> alert('Data updated')</script>"; 
        header("location:user_man.php");
    }
    else
    {
         echo "<script> alert('Problem in Updation')</script>";
    }
}  

?>
 