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
</head>

<body>
    <?php
    $cidErr = $first_nameErr = $last_nameErr = $emailErr = $addressErr = "";
    $cid = $first_name = $last_name = $email = $address = "";

    //Input fields validation
    //validation for first name
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //String Validation
        if (empty($_POST["first_name"])) {
            $first_nameErr = "First Name Required";
        } else {
            $first_name = input_data($_POST["first_name"]);
            // check if first name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
                $first_nameErr = "Only alphabets and white space are allowed";
            }
        }
    }

    //validation for Last name
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //String Validation
        if (empty($_POST["last_name"])) {
            $last_nameErr = "Last Name  Required";
        } else {
            $last_name = input_data($_POST["last_name"]);
            // check if last name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
                $last_nameErr = "Only alphabets and white space are allowed";
            }
        }
    }

    //Validation for city id
    if (empty($_POST["cid"])) {
        $cidErr = "city id required";
    } else {
        $cid = input_data($_POST["cid"]);
        // check ifcity id is well-formed
        if (!preg_match("/^[0-9]*$/", $cid)) {
            $cidErr = "Only numeric value is allowed.";
        }
    }

    //validation for Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = input_data($_POST["email"]);
        // check that the e-mail address is well-formed  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    //Validation for address
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //String Validation
        if (empty($_POST["address"])) {
            $addressErr = "Address Required";
        } else {
            $address = input_data($_POST["address"]);
            // check if address only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $address)) {
                $addressErr = "Only alphabets and white space are allowed";
            }
        }
    }

    //method for fetching data
    function input_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <!-- Designing for updation page -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                        <span class="error">* <?php echo $cidErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Fisrt Name</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="first_name" value="<?php echo $display['first_name'] ?>">
                        <span class="error">* <?php echo $first_nameErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="last_name" value="<?php echo $display['last_name'] ?>">
                        <span class="error">* <?php echo $last_nameErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Email ID</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="email" value="<?php echo $display['email'] ?>">
                        <span class="error">* <?php echo $emailErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Address </td>
                    <td>:</td>
                    <td><input class="input" type="text" name="address" value="<?php echo $display['address'] ?>">
                        <span class="error">* <?php echo $addressErr; ?> </span>
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

    if ($cidErr == "" && $first_nameErr == "" && $last_nameErr == "" && $emailErr == "" && $addressErr == "") {
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
}

?>