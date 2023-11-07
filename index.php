<?php
	include 'php/connection.php';
	session_start();
	@$userId = $_POST['user_id'];
	$shopping_kart_icon = "
	<a href=\"http://www.cyfer.com/cart.php\">
		<button class=\"round-btn\">
			<i class=\"fa-solid fa-cart-shopping\"></i>
		</button>
	</a>";
	$login_icon = "
	<a href=\"login.php\">
		<button class=\"round-btn\">
			<i class=\"fas fa-lock\" ></i>
		</button>
	</a>";
	$my_orders_icon = "
	<a href=\"orderHistory.php\">
		<button class=\"round-btn\">
			<i class=\"fa-solid fa-bag-shopping\"></i>
		</button>
	</a>";
	$logout_icon = "
	<a href=\"php/logout.php\">
		<button class=\"round-btn\">
			<i class=\"fa-solid fa-right-from-bracket\" ></i>
		</button>
	</a>";
	if(isset($_SESSION['Admin_id'])) {
		$products_page = "<a href=\"http://www.cyfer.com/admin.php\">Productos</a>";
	}
	else {
		$products_page = "<a href=\"http://www.cyfer.com/products.php\">Productos</a>";
	}

	$title = "Historial de ordenes";
	
	if(isset($userId)) {
		$sql = "SELECT * FROM user_purchases WHERE userId = $userId";
		$result = $conn->query($sql);
		$conn->close();
	}
	else {
		$title = "Archivos";
		$sql = "SELECT * FROM user_purchases";
		$result = $conn->query($sql);
		$conn->close();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="styles.css" rel="stylesheet">
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<title>CyFer - Tienda de tecnología</title>
</head>
<body>
	<div class="viewGrid">
		<div class="navBar">
			<a href="http://www.cyfer.com/index.php">Inicio</a>
			<?php
			echo $products_page;
			?>
			<a href="location.php">Ubicación</a>
			<?php
			if(isset($_SESSION['User_id']) || isset($_SESSION['Admin_id'])) {
				echo $logout_icon;
				if(isset($_SESSION['User_id'])) {
					echo $shopping_kart_icon;
					echo $my_orders_icon;
				}
			}
			else {
				echo $login_icon;
			}
			?>
		</div>
		<div class="mainView">
			<div class="productHolder">
				<h1><?php echo $title; ?></h1>
				<?php
                while($rows=$result->fetch_assoc()) {
                ?>
				<div class="clientProductsTable">
				    <h2><?php echo $rows['filename'];?></h2>
				    <div class="actions">

					<form action=<?php echo "\"" . $rows['filename'] . "\""; ?> method="POST">
						<input hidden=true name="filename" type="text" value="<?php echo $rows['filename']; ?>" ></input>
						<button type="submit">Descargar</button>
					</form>
                    </div>
				</div>
                <?php
                }
                ?>
			</div>
		</div>
	</div>
	<footer>
		<div class="footer-element">
			<h4>Contacto</h4>
			<div>
				<div class="inline-elements">
					<i class="fa-solid fa-envelope"></i>
					<h5>contacto@cyfer.mx</h5>
				</div>
				<div class="inline-elements">
					<i class="fa-solid fa-phone"></i>
					<h5>+52 3343075456</h5>
				</div>
			</div>
		</div>
		<div class="footer-element">
			<h4>Redes sociales</h4>
			<div>
				<div class="inline-elements">
					<i class="fa-brands fa-facebook"></i>
					<h5>CyFer</h5>
				</div>
				<div class="inline-elements">
					<i class="fa-brands fa-twitter"></i>
					<h5>CyFer</h5>
				</div>
				<div class="inline-elements">
					<i class="fa-brands fa-instagram"></i>
					<h5>CyFer</h5>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>