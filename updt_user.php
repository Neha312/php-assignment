<?php
//include conection
include('connection.php');

//fetch data from database for dynamic selection of data
$did = $_REQUEST['Update'];
$select = "Select * from user_info where did='$did'";
$d = mysqli_query($con, $select);
$display = mysqli_fetch_array($d);

//include Header file
include('nav.php');

//include footer file
include('footer.php');
?>
<html>

<head>
    <!-- include a css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validateForm() {




            var x = document.forms["myform"]["cid"].value;
            if (isNaN(x)) {
                document.getElementById("cid").innerHTML = "Enter Numeric value only";
                return false;
            } else {
                return true;
            }

            // var x = document.forms["myform"]["first_name"].value;
            // if (x == "" || x == null) {
            //     alert("Enter Fisrt Name ");
            //     return false;
            // }

            var x = document.forms["myform"]["last_name"].value;
            if (x == "" || x == null) {
                alert("Enter Last Name ");
                return false;
            }

            var x = document.forms["myform"]["email"].value;
            if (x == "" || x == null) {
                alert("Enter Value ");
            } else {
                var atposition = x.indexOf("@");
                var dotposition = x.lastIndexOf(".");
                if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
                    alert("Please enter a valid e-mail address ");
                    return false;
                }
            }


            var x = document.forms["myform"]["address"].value;
            if (x == "" || x == null) {
                alert("Enter Address ");
                return false;
            }
        }
    </script>

</head>

<body>

    <!-- Designing for updation page -->
    <form name="myform" method="POST" onsubmit="return validateForm()">
        <center>
            <h3>User Update</h3>
            <table class="table" border="0">
                <tr>
                    <td><input class="input" type="hidden" name="did" value="<?php echo $display['did'] ?>"></td>
                </tr>
                <tr>
                    <td>city Id</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="cid" value="<?php echo $display['cid'] ?>" id="cid">

                    </td>
                </tr>
                <tr>
                    <td>Fisrt Name</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="first_name" value="<?php echo $display['first_name'] ?>">

                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="last_name" value="<?php echo $display['last_name'] ?>">

                    </td>
                </tr>
                <tr>
                    <td>Email ID</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="email" value="<?php echo $display['email'] ?>">

                    </td>
                </tr>
                <tr>
                    <td>Address </td>
                    <td>:</td>
                    <td><input class="input" type="text" name="address" value="<?php echo $display['address'] ?>">

                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input class="submit" type="submit" name="Update" value="Update">
                    </td>
                </tr>
            </table>
        </center>
    </form>
</body>

</html>

<?php
//code of updation

if (isset($_POST['Update'])) {

    //fetch data from database
    $did = $_POST['did'];
    $cid = $_POST['cid'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    //update query
    $updt = "Update user_info set cid='$cid',first_name='$first_name',last_name='$last_name',email='$email',address='$address' where did='$did' ";
    $q1 = mysqli_query($con, $updt);

    if ($q1) {
        // header ("Location:http://localhost/Task/user_man.php");
        echo "<script> alert('Data updated')</script>";
        header("location:user_man.php");
    } else {
        echo "<script> alert('Problem in Updation')</script>";
    }
}

?>