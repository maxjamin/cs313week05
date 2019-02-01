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

}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

  foreach ($db->query('SELECT username, login FROM Customer') as $row)
	{
	  echo 'user: ' . $row['username'];
	  echo ' login ' . $row['login'];
	  echo '<br/>';
	}

	$stmt = $db->prepare('SELECT * FROM Customer');
	$stmt->bindValue(':username', $username, PDO::PARAM_STR);
	$stmt->bindValue(':login', $login, PDO::PARAM_STR);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

</body>
</html> 