<?php
   //include connection file
   include('connection.php');
   //include Header File
   include ('nav.php');
   //include Footer file
   include('footer.php');
?>
<html>
    <head>
    <!-- include a css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
   
    <body>
        <form  method="POST">
            <center>
                  <h3>User Management</h3>
                        <table class="table" border="0">
                            <tr>
                                <td>city Id</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="cid" required></td>
                            </tr>
                            <tr>
                                <td>Fisrt Name</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="first_name" required></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="last_name" required></td>
                            </tr>
                            <tr>
                                <td>Email ID</td>
                                <td>:</td>
                                <td><input class="input" type="text" name="email" required></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>:</td>
                                <td><input class="input" type="password" name="password" required></td>
                            </tr>

                            <tr>
                                <td>Address </td>
                                <td>:</td>
                                <td><input class="input" type="text" name="address" required></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center">
                                    <input class="submit" type="submit" name="Insert" value="Insert" ></td>
                            </tr>
                        </table>
             </center>
        </form>
       
    </body>
</html>

<br><br>
<?php
         //code of Insertion
         if(isset($_POST['Insert'])) 
         {
            //fetch data from database
            $cid=$_POST['cid'];
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $address=$_POST['address'];

            //insertion Query
            $ins="Insert into user_info(cid,first_name,last_name,email,password,address)values($cid,'$first_name','$last_name','$email','$password','$address')";
            $q=mysqli_query($con,$ins);
             
             if($q)
             {
                    echo "<script> alert('Data inserted')</script>";
             }
             else
             {
                echo "<script> alert('Problem in Insertion')</script>";
             }
             //Unset() for not insert data  again if browser or page refresh
             unset($_POST['Insert']);
        }  
       else
       {
         //echo "Button not click";
       } 
       
       //Deletion code
       if(isset($_REQUEST['Delete']))
       {
            //deletion Query
           $delid1=$_REQUEST['Delete'];
           $delete1="Delete from user_info where did='$delid1'";
           $result1=mysqli_query($con,$delete1);
           
           if($result1)
           {
               header("location:user_man.php");
           }
           else
           {
               echo "<script>alert('Problem in Deletion')</script>";
           }
       }


    ?>
 <center>
    <table border="1" style="background-color:PowderBlue; border-radius:10px; width:80%">

        <tr>
            <th>User ID</th>
            <th>City ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email id</th>
            <th>Email</th>
            <th>Address</th>
            <th colspan="2" align="center">Action</th>
        </tr>

        <?php
                //select data from Database for showing data in table
                $select="Select * from user_info";
                $ans=mysqli_query($con,$select);

                while($row=mysqli_fetch_array($ans))
                {
         ?>
                   <tr>
                         <td><?php echo $row['did']; ?></td>
                         <td><?php echo $row['cid']; ?></td>
                        <td><?php echo $row['first_name'];?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email'];?></td>
                       <td><?php echo $row['address'];?></td> 
                       <!-- Rediction for Delete data -->
                       <td><a href="./user_man.php?Delete=<?php echo $row ['did'];?>">  Delete </a></td>
                        <!-- Rediction for Update data -->
                        <td> <a href="updt_user.php?Update=<? echo $row ['did'];?>">  Edit</a> </td>
                       

                 </tr>
                    
        <?php
              }   
        ?>
    </table>
</center>
