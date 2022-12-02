<?php
//include conection
include('connection.php');

//fetch data from database for dynamic selection of data
$sid = $_REQUEST['Update'];
$select = "Select * from state where sid='$sid'";
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

    // define variables to empty values  
    $stateErr = "";
    $state = "";

    //Input fields validation 
    //validation for state name 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //String Validation  
        if (empty($_POST["state"])) {
            $stateErr = "State Name is Required";
        } else {
            $state = input_data($_POST["state"]);
            // check if state name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/", $state)) {
                $stateErr = "Only alphabets and white space are allowed";
            }
        }
    }
    function input_data($data)
    {
        return $data;
    }

    ?>
    <!--Designing of Update page-->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <center>
            <h3>State Update</h3>
            <table class="table" border="0">
                <tr>
                    <td><input class="input" type="hidden" name="sid" value="<?php echo $display['sid'] ?>" /></td>
                    </td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="state" value="<?php echo $display['name'] ?>" />
                        <span class="error">* <?php echo $stateErr; ?> </span>
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
    //apply Validation 
    if ($stateErr == "") {
        //fetching data from database
        $sid = $_POST['sid'];
        $state = $_POST['state'];

        //update query
        $updt = "Update state set name='$state' where sid='$sid' ";
        $q1 = mysqli_query($con, $updt);

        if ($q1) {
            echo "<script> alert('Data updated')</script>";
            header("location:state.php");
        } else {
            echo "<script> alert('Problem in Updation')</script>";
        }
    }
}
?>