<?php include 'db_connection.php'?>
<?php

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$stmt = $conn->prepare("SELECT * FROM product");
$stmt->execute();
$laptops = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<title>PC Cartel - Products</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'assets.php'?>
	<?php include 'background.php'?>
        <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

<style>
	.product-img {
    height: 200px; /* set a fixed height */
    width: 100%; /* set a width of 100% to maintain aspect ratio */
    object-fit: cover; /* set the image to cover the entire container */
	}
</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<br>
    <div class="container mt-5">
	
	<div class="row row-cols-1 row-cols-md-3 g-4">
		<?php foreach ($laptops as $product): ?>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="card mb-4">
					<img src="<?php echo $product['image_url']; ?>" class="card-img-top product-img" alt="<?php echo $laptop['brand'] . ' ' . $laptop['model']; ?>">
					<div class="card-body">
						<h5 class="card-title"><?php echo $product['brand'] . ' ' . $product['model']; ?></h5>
						<p class="card-text">₱<?php echo $product['price']; ?></p>
						<form method="POST" action="">
							<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
							<input type="hidden" name="action" value="add">
							<button type="submit" class="btn btn-primary " id="add-to-cart-btn" onclick="addToCart(event)">
								Add to Cart
								<i class="bi bi-cart2"></i>
							</button>
						</form>

					</div>
				</div>
			</div>
		<?php endforeach; ?>
		<div class=" container d-flex"><p class="display-5">see more onsite</p></div>
	</div>
</div>

<!-- Add to cart alert script -->
<script>
	
	function addToCart(event) {
		event.preventDefault();
		var formData = new FormData(event.target.form);
		fetch('cart.php', {
			method: 'POST',
			body: formData
		}).then(function(response) {
			if (response.ok) {
				var alertDiv = document.createElement('div');
				alertDiv.classList.add('alert', 'alert-success', 'mt-3', 'alert-dismissible', 'fade', 'show');
				alertDiv.setAttribute('role', 'alert');
				alertDiv.innerHTML = '<button type="button" class="close" data-bs-dismiss="alert"" aria-label="Close"><span aria-hidden="true">&times;</span></button>Product added to cart!';
				event.target.closest('.card-body').appendChild(alertDiv);
			} else {
				console.error('Response not OK');
			}
		}).catch(function(error) {
			console.error(error);
		});
	}
</script>

<?php include 'footer.php'?>
</body>
</html>
