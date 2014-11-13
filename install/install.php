<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
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
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Błąd instalacji bazy danych, MySQL zwrócił: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Błąd wybierania bazy danych: ' . mysql_error());

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
    mysql_query($templine) or print('Błąd wykonywania zapytań \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Proces instalacji przebiegł poprawnie";
 
 $myfile = fopen("../protected/config/db.php", "w") or die("Unable to open file!");
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
 </body>
</html>