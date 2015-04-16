<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
@import url("style.css");
</style>
</head>

<body>
<?php 
    $hostname = "localhost";
    $root = "root";
    $pass = "";
    $database = "forum_account";
    // Create connection
    $conn = new MySQLi($hostname, $root, $pass, $database);
    // Check connection
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
	// Syncing
    $sql = "SELECT ID, nama_lengkap FROM account";
    $result = $conn->query($sql);
	
	$cookies_name = "LogInfo";
	if(!isset($_COOKIE[$cookies_name])){
		header("Location: index.php");
		exit();
		} else {
			while($row = $result->fetch_assoc()){
				if($_COOKIE[$cookies_name] == $row["ID"]){
					$full_name = $row["nama_lengkap"];
					break;
					}
				}
		}
?>
<div class="info_box">
  <p>Selamat Datang,</p>
  <p style="color: #FF7E80"><?php print $full_name ?></p>
  <p>login telah berhasil</p>
</div>
</body>
</html>