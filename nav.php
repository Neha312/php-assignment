<html>
<style>
  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;

  }

  .topnav {
    overflow: hidden;
    background-color: LightGrey;
  }

  .topnav a {
    float: left;
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .topnav a:hover {
    background-color: YellowGreen;
    color: DarkSlateGray;
  }

  .topnav a.active {
    background-color: lightGray;
    color: white;
  }

  .topnav .icon {
    display: none;
  }

  @media screen and (max-width: 600px) {
    /* .topnav a:not(:first-child) {} */

    .topnav a.icon {
      float: right;
      display: block;
    }
  }

  .topnav.responsive {
    position: relative;
  }

  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }

  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }

  .bg-img {
    /* The image used */
    background-image: url("./nature1.jpg");
    width: 100%;
    height: 100vh !important;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

    /* Needed to position the navbar */
    position: relative;
  }
</style>

<body>
  <div class="container">
    <div class="topnav" id="myTopnav">
      <a href="user_dash.php" class="active">HOME</a>
      <a href="state.php">STATE </a>
      <a href="city.php">CITY</a>
      <a href="user_man.php">USER</a>
      </a>
    </div>
  </div>
</body>
<html>