<?php
	//Starting session
	session_start();
	$_SESSION["sessionUserName"] = "";
?>
<!DOCTYPE html>
<html>
<head>
<title>05 Prove</title>
	<meta charset="UTF-8">
	<link rel = "stylesheet" type = "text/css" href = "myStyle.css" />
</head>
<body>
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
		
		//echo 'Test<br/>';
		$stmt = $db->prepare('SELECT * FROM Customer');
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		foreach($rows as $table){
    		if($name === $table['username'] && $password === $table['login'])
    		{
    			//echo 'Test 777 ' . $table['email'] . " " . $table['user_id'] ;
    			$_SESSION["sessionUserName"] = $table['username'];
    			$_SESSION["sessionUserEmail"]= $table['email'];
    			$_SESSION["sessionUserId"]   = $table['user_id'];

    		}
		}

	}

?>
	<h1>05 Prove</h1>
	<br>

	<div class="navbar">
  		<a href="menu.php">Gallery</a>
  		<a href="cart.php">Cart</a>
 		<a href="checkout.php">Checkout</a> 
	</div>
	<br>

	<?php
		if($_SESSION["sessionUserName"] !== "") {
			echo "User: " . $_SESSION["sessionUserName"] . '<br>';
			echo "User Email: " . $_SESSION["sessionUserEmail"] . '<br><br>';
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