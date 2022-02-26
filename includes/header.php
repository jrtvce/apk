<?php
session_start();
$db = new SQLite3('./api/.db.db');
$log_check = $db->query("SELECT * FROM users WHERE id='1'");
$roe = $log_check->fetchArray();
$curr = basename($_SERVER['PHP_SELF']);
$page = substr($curr, 0, 3);

if (!isset($_SESSION['loggedin'])) {
	header("location:"."index.php");
	exit();
}


echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "\n";
echo "<head>\n";
echo "    <meta charset=\"utf-8\">\n";
echo "    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
echo "    <title>AppsnScripts MEGA PANEL</title>\n";
echo "	<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css\">\n";
echo "	<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\">\n";
echo "</head>\n";
echo "<style>\n";
echo "body {\n";
echo "    padding-top: 56px;\n";
echo "	background-color: black;\n";
echo "	color: white\n";
echo "}\n";
echo "\n";
echo "table {\n";
echo "color: white;}\n";
echo "\n";
echo ".sticky-offset {\n";
echo "    top: 56px;\n";
echo "}\n";
echo "\n";
echo "#body-row {\n";
echo "    margin-left:0;\n";
echo "    margin-right:0;\n";
echo "}\n";
echo "#sidebar-container {\n";
echo "    min-height: 100vh;   \n";
echo "    background-color: #333;\n";
echo "    padding: 0;\n";
echo "}\n";
echo "\n";
echo "/* Sidebar sizes when expanded and expanded */\n";
echo ".sidebar-expanded {\n";
echo "    width: 230px;\n";
echo "}\n";
echo ".sidebar-collapsed {\n";
echo "    width: 60px;\n";
echo "}\n";
echo "\n";
echo "/* Menu item*/\n";
echo "#sidebar-container .list-group a {\n";
echo "    height: 50px;\n";
echo "    color: white;\n";
echo "}\n";
echo "\n";
echo "/* Submenu item*/\n";
echo "#sidebar-container .list-group .sidebar-submenu a {\n";
echo "    height: 45px;\n";
echo "    padding-left: 30px;\n";
echo "}\n";
echo ".sidebar-submenu {\n";
echo "    font-size: 0.9rem;\n";
echo "}\n";
echo "\n";
echo ".menu {\n";
echo "  background-color: #343a40;\n";
echo "  color: white;\n";
echo "  padding: 14px 25px;\n";
echo "  text-align: center;\n";
echo "  text-decoration: none;\n";
echo "  display: inline-block;\n";
echo "}\n";
echo "\n";
echo ".menu:hover {\n";
echo "  background-color: black;\n";
echo "  color: white;\n";
echo "}\n";
echo "\n";
echo "\n";
echo "</style>\n";
echo "<!DOCTYPE html>\n";
echo "<html lang=\"en\">\n";
echo "<!-- Bootstrap NavBar -->\n";
echo "<nav class=\"navbar navbar-expand-md navbar-dark bg-dark fixed-top\">\n";
echo "    <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNavDropdown\" aria-controls=\"navbarNavDropdown\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\n";
echo "        <span class=\"navbar-toggler-icon\"></span>\n";
echo "    </button>\n";
echo "    <a class=\"navbar-brand\">\n";
echo "        <img src=\"./images/logo.png\" width=\"40\" height=\"40\" class=\"d-inline-block align-top\" alt=\"\">\n";
echo "        <span class=\"menu-collapsed\">AppsnScripts MEGA PANEL</span>\n";
echo "    </a>\n";
echo "    <div class=\"collapse navbar-collapse\" id=\"navbarNavDropdown\">\n";
echo "        <ul class=\"navbar-nav\">\n";
echo "                <br>\n";
echo "                <a class=\"menu\" href=\"./dns.php\">DNS Management</a><br><br>\n";
echo "                <a class=\"menu\" href=\"./requests.php\">Login Requests</a><br><br>\n";
echo "                <a class=\"menu\" href=\"https://clients.vpnshop.co.uk/cart.php?a=add&pid=30\">Buy Vpn Panel</a><br><br>\n";
echo "                <a class=\"menu\" href=\"./dev.php\">Notes</a><br><br>\n";
echo "                <a class=\"menu\" href=\"./user_update.php\">Change Password</a><br><br>\n";
echo "                <a class=\"menu\" href=\"./logout.php\">Logout</a>\n";
echo "\n";
echo "        </ul>\n";
echo "    </div>\n";
echo "</nav>\n";
echo "<!-- NavBar END -->\n";
echo "\n";
echo ' <style>
table{
    table-layout: fixed;
}

td{
    word-wrap:break-word
}
.main{
	padding-top: 25px;
}
</style>';
echo "<!-- Bootstrap row -->\n";
?>
