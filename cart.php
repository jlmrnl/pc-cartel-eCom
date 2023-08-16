<?php include 'db_connection.php';?>

<?php
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id']; // Define the $id variable
    switch ($_POST['action']) {
        case 'add':
            $_SESSION['cart'][$id]++;
            break;
        case 'update':
            if ($_POST['quantity'] == 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id] = $_POST['quantity'];
            }
            break;
        case 'delete':
            unset($_SESSION['cart'][$id]);
            break;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>PC Cartel - Cart</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'assets.php'?>
    <?php include 'background.php'?>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0): ?>
            <p>NO ITEMS YET</p>
        <?php else: ?>
            <form method="post" action="cart.php">
                <table class="table table-striped">
                    <thead >
                        <tr>
                            <th>Image</th>
                            <th>Brand &amp; Model</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody id="cart-items">
    <?php 
    // Initialize the total price
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $id => $quantity): 
        $stmt = $conn->prepare("SELECT * FROM product WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $laptop = $stmt->fetch();
        // Calculate the price of this item and add it to the total price
        $itemPrice = $laptop['price'] * $quantity;
        $totalPrice += $itemPrice;
    ?>
        <tr>
            <td><img src="<?php echo $laptop['image_url']; ?>" class="img-thumbnail" style="max-width: 100px;"></td>
            <td><?php echo $laptop['brand'] . ' ' . $laptop['model']; ?></td>
            <td>₱<?php echo $laptop['price']; ?></td>
            <td>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="action" value="update">
                    <input class="pd-auto"type="number" name="quantity"  min="1" max="3" value="<?php echo $quantity; ?>">
                    <button  type="submit" class="btn btn-secondary btn-sm">
                    <i class="bi bi-check-lg"></i>
                    </button>
                </form>
            </td>
            <td>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash3"></i>
                        Drop
                    </button>
                </form>
            </td>
            
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="1"></td>
        <td>
            <h4 class="btnCheckout">Total:</h4>
        </td>
        <td colspan="2">
            <h4 id="total-price">₱<?php echo $totalPrice; ?></h4>
        </td>
        <td >
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-basket3"></i>
                Checkout
            </button>
        </td>
    </tr>
</tbody>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
          // Check if cart is not empty
          if(empty($_SESSION['cart'])) {
            echo "Your cart is empty.";
            exit;
          }

          // Retrieve the cart items
          $cartItems = $_SESSION['cart'];

          // Initialize the total amount
          $totalAmount = 0;

          // Display the cart items and calculate the total amount
          foreach($cartItems as $id => $quantity) {
            // Retrieve the laptop details from the database
            $stmt = $conn->prepare("SELECT * FROM product WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $laptop = $stmt->fetch();

            // Display the laptop details and the quantity
            echo "<p>" . $laptop['brand'] . " " . $laptop['model'] . " x " . $quantity . "</p>";

            // Add the laptop price times the quantity to the total amount
            $totalAmount += $laptop['price'] * $quantity;
          }

          // Create a unique order ID
          $orderId = uniqid();

          // Display the order details and the form
          echo "<p>Order ID: $orderId</p>";
          echo "<p>Total Amount: ₱" . number_format($totalAmount, 2) . "</p>";
        ?>
        <form method="post" action="confirm.php">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
          </div>
          <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
              <option value="GCASH">GCASH</option>
              <option value="credit_card">Credit Card</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
          </div>
          <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
          <button onclick="/confirm.php" type="submit" class="btn btn-primary" >Confirm Order</button>
        </form>
      </div>
    </div>
  </div>
</div>

								</td>
							</tr>
            </table>
    <?php endif; ?>
	
</div>
<script>
const cartItems = document.getElementById('cart-items');
const totalPrice = document.getElementById('total-price');

    cartItems.addEventListener('change', (event) => {
    const selectedProducts = cartItems.querySelectorAll('input[name="selected_product"]:checked');
    let total = 0;
    if (selectedProducts.length > 0) {
        selectedProducts.forEach((checkbox) => {
            const quantityInput = checkbox.closest('tr').querySelector('input[name="quantity"]');
            const quantity = parseInt(quantityInput.value);
            const price = parseFloat(quantityInput.closest('td').previousElementSibling.textContent.replace('₱', ''));
            total += quantity * price;
        });
    }
    totalPrice.textContent = `₱${total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

});

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php' ?>
</body>
</html> 
<?php
/**
 * Summary of calculate_total
 * @param mixed $cart
 * @param mixed $conn
 * @return int|string
 */
function calculate_total($cart, $conn) {
    if (empty($cart)) {
        return "0";
    }
    $total = 0;
    foreach ($cart as $id => $quantity) {
        $stmt = $conn->prepare("SELECT * FROM product WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $product = $stmt->fetch();
        $total += $product['price'] * $quantity;
    }
    return '₱' . number_format((float) $total, 2, '.', ',');
}
?>
