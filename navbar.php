<?php include 'assets.php'?>

<style>
  body {
    padding-top: 80px; /* Height of the navbar */
}
.navbar {
  background-color: #1eaaf1;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 999; /* add this line */
}

    .navbar {
	background-color: #1eaaf1;
}

.navbar-brand{
  margin-left: 30px;
}

.navbar-dark .navbar-nav .nav-link {
	color: white;
}

.navbar-dark .navbar-nav .nav-link:hover {
	color: #f2844e;
}

@media (max-width: 576px) {
	.card-columns {
		column-count: 1;
	}
}

@media (min-width: 577px) and (max-width: 768px) {
	.card-columns {
		column-count: 2;
	}
}

@media (min-width: 769px) and (max-width: 992px) {
	.card-columns {
		column-count: 3;
	}
}

@media (min-width: 993px) {
	.card-columns {
		column-count: 4;
	}
}

/* Add the following CSS code */
.navbar-nav li:last-child {
  margin-left: auto;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #1eaaf1; position: fixed; top: 0; width: 100%;">
  <a class="navbar-brand" href="index.php">
    <img src="img/logo.png" alt="PC Cartel Logo" width="30" height="30">
    PC Cartel
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
        <i class="bi bi-house"></i>
          Home
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product.php">
        <i class="bi bi-shop"></i>
          Shop
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">
        <i class="bi bi-cart2"></i>
          Cart
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="About.php">
        <i class="bi bi-file-earmark-person-fill"></i>
          About us
        </a>
      </li>
    </ul>
  </div>
</nav>


