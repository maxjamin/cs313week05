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



	/*$stmt = $db->prepare('SELECT * FROM Artwork');
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($rows as $table){
    	//Print the table name out onto the page.
    	echo $table['artwork_id'] . " " . $table['price'] . '<br>';
	}


	echo 'Test<br/>';
	$stmt = $db->prepare('SELECT username, login FROM Customer');
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($rows as $table){
    	//Print the table name out onto the page.
    	echo $table['username'] . " " . $table['login'] . '<br>';
	}*/

}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}	
?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		UserName:<input type="text" name="userNameEntered">
		Password:<input type="text" name="passwordEntered">
	</form>



</body>
</html> 