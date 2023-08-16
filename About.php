<!DOCTYPE html>
<html>
<head>
	<title>PC Cartel - About us</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include 'assets.php'?>
	<?php include 'background.php'?>
    <style>
        .fixed-image {
            height: 300px;
            width: auto;
            padding: 10px;
            object-fit: cover;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>

</head>
<body>
	<?php include 'navbar.php'; ?>
    <h1 class="text-center mb-4" style="color: #000; text-shadow: #f1f2f3 1px 0 10px;">TEAM 5 - 404</h1>
	<div class="container mt-5">
		
		<div class="row row-cols-1 row-cols-md-3 g-4">
				<div class="col-sm-6 col-md-4">
					<div class="card h-100">
						<img src="img/team/jpadua.png" class="card-img-top fixed-image" alt="Jilmer Niel Isla Padua">
						<div class="card-body">
							<h5 class="card-title">Jilmer Niel Isla Padua</h5>
							<p class="card-text">UP-FB1-BSIT2-WEBDEV6 : SY2223-2S<br>Team Leader/Server-side Developer</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="card h-100">
						<img src="img/team/aballesteros.png" class="card-img-top fixed-image" alt="Al Leonard Ballesteros">
						<div class="card-body">
							<h5 class="card-title">Al Leonard Ballesteros</h5>
							<p class="card-text">UP-FB1-BSIT2-WEBDEV6 : SY2223-2S<br>Fronted Developer</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="card h-100">
						<img src="img/team/aespinoza.png" class="card-img-top fixed-image" alt="Angeline Arca Espinoza">
						<div class="card-body">
							<h5 class="card-title">Angeline Arca Espinoza</h5>
							<p class="card-text">UP-FB1-BSIT2-WEBDEV6 : SY2223-2S<br>Designer</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="card h-100">
						<img src="img/team/larenas.png" class="card-img-top fixed-image" alt="Lance Yestin Arenas">
						<div class="card-body">
							<h5 class="card-title">Lance Yestin Arenas</h5>
							<p class="card-text">UP-FB1-BSIT2-WEBDEV6 : SY2223-2S<br>Tester</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="card h-100">
						<img src="img/team/jcaoile.png" class="card-img-top fixed-image" alt="Nathan Caoile">
						<div class="card-body">
							<h5 class="card-title">Joel Nathan Caoile</h5>
							<p class="card-text">UP-FB1-BSIT2-WEBDEV6 : SY2223-2S<br>Tester</p>
						</div>
					</div>
				</div>
		</div>
	</div>
	<?php include 'footer.php' ?>
</body>
</html>
