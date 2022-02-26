<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('./api/.db.db');

$res = $db->query("SELECT * 
				  FROM users 
				  WHERE id='1'");
$row=$res->fetchArray();

if(isset($_POST['submit'])){
$db->exec("UPDATE users 
			SET	username='".$_POST['username']."', 
				password='".$_POST['password']."' 
			WHERE 
				id='1' ");
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			header("Location: dns.php");
}
$user = $row['username'];
$pass = $row['password'];
include ('includes/header.php');
echo "            <div class=\"col-md-4 px-4\">\n";
echo "              <div class=\"card bg-dark text-white\">\n";
echo "                <div class=\"card-header card-header-warning\">\n";
echo "                  <h4 class=\"card-title\">Change Username & Password</h4>\n";
echo "				  <p class=\"card-category\">Current User/Pass is shown</p>\n";
echo "                </div>\n";
echo "                <div class=\"card-body\">\n";
echo "                  <form  method=\"post\">\n";
echo "                        <div class=\"form-group\">\n";
echo "                          <label class=\"bmd-label-floating\">Username</label>\n";
echo "                          <input type=\"text\" class=\"form-control\" name=\"username\" value=\"$user\">\n";
echo "                        </div>\n";
echo "                        <div class=\"form-group\">\n";
echo "                          <label class=\"bmd-label-floating\">Password</label>\n";
echo "                          <input type=\"text\" class=\"form-control\" name=\"password\" value=\"$pass\">\n";
echo "                        </div>\n";
echo "					<br><button type=\"submit\" name=\"submit\" class=\"btn btn-primary pull-right\">Submit</button>\n";
echo "				</form>\n";
echo "				</div>\n";
echo "              </div>\n";
echo "            </div>\n";
echo "    <br><br><br>\n";
include ('includes/footer.php');
echo "</body>\n";
echo "\n";
echo "</html>\n";
?>