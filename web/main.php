<!DOCTYPE html>
<html>
<head>
<title>05 Prove</title>
</head>
<body>

<h1>05 Prove</h1>

<?php 

try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo 'the url ' . $dbUrl . ' The host ' . $dbHost . ' Port ' . $dbPort . ' User ' . $dbUser . ' The password ' . $dbPassword . ' Path ' . $dbName;


  foreach ($db->query('SELECT username, password FROM Customer') as $row)
	{
	  echo 'user: ' . $row['username'];
	  echo ' login ' . $row['login'];
	  echo '<br/>';
	}
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

?>

</body>
</html> 