<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laptop";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Check if the form was submitted for creating or updating a product
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $id = $_POST['id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    
    // Handle image upload
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_file_name = 'img/' . uniqid() . '.' . $image_extension;
    move_uploaded_file($image_tmp_name, $image_file_name);

    if ($id == '') {
        // Insert a new product
        $sql = "INSERT INTO product (brand, model, price, image_url) VALUES ('$brand', '$model', '$price', '$image_file_name')";
        $conn->exec($sql);
    } else {
        // Update an existing product
        $sql = "UPDATE product SET brand='$brand', model='$model', price='$price', image_url='$image_file_name' WHERE id='$id'";
        $conn->exec($sql);
    }
}


// Check if the delete button was clicked
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql = "DELETE FROM product WHERE id='$id'";
    $conn->exec($sql);
}

// Retrieve the list of products
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
$products = $result->fetchAll();

// Close the database connection
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>PC Cartel - Admin</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'assets.php'?>
    <?php include 'navbar.php' ?>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-5">Admin</h1>

    <div class="row">
        <!-- Create/Update form -->
        <div class="col-md-4">
            <h2>Create/Update</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="">
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" class="form-control" id="brand" name="brand" required>
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" id="model" name="model" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>

    </div>

    <!-- Product list -->
    <div class="col-md-8">
        <h2>Product list</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Image URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><?= $product['brand'] ?></td>
                            <td><?= $product['model'] ?></td>
                            <td><?= number_format($product['price'], 2) ?></td>
                            <td><?= $product['image_url'] ?></td>
                            <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                                data-bs-target="#collapseCreateUpdateForm"
                                onclick="fillForm(<?= $product['id'] ?>, '<?= $product['brand'] ?>', '<?= $product['model'] ?>', <?= $product['price'] ?>, '<?= $product['image_url'] ?>')">
                                <?= $product['id'] ? 'Edit' : 'New' ?>
                            </button>

                                <form method="post" class="d-inline-block">
                                    <input type="hidden" name="delete" value="<?= $product['id'] ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- script for filling the create/update form with product data -->
<script>
    function fillForm(id, brand, model, price, image_url) {
        document.querySelector('input[name="id"]').value = id;
        document.querySelector('input[name="brand"]').value = brand;
        document.querySelector('input[name="model"]').value = model;
        document.querySelector('input[name="price"]').value = price;
        document.querySelector('input[name="image_url"]').value = image_url;
    }
</script>
<!-- script for collapsing the create/update form after submitting or cancelling -->
<script>
    let createUpdateForm = document.querySelector('#collapseCreateUpdateForm');
    createUpdateForm.addEventListener('hidden.bs.collapse', function () {
        document.querySelector('input[name="id"]').value = '';
        document.querySelector('input[name="brand"]').value = '';
        document.querySelector('input[name="model"]').value = '';
        document.querySelector('input[name="price"]').value = '';
        document.querySelector('input[name="image_url"]').value = '';
    });
</script>
<!-- Bootstrap 5 JavaScript dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php' ?>
</body>
</html>
