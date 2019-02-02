<!DOCTYPE html>
<html>
<head>
<title>05 Prove</title>
</head>
<body>

<h1>05 Prove</h1>
<br>

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


  	/*
	$stmt = $db->prepare('SELECT * FROM Artwork');
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

	$nameError = $passError = "";
	$name = $password = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty($_POST["userNameEntered"])) {
			$nameError = "Please enter a username";
		}else {
			$name = $_POST["userNameEntered"];
			//echo "Test name" . $name;
		}
		
		
		if(empty($_POST["passwordEntered"])) {
			$passError = "Please enter a username";
		}else {
			$password = $_POST["passwordEntered"];
			//echo "Test name" . $password;
		}
		
		echo 'Test<br/>';
		$stmt = $db->prepare('SELECT username, login FROM Customer');
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		foreach($rows as $table){
    		//Print the table name out onto the page.
    		echo $table['username'] . " " . $table['login'] . '<br>';
    		if(($name === $table['Username']) && ($password === $table['login']))
    		{
    			echo 'Test 777<br/>';
    		}
		}

	}


?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		UserName:<input type="text" placeholder="Enter Username" name="userNameEntered">
		<span class="error"><?php echo $nameError;?></span><br>
		Password:<input type="text" placeholder="Enter Password" name="passwordEntered">
		<span class="error"><?php echo $passError;?></span><br>
		<input type="submit" name="entered" value="submit">
	
		<br><br>
		<div class="container" style="background-color:#f1f1f1">
    		<button type="button" class="cancelbutton">Cancel</button>
    		<span class="passwordF">Forgot <a href="#">password?</a></span>
  		</div>
	</form>


</body>
</html> 