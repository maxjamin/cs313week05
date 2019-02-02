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

   /*$stmt = $db->prepare("SELECT username, login FROM Customer");
   $stmt->execute();

   // set the resulting array to associative
   $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
   foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
   }*/


}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

  	foreach ($db->query('SELECT username, login FROM Customer') as $row)
	{
	  echo 'user: ' . $row['username'];
	  echo ' login: ' . $row['login'];
	  echo '<br/>';
	}

	foreach ($db->query('SELECT name, email FROM Artist') as $row)
	{
	  echo 'name: ' . $row['name'];
	  echo ' Email: ' . $row['email'];
	  echo '<br/>';
	}






?>

</body>
</html> 