<?php
//connection include
include('connection.php');
//Header include
include ('nav.php');
//footer include
include('footer.php');

?>

<html>
    <head>
     <!-- include a css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <form action="" method="POST">
            <!-- Design of state form -->
            <center>
                <h3>State Management</h3>
                    <table class="table" border="0">

                        <tr>
                            <td>State</td>
                            <td>:</td>
                            <td><input class="input" type="text" name="txtstate"></td>
                            <?php if(isset($state_error)){?>
                                <p><?php echo $state_error  ?></p>
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center"><input class="submit" type="submit" name="Insert" value="Insert" id="Insert"></td>
                        </tr>
                     </table>
            </center>
        </form>
       
    </body>
</html>

<br><br>

<?php

      //insertoin code

       if(isset($_POST['Insert'])) 
       {
            //fetch data from Database
            $state=$_POST['txtstate'];

            if(empty($state))
            {
                $state_error='Please Enter State Name';
            }

            //insertion Query
            $ins="Insert into state(name)
                  values('$state')";
             
            $q=mysqli_query($con,$ins);
             
             if($q)
             {
                    echo "<script> alert('Data inserted')</script>";
             }
             else
             {
                    echo "<script> alert('Problem in Insertion')</script>";
             }
             //unset() for not insert data again if browser refresh or page refresh
             unset($_POST['Insert']);
             
       } 

 
       //Deletion code 

       if(isset($_REQUEST['Delete']))
        {
            //Deletion Query
            $delid=$_REQUEST['Delete'];
            $delete="Delete from state where sid='$delid'";
            $result=mysqli_query($con,$delete);
           
            if($result)
            {
                echo "<script>alert('Data Deleted')</script>";
                header("location:state.php");
            }
            else
            {
                 echo "<script>alert('Problem in Deletion')</script>";
            }
          
        }

       else
       {
         //echo "Button not click";
       } 
       
?>

<center>
    <table border="1" style="background-color:PowderBlue; border-radius:10px; width:80%">

        <tr>
            <th>State ID</th>
            <th>State Name</th>
            <th colspan="2" align="center">Action</th>
        </tr>

        <?php

                //select or fetch data from database for showing in table 

                $select="Select * from state";
                $ans=mysqli_query($con,$select);
                while($row=mysqli_fetch_array($ans))
                {
        ?>
                   <tr>
                        <td><?php echo $row['sid'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <!-- Rediction for Delete data -->
                        <td><a href="./state.php?Delete=<?php echo $row ['sid'];?>">  Delete </a></td>
                        <!-- Rediction for Update data -->
                    <td> <a href="updt_state.php?Update=<? echo $row ['sid'];?>">  Edit</a> </td>      
                   </tr>
                    
        <?php
                }   
        ?>

    </table>
</center>
