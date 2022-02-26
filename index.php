<?php
session_start();


if ($_SESSION['loggedin'] == True){header("location:"."dns.php");}

$db = new SQLite3('./api/.db.db');
$db->exec("CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY,username TEXT ,password TEXT)");

$rows = $db->query("SELECT COUNT(*) as count FROM users");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($numRows == 0){
	$db->exec("INSERT INTO users(id ,username, password) VALUES('1' ,'admin', 'admin')");
	}

if (isset($_POST["login"])){
	if(!$db){
		echo $db->lastErrorMsg();
	} else {
	}
	$sql ='SELECT * from users where username="'.$_POST["username"].'";';
	$ret = $db->query($sql);
	while($row = $ret->fetchArray() ){
		$id=$row['id'];
		$username=$row['username'];
		$password=$row['password'];
	}
	if ($id!=""){
		if ($password==$_POST["password"]){
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			header('Location: user.php');
		}else{
		header('Location: ./api/index.php');
		}
		}else{
		header('Location: ./api/index.php');
		}
	$db->close();
	}


////Get User IP
function real_ip() {
	$ip = 'undefined';
	if (isset($_SERVER)) {
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif (isset($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
	} else {
		$ip = getenv('REMOTE_ADDR');
		if (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
	}
	$ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
	return $ip;
}

$curr = basename($_SERVER['PHP_SELF']);
$page = substr($curr, 0, 3);


echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "\n";
echo "<head>\n";
echo "    <meta charset=\"utf-8\">\n";
echo "    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
echo "    <title>AppSolutions Mega Panel</title>\n";
echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\">\n";
echo "</head>\n";
echo "<style>\n";
echo "body {\n";
echo "	background-color: #343a40;\n";
echo "}\n";
echo "</style>\n";
echo "<body>\n";
echo "  <div class=\"wrapper \">\n";
echo "  <br><br><br>\n";
echo "	<div class=\"container\" style=\"margin-top:30px\">\n";
echo "	    <div style=\"width:400px; margin:0 auto;\">\n";
echo "		<div class=\"row\">\n";
echo "			<div class=\"center\">\n";
echo "			    <h1 class=\"text-center text-primary\">AppSolutions Mega Panel</h1>\n";
echo "				<h2 class=\"text-center text-primary\">Sign in</h2>\n";
echo "				<br>\n";
echo "				<div>\n";
echo "				    <div style=\"width:400px; margin:0 auto;\">\n";
echo "					<form method=\"post\">\n";
echo "					<input type=\"text\" class=\"form-control\" placeholder=\"Username\" name=\"username\" required autofocus><br>\n";
echo "					<input type=\"password\" class=\"form-control\" placeholder=\"Password\" name=\"password\" required><br>\n";
echo "					<button class=\"btn btn-lg btn btn-primary btn-block\" name=\"login\" type=\"submit\">Sign in</button>\n";
echo "					</form>\n";
echo "				</div>\n";
echo "			<div class=\"card-body\">\n";
echo "				<div class=\"panel-body\">\n";
echo "				<p class=\"text-primary\">Time Of Arrival: \"<i>";
echo  date('Y-m-d H:i:s');
echo "</i>\"</p>\n";
echo "				<p class=\"text-primary\">IP Address: \"<i>";
echo  real_ip();
echo" </i>\"</p>\n";
echo "			</div>\n";
echo "			</div>\n";
echo "		</div>\n";
echo "	</div>\n";
echo "	</div>\n";
echo "	</div>\n";
echo "	</div>\n";
echo "\n";
include ('includes/footer.php');
echo "</body>\n";
echo "\n";
echo "</html>\n";
?>
