<?php
//include connection file
include('connection.php');

//fetching data from database 
$cid = $_REQUEST['Update'];
$select = "Select * from city where cid='$cid'";
$d1 = mysqli_query($con, $select);
$display1 = mysqli_fetch_array($d1);

//include Header
include('nav.php');

//Include footer
include('footer.php');
?>
<html>

<head>
    <!-- include a css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    // define variables to empty values  
    $sidErr = $cnameErr = $pincodeErr = "";
    $sid = $cname = $pincode = "";

    //Input fields validation
    //validation for city name  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //String Validation  
        if (empty($_POST["cname"])) {
            $cnameErr = "City Name is Required";
        } else {
            $cname = input_data($_POST["cname"]);
            // check if city name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/", $cname)) {
                $cnameErr = "Only alphabets and white space are allowed";
            }
        }
    }

    //validation for state id
    if (empty($_POST["sid"])) {
        $sidErr = "State id is required";
    } else {
        $sid = input_data($_POST["sid"]);
        // check if state id is well-formed  
        if (!preg_match("/^[0-9]*$/", $sid)) {
            $sidErr = "Only numeric value is allowed.";
        }
    }

    //validation for  pincode
    if (empty($_POST["pincode"])) {
        $pincodeErr = "Pincode is required";
    } else {
        $pincode = input_data($_POST["pincode"]);
        // check if pincode is well-formed  
        if (!preg_match("/^[0-9]*$/", $pincode)) {
            $pincodeErr = "Only numeric value is allowed.";
        }
        //check pincode length should not be less and greator than 10  
        if (strlen($pincode) != 6) {
            $pincodeErr = "Pincode is Required Conatain only 6 digit.";
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
            <h3>City Update</h3>
            <table class="table" border="0">
                <tr>
                    <td><input class="input" type="hidden" name="cid" value="<?php echo $display1['cid'] ?>">

                    </td>

                </tr>
                <td>State ID</td>
                <td>:</td>
                <td><input class="input" type="text" name="sid" value="<?php echo $display1['sid'] ?>">
                    <span class="error">* <?php echo $sidErr; ?> </span>
                </td>
                </tr>
                <tr>
                    <td>City Name</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="cname" value="<?php echo $display1['cname'] ?>">
                        <span class="error">* <?php echo $cnameErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Pincode</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="pincode" value="<?php echo $display1['pincode'] ?>">
                        <span class="error">* <?php echo $pincodeErr; ?> </span>
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
if (isset($_POST['Update'])) {
    //apply validation
    if ($cnameErr == "" && $sidErr == "" && $pincodeErr == "") {

        //fetch data from database
        $sid = $_POST['sid'];
        $cid = $_POST['cid'];
        $cname = $_POST['cname'];
        $pincode = $_POST['pincode'];

        //update query
        $updt = "Update city set sid='$sid',cname='$cname',pincode='$pincode' where cid='$cid' ";
        $q1 = mysqli_query($con, $updt);

        if ($q1) {
            echo "<script> alert('Data updated')</script>";
            header("location:city.php");
        } else {
            echo "<script> alert('Problem in Updation')</script>";
        }
    }
}
?>