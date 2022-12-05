<?php
//include connection file
include('connection.php');
//include Header File
include('nav.php');
//include Footer file
include('footer.php');
?>
<html>

<head>
    <!-- include a css file -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    //define variable for validation checking 
    $cidErr = $first_nameErr = $last_nameErr = $emailErr = $passwordErr = $addressErr = "";
    $cid = $first_name = $last_name = $email = $password = $address = "";

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

    //validation for password
    if (empty($_POST["password"])) {
        $passwordErr = "Paassword  required";
    } else {
        $password = input_data($_POST["password"]);
        // check if mobile no is well-formed
        if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8}$/", $password)) {
            $passwordErr = "At least one upper case  one lower case  special character & leght";
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
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <center>
            <h3>User Management</h3>
            <table class=" table" border="0">
                <tr>
                    <td>city Id</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="cid">
                        <span class="error">* <?php echo $cidErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Fisrt Name</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="first_name">
                        <span class="error">* <?php echo $first_nameErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="last_name">
                        <span class="error">* <?php echo $last_nameErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Email ID</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="email">
                        <span class="error">* <?php echo $emailErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input class="input" type="text" name="password">
                        <span class="error">* <?php echo $passwordErr; ?> </span>
                    </td>
                </tr>

                <tr>
                    <td>Address </td>
                    <td>:</td>
                    <td><input class="input" type="text" name="address">
                        <span class="error">* <?php echo $addressErr; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input class="submit" type="submit" name="Insert" value="Insert">
                    </td>
                </tr>
            </table>
        </center>
    </form>

</body>

</html>

<br><br>
<?php
//code of Insertion
if (isset($_POST['Insert'])) {
    //apply validation
    if ($cidErr == "" && $first_nameErr == "" && $last_nameErr == "" && $emailErr == "" && $addressErr == "" && $passwordErr == "") {
        //fetch data from database
        $cid = $_POST['cid'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];

        //insertion Query
        $ins = "Insert into user_info(cid,first_name,last_name,email,password,address)values($cid,'$first_name','$last_name','$email','$password','$address')";
        $q = mysqli_query($con, $ins);

        if ($q) {
            echo "<script> alert('Data inserted')</script>";
        } else {
            echo "<script> alert('Problem in Insertion')</script>";
        }
        //Unset() for not insert data  again if browser or page refresh
        unset($_POST['Insert']);
    } else {
        //echo "Button not click";
    }
}
//Deletion code
if (isset($_REQUEST['Delete'])) {
    //deletion Query
    $delid1 = $_REQUEST['Delete'];
    $delete1 = "Delete from user_info where did='$delid1'";
    $result1 = mysqli_query($con, $delete1);

    if ($result1) {
        header("location:user_man.php");
    } else {
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
            <th>Address</th>
            <th colspan="2" align="center">Action</th>
        </tr>

        <?php
        //select data from Database for showing data in table
        $select = "Select * from user_info";
        $ans = mysqli_query($con, $select);

        while ($row = mysqli_fetch_array($ans)) {
        ?>
            <tr>
                <td><?php echo $row['did']; ?></td>
                <td><?php echo $row['cid']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <!-- Rediction for Delete data -->
                <td><a href="./user_man.php?Delete=<?php echo $row['did']; ?>"> Delete </a></td>
                <!-- Rediction for Update data -->
                <td> <a href="updt_user.php?Update=<? echo $row['did']; ?>"> Edit</a> </td>


            </tr>

        <?php
        }
        ?>
    </table>
</center>