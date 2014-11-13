<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Instalacja bazy danych</title>
         <link href="../js/libs/twitter-bootstrap/css/bootstrap.css" rel="stylesheet" />
         <script src="../js/jquery-1.11.1.min.js"></script>
         <script src="../js/libs/twitter-bootstrap/js/bootstrap.min.js"></script>
         <style>
             .bg-white {
                 background: #FFF;
             }
             .home-section {
                 width: 100%;
                 padding: 90px 0px 150px 0px;
             }
             section {
                 display: block;
             }
             .section-heading {
                 margin-bottom: 70px;
             }
             .section-heading h2 {
                 font-size: 38px;
                 text-transform: uppercase;
             }
         </style>
    </head>
    <body>
        <section class="home-section bg-white">
            <div class="container">  
                <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="section-heading"><center>
<?php

// Name of the file
$filename = 'db_install.sql';
// MySQL host
$mysql_host = $_POST['host'];
// MySQL username
$mysql_username = $_POST['username'];
// MySQL password
$mysql_password = $_POST['password'];
// Database name
$mysql_database = $_POST['database'];
// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('<div class="alert alert-danger" role="alert"><h2><strong>Błąd instalacji bazy danych, MySQL zwrócił: <br />' . mysql_error().'</strong></h2></div>');
// Select database
mysql_select_db($mysql_database) or die('<div class="alert alert-danger" role="alert"><h2><strong>Błąd wybierania bazy danych: <br />' . mysql_error().'</strong></h2></div>');

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('<div class="alert alert-danger" role="alert"><h2><strong>Błąd wykonywania zapytań \'<strong>' . $templine . '\': ' . mysql_error() . '</strong></h2></div><br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo '<div class="alert alert-success" role="alert"><h2><strong>Proces instalacji przebiegł poprawnie</strong></h2><br /><br /><br /> Proszę usunąć katalog "<i><b>install</b></i>" z serwera! <br /><br /> Domyślne dane do logowania: <b>login:</b> <strong><i>admin</i></strong>, <b>hasło:</b> <strong><i>god</i></strong></div>';
 
 $myfile = fopen("../protected/config/db.php", "w") or die("<h2>Błąd pliku!</h2>");
 $txt = '<?php ';
 fwrite($myfile, $txt);
 $txt = '$host = "'.$_POST['host'].'"; ';
 fwrite($myfile, $txt);
 $txt = '$dbname = "'.$_POST['database'].'"; ';
 fwrite($myfile, $txt);
 $txt =	'$username = "'.$_POST['username'].'"; ';
 fwrite($myfile, $txt);
 $txt = '$password = "'.$_POST['password'].'"; '; 
 fwrite($myfile, $txt);
 $txt = '?>'; 
 fwrite($myfile, $txt);
fclose($myfile);
?>
                        </center></div>
                </div>
                </div>
            </div>
        </section>
 </body>
</html>