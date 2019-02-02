<?php	
	//Starting session
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Gallery</title>
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

?>
	<h1>Gallery</h1>
	<br>

	<div class="navbar">
		<a href="main.php">Login</a>
  		<a href="cart.php">Cart</a>
 		<a href="checkout.php">Checkout</a> 
	</div>
	<br>

	<?php
		if($_SESSION["sessionUserName"] !== "") {
			echo "User: " . $_SESSION["sessionUserName"] . '<br>';
			echo "User Email: " . $_SESSION["sessionUserEmail"] . '<br><br>';
		}

		$stmt = $db->prepare('SELECT * FROM Artwork');
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	?>	


	<table>
  		<tr>
    		<td>Name:</td>
   			<td>Description</td>
   			<td>Image:</td>
   			<td>Price:</td>
   		</tr>
  		<?php
		foreach($rows as $table){
			$image = "/artWorkImages/" . $table['linktoart'];

			echo '<tr><td>' .  $table['name'] .
				 "</td><td>" . $table['description'] .
				 "</td><td>" . ?><img src=image alt="" border=3 height=100 width=300></img></th><?php .
				 "</td><td>" . $table['price'] .
				'</td></tr>';
		} ?>



</body>
</html> 