<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
<style type="text/css">
@import url("style.css");
</style>
</head>
<body>
<?php 
    $password_match = 0;
    $email_match = 0;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forum_account";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    if(isset($_POST["submit"]) and (!empty($_POST["full_name"]) & !empty($_POST["username"]) & !empty($_POST["password"]) & !empty($_POST["conf_password"]) & !empty($_POST["email"]) & !empty($_POST["conf_email"]))){
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        
        if(isset($_POST["submit"]) & (($_POST["password"]) != ($_POST["conf_password"]))){
            $password_match = 1;
        } else {
            
            if(isset($_POST["submit"]) & (($_POST["email"]) != ($_POST["conf_email"]))){
                $email_match = 1;
            } else {
                $email_match = 0;
                $sql = "INSERT INTO account(username, password, level, email, nama_lengkap)
			    VALUES('$username', '$password', '1', '$email', '$full_name')";
                
                if ($conn->query($sql) === TRUE) {
                    echo '<p class="keterangan">Registrasi Sukses</p>';
                } else {
                    echo '<p class="keterangan">Error: ' . $sql . '<br>' . $conn->error . '</p>';
                }

                $conn->close();
            }

        }

    }

    ?>
<div id="register" class="register_box">
  <form method="post">
    <p><strong>Registration Form</strong></p>
    <p>
      <label for="password">Nama Lengkap<br>
      </label>
      <input name="full_name" type="text" required="required" id="full_name" title="sds" size="40" maxlength="50">
    </p>
  <p class="keterangan">Contoh : Budi Darmawan</p>
  <p>
  	<label for="password">Username<br>
</label>
    <input name="username" type="text" required="required" id="username" size="40" maxlength="16">
  </p>
  <p><span class="keterangan">tampilan nama untuk public (nickname)</span></p>
  <p>
    <label for="password">Password<br>
</label>
    <input name="password" type="password" required="required" id="password" size="40" maxlength="32">
  </p>
  <p><span class="keterangan"> (max: 32 char)</span></p>
  <p>
    <label for="conf_password">Confirm Password<br>
    </label>
    <input name="conf_password" type="password" required="required" id="conf_password" size="40" maxlength="32">
  </p>
  <p><span class="keterangan">masukkan kembali password</span></p>
  <p>
    <label for="email">Email    <br>
    </label>
    <input name="email" type="email" required="required" id="email" size="40" maxlength="50">
  </p>
  <p><span class="keterangan">Contoh : budi_keren@gmail.com</span></p>
  <p>
    <label for="conf_email">Confirm Email    <br>
    </label>
    <input name="conf_email" type="email" required="required" id="conf_email" size="40" maxlength="50">
  </p>
  <p><span class="keterangan">masukkan kembali email</span></p>
<?php 
    
    if($password_match == 1){
        print '<p style="color: #FF3A3D">*Password tidak sama</p>';
    }

    
    if($email_match == 1){
        print '<p style="color: #FF3A3D">*Email tidak sama</p>';
    }

    ?>
  <p>
    <input name="submit" type="submit" id="submit" formaction="register.php" formmethod="POST" value="Register">
    </p>
</div>  
</form>
<div id="register">
</div>
</body>
</html>