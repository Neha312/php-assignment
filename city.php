<?php
//include a connection file
include('connection.php');
//include a Header file
include('nav.php');
//include a Footer file
include('footer.php');

?>

<html>

<head>
    <!-- Include a css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    // define variables to empty values  
    $sidErr = $cnameErr = $pincodeErr = "";
    $sid = $cname = $pincode = "";

    //Input fields validation  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //String Validation  
        if (empty($_POST["cname"])) {
            $cnameErr = "City Name is Required";
        } else {
            $city = input_data($_POST["city"]);
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
                $cityErr = "Only alphabets and white space are allowed";
            }
        }
    }
    function input_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <form action="" method="POST">
        <!-- Designing of City form -->
        <center>
            <h3>City Management</h3>
            <table class="table" border="0">
                <tr>
                    <td> STATE ID</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="sid">
                        <span class="error">* <?php echo $stateErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>CITY NAME</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="cname" required></td>
                </tr>
                <tr>
                    <td>PINCODE</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="pincode" required></td>
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
//code od insertion

if (isset($_POST['Insert'])) {
    if ($stateErr == "") {
        //fetch data from database
        $sid = $_POST['sid'];
        $cname = $_POST['cname'];
        $pincode = $_POST['pincode'];

        //insertion Query
        $ins = "Insert into city(sid,cname,pincode)
             values('$sid','$cname','$pincode')";
        $q = mysqli_query($con, $ins);

        if ($q) {
            echo "<script> alert('Data inserted')</script>";
        } else {
            echo  "<script> alert('Problem in Insertion')</script>";
        }
        //unset object for Not insert data again if browser refresh or page refresh
        unset($_POST['Insert']);
    }
}

//code of deletion

if (isset($_REQUEST['Delete'])) {
    //Deletion Query
    $delid1 = $_REQUEST['Delete'];
    $delete1 = "Delete from city where cid='$delid1'";
    $result1 = mysqli_query($con, $delete1);

    if ($result1) {
        echo "<script> alert('Data Deleted')</script>";
        header("location:city.php");
    } else {
        echo "<script> alert('Problem in deletion')</script>";
    }
} else {
    //echo "Button not click";
}

?>
<center>
    <table border="1" style="background-color:PowderBlue; border-radius:10px; width:80%">

        <tr>
            <th>CITY ID</th>
            <th>STATE ID</th>
            <th>CITY NAME</th>
            <th>PINCODE</th>
            <th colspan="2" align="center">Action</th>
        </tr>

        <?php
        //Select data from database for showing in table
        $select = "Select * from city";
        $ans = mysqli_query($con, $select);
        while ($row = mysqli_fetch_array($ans)) {
        ?>
            <tr>
                <td><?php echo $row['cid']; ?></td>
                <td><?php echo $row['sid']; ?></td>
                <td><?php echo $row['cname']; ?></td>
                <td><?php echo $row['pincode']; ?></td>
                <!-- Rediction for Delete data -->
                <td><a href="city.php?Delete=<?php echo $row['cid']; ?>"> Delete </a></td>
                <!-- Rediction for update data -->
                <td> <a href="updt_city.php?Update=<? echo $row['cid']; ?>"> Edit</a> </td>
            </tr>

        <?php
        }

        ?>


    </table>

</center>