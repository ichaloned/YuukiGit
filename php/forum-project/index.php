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
	//Global Variable
	$incorrect = 0;	
	$set_cookies = 0;
	// Server Connection
    $hostname = "localhost";
    $root = "root";
    $pass = "";
    $database = "forum_account";
    // Create Connection
    $conn = new MySQLi($hostname, $root, $pass, $database);
    // Check Connection
    
    if($conn -> connect_error){
		die("Connection failed : " . $conn->connect_error);
    }

    // Getting ROW Syntax
    $sql = "SELECT ID, username, password FROM account";
    $result = $conn->query($sql);    
    
    if(isset($_POST["submit"]) and (!empty($_POST["password"]) and !empty($_POST["username"]))){
		$username = $_POST["username"];
		$password = $_POST["password"];
		if(isset($_POST["set_cookies"])){
			$set_cookies = $_POST["set_cookies"];
			}
		if($result -> num_rows > 0){
			while($row = $result->fetch_assoc()){
				if(($username == $row["username"]) and (md5($password) == $row["password"])){
					account_found($row["ID"], $set_cookies);
					break;
				}
			}
		} else {
			$incorrect = 1;
		}
	}
		
	function account_found($userID, $set_cookies){
		$cookies_name = "LogInfo";
		if($set_cookies != 1){
			setcookie($cookies_name, $userID, 0, "/");		// Delete cookies till browser closed (session cookies)
			header("Location: process.php");
			$conn->close();
			exit();
			}
		if($set_cookies == 1){
			setcookie($cookies_name, $userID, time() + (86400 * 30), "/");	// Delete cookies after 30 days (if "Remember Me" checked)
			header("Location: process.php");
			$conn->close();
			exit();
			}
	}
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
	<?php
	if($incorrect == 1){
          print '<p style="color: #FF3A3D">* Username/Password Salah!</p>';
		  }
	?>
        </div>
      </div>
      <p>
        <input name="set_cookies" type="checkbox" id="set_cookies" value="1">
        <label for="set_cookies">Remember Me</label>
      </p>
      <p>
        <input name="submit" type="submit" id="submit" formaction="index.php" formmethod="POST" value="Log In"> 
      or  <a href="register.php"><input name="register" type="button" class="register_button" id="register" form="login_form" value="Register"></a></p>
    </form>
  </div>
</div>
</body>
</html>