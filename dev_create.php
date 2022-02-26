<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('./api/.db.db');

if(isset($_POST['submit'])){
$db->exec("INSERT INTO dev(Title) VALUES('".$_POST['Title']."')");
$db->close();
header("Location: dev.php");
}
include ('includes/header.php');

echo "<div class=\"wrapper\">\n";
echo "<div class=\"main-panel\">\n";
echo "<div class=\"content\">\n";
echo "<div class=\"container-fluid\">\n";
echo "            <div class=\"col-md-8 px-4\">\n";
echo "              <div class=\"card bg-dark text-white\">\n";
echo "                <div class=\"card-header card-header-warning\">\n";
echo "                  <h4 class=\"card-title\">Add Developer Info</h4>\n";
echo "                </div>\n";
echo "                <div class=\"card-body\">\n";
echo "                  <form  method=\"post\">\n";
echo "                      <div>\n";
echo "                        <div class=\"form-group\">\n";
echo "                          <label class=\"bmd-label-floating\">Info</label>\n";
echo "                          <input type=\"text\" class=\"form-control\" name=\"Title\">\n";
echo "                        </div>\n";
echo "                      </div>\n";
echo "                      <div>\n";
echo "                      </div>\n";
echo "                      <div>\n";
echo "                     <input type=\"hidden\" name=\"CreateDate\"  value=\"".date("Y-m-d h:i:s")."\">\n";
echo "					<br><button type=\"submit\" name=\"submit\" class=\"btn btn-warning pull-right\">Submit</button>\n";
echo "				</form>\n";
echo "				</div>\n";
echo "              </div>\n";
echo "            </div>\n";
echo "    <br><br><br>\n";
include ('includes/footer.php');
echo "</body>\n";
echo "</html>\n";
?>
