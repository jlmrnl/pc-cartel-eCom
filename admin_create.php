<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laptop";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Add this line for error handling

// Create the 'product' table
$sql = "CREATE TABLE IF NOT EXISTS product (
    id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    price VARCHAR(50) NOT NULL,
    image_url VARCHAR(255) NOT NULL
)";

// Execute the SQL query
$conn->exec($sql);

// Set the initial product ID to 0 for new products
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// If the form was submitted, insert or update the product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    if ($id) {
        // Update an existing product
        $stmt = $conn->prepare("UPDATE product SET brand=?, model=?, price=?, image_url=? WHERE id=?");
        $stmt->execute([$brand, $model, $price, $image_url, $id]);
    } else {
        // Insert a new product
        $stmt = $conn->prepare("INSERT INTO product (brand, model, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$brand, $model, $price, $image_url]);
        $id = $conn->lastInsertId();
    }

    // Redirect to the product list page
    header("Location: admin.php");
    exit();
}

// If the product ID is set, get the product data from the database
if ($id) {
    $stmt = $conn->prepare("SELECT * FROM product WHERE id=?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
} else {
    $product = array('brand' => '', 'model' => '', 'price' => '', 'image_url' => '');
}
?>
