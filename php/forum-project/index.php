<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log-in</title>
<style type="text/css">
@import url("style.css");
</style>
</head>
<body>
<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "forum_account";
    // Create Connection
    $conn = new MySQLi($hostname, $username, $password, $database);
    // Check Connection
    
    if($conn -> connect_error){
        die("Connection failed : " . $conn->connect_error);
    }

    // Getting ROW Syntax
    $sql = "SELECT ID, username, password, level FROM account";
    $result = $conn->query($sql);
    // Looping and Printing Data on all Rows
	//if($result -> num_rows > 0){
	//	while($row = $result->fetch_assoc()){
	//		print "ID : " . $row["ID"]. " - Name: " . $row["username"]. " Password : " . $row["password"]. " Level : " .$row["level"]. "<br>";
	//		}
	//	} else {
    //print "0 results";
	//}
    $conn->close();
    ?>
<div id="login">
  <div class="login_box">
    <form id="login_form" name="login_form" method="post">
      <div class="form_box_style">
        <div class="form_box_style">
          <p>
            <label for="username">Username:<br>
            </label>
            <input name="username" type="text" required="required" id="username" value="username" size="35" maxlength="16">
            <label for="password"><br><br>Password:<br>
            </label>
            <input name="password" type="password" required="required" id="password" value="1234" size="35" maxlength="32">
          </p>
        </div>
      </div>
      <p>
        <input type="checkbox" name="checkbox" id="checkbox">
        <label for="checkbox">Remember Me</label>
      </p>
      <p>
        <input name="submit" type="submit" id="submit" formaction="index.php" value="Log In"> 
        or  <a href="register.php"><input name="register" type="button" class="register_button" id="register" form="login_form" value="Register"></a></p>
    </form>
  </div>
</div>
</body>
</html>