<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db = new SQLite3('./api/.db.db');

$db->exec("CREATE TABLE IF NOT EXISTS dns(id INTEGER PRIMARY KEY NOT NULL,portal1 VARCHAR(100),portal2 VARCHAR(100),portal3 VARCHAR(100),portal4 VARCHAR(100),portal5 VARCHAR(100),portal6 VARCHAR(100),portal7 VARCHAR(100),portal8 VARCHAR(100),portal9 VARCHAR(100),portal10 VARCHAR(100),portal11 VARCHAR(100),portal12 VARCHAR(100),portal13 VARCHAR(100),portal14 VARCHAR(100),portal15 VARCHAR(100),portal16 VARCHAR(100),portal17 VARCHAR(100),portal18 VARCHAR(100),portal19 VARCHAR(100),portal20 VARCHAR(100))");
$res = $db->query('SELECT * FROM dns');

if(isset($_GET['delete'])){
$db->exec("DELETE FROM dns WHERE id=".$_GET['delete']);
$db->close();
header("Location: dns.php");

}

include ('includes/header.php');

echo "<div class=\"main-panel\">\n";
echo "      <!-- Navbar -->\n";
echo "\n";
echo "    <div class=\"modal fade\" id=\"confirm-delete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";
echo "        <div class=\"modal-dialog\">\n";
echo "            <div class=\"modal-content\">\n";
echo "                <div class=\"modal-header\">\n";
echo "                    <font color=\"black\"><h2>Confirm</h2></font>\n";
echo "                </div>\n";
echo "                <div class=\"modal-body\">\n";
echo "                    <font color=\"black\">Do you really want to delete?</font>\n";
echo "                </div>\n";
echo "                <div class=\"modal-footer\">\n";
echo "                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>\n";
echo "                    <a class=\"btn btn-danger btn-ok\">Delete</a>\n";
echo "                </div>\n";
echo "            </div>\n";
echo "        </div>\n";
echo "    </div>\n";
echo "\n";
echo "\n";

            $row = $res->fetchArray();
            $id = $row["id"];
echo "<div id=\"main\">\n";
echo "   <br><h2>&nbsp;&nbsp;DNS</h2>\n";
echo "   &nbsp;&nbsp;&nbsp;&nbsp;<a id=\"button\"  href=\"./dns_create.php\" class=\"btn btn-warning\">Create</a>";
echo "<a style=\"margin-left:20px;\" href=\"./dns_update.php?update=$id\"><i class=\"fa fa-pencil-square-o\" style=\"font-size:24px;color:blue\"></i></a>&nbsp&nbsp&nbsp<a href=\"#\" data-href=\"./dns.php?delete=$id\" data-toggle=\"modal\" data-target=\"#confirm-delete\"><i class=\"fa fa-trash-o\" style=\"font-size:24px;color:red\"></i></a>";
echo "     </div>\n";
echo "      <div style='margin-top:20px; margin-left: 20px;'>\n";
            echo '<table><tr>';
            ?>
<div id="main" style="margin-top: 10px; text-align:left;">
    <table class="table table-dark" style="min-width: 700px;" cellspacing="10" cellpadding="10">
        <tr><td>ID</td><td>URL</td></tr>
        <?php
				{	echo (!empty($row['portal1']))?"<tr><th style='width: 60px'>DNS1</th><td>".$row['portal1']."</td></tr>":"";
					echo (!empty($row['portal2']))?"<tr><th>DNS2</th><td>".$row['portal2']."</td></tr>":"";
					echo (!empty($row['portal3']))?"<tr><th>DNS3</th><td>".$row['portal3']."</td></tr>":"";
					echo (!empty($row['portal4']))?"<tr><th>DNS4</th><td>".$row['portal4']."</td></tr>":"";
					echo (!empty($row['portal5']))?"<tr><th>DNS5</th><td>".$row['portal5']."</td></tr>":"";
					echo (!empty($row['portal6']))?"<tr><th>DNS6</th><td>".$row['portal6']."</td></tr>":"";
					echo (!empty($row['portal7']))?"<tr><th>DNS7</th><td>".$row['portal7']."</td></tr>":"";
					echo (!empty($row['portal8']))?"<tr><th>DNS8</th><td>".$row['portal8']."</td></tr>":"";
					echo (!empty($row['portal9']))?"<tr><th>DNS9</th><td>".$row['portal9']."</td></tr>":"";
					echo (!empty($row['portal10']))?"<tr><th>DNS10</th><td>".$row['portal10']."</td></tr>":"";
					echo (!empty($row['portal11']))?"<tr><th>DNS11</th><td>".$row['portal11']."</td></tr>":"";
					echo (!empty($row['portal12']))?"<tr><th>DNS12</th><td>".$row['portal12']."</td></tr>":"";
					echo (!empty($row['portal13']))?"<tr><th>DNS13</th><td>".$row['portal13']."</td></tr>":"";
					echo (!empty($row['portal14']))?"<tr><th>DNS14</th><td>".$row['portal14']."</td></tr>":"";
					echo (!empty($row['portal15']))?"<tr><th>DNS15</th><td>".$row['portal15']."</td></tr>":"";
					echo (!empty($row['portal16']))?"<tr><th>DNS16</th><td>".$row['portal16']."</td></tr>":"";
					echo (!empty($row['portal17']))?"<tr><th>DNS17</th><td>".$row['portal17']."</td></tr>":"";
					echo (!empty($row['portal18']))?"<tr><th>DNS18</th><td>".$row['portal18']."</td></tr>":"";
					echo (!empty($row['portal19']))?"<tr><th>DNS19</th><td>".$row['portal19']."</td></tr>":"";
					echo (!empty($row['portal20']))?"<tr><th>DNS20</th><td>".$row['portal20']."</td></tr>":"";
        }
        ?>
    </table>
</div>
<?
            
echo "                  <div style='margin-top:20px;'></div>\n";
echo "		</div>\n";
echo "\n";
echo "</div>\n";
echo "    <br><br><br>\n";
include ('includes/footer.php');
echo "<script>\n";
echo "$('#confirm-delete').on('show.bs.modal', function(e) {";
echo "    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));\n";
echo "});\n";
echo "</script>\n";
echo "</body>\n";
echo "\n";
echo "</html>\n";
?>
