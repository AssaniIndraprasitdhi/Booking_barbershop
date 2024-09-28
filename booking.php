<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['member_login'])) {
	header('location:views/signin.php');
}

$stmt_services = $conn->query("SELECT s.s_id, s.s_name, s.s_price, s.s_duration FROM services s");
$stmt_barbers = $conn->query("SELECT b_id, b_name FROM barber");
// Modified query to retrieve future bookings only
$stmt_booking = $conn->prepare("SELECT b.barber, b.date, b.time, s.s_price FROM booking b JOIN services s ON b.service = s.s_name WHERE b.date >= CURDATE()");

?>

<!DOCTYPE html>
<html>

<head>
	<title>Booking</title>
</head>
<!-- bootstrap Style CSS File -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Custom Style CSS File -->
<link rel="stylesheet" type="text/css" href="css/custom-style.css">
<link rel="stylesheet" type="text/css" href="css/loaders.css" />
<!-- Font-Awesome Style CSS File -->
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

<body>

	<!-- Page loading animation -->
	<div class="loader loader-bg">
		<div class="loader-inner ball-pulse">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>

	<!-- Top navigation -->
	<nav class="navbar navbar-expand-md top-nav bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.html"><strong>Barbershop</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"><img src="img/icons/menu.png"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto text-sm-center text-md-center">
					<li class="nav-item">
						<a class="nav-link" href="homepage.after.php#home">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="homepage.after.php#services">Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="homepage.after.php#price">Prices</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="booking_detail.php">Booking Detail</a>

					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php">Profile</a>
					</li>
				</ul>
				<a class="btn btn-primary text-white mr-3" href="views/signin.php">Sign out</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<h1 class="mb-4 mt-4">Booking</h1>
		<?php if (isset($_SESSION['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				<?php
				echo $_SESSION['error'];
				unset($_SESSION['error']);
				?>
			</div>
		<?php } ?>

		<?php if (isset($_SESSION['success'])) { ?>
			<div class="alert alert-success" role="alert">
				<?php
				echo $_SESSION['success'];
				unset($_SESSION['success']);
				?>
			</div>
		<?php } ?>
		<form action="control/booking.admin_db.php" method="POST">
			<div class="choose-service">
				<h4>Select Service:</h4>
				<fieldset class="choice">
					<?php
					echo '<table class="table table-striped" style="text-align:center">';
					echo '<tbody>';
					while ($row = $stmt_services->fetch(PDO::FETCH_ASSOC)) {
						echo '<tr>';
						echo '<td>' . $row["s_name"] . '</td>';
						echo '<td>' . $row["s_price"] . ' <span class="text-table">Bath</span></td>';
						echo '<td>' . $row["s_duration"] . ' <span class="text-table">min</span></td>';
						echo '<td>';
						echo "<input type='radio' id='service_" . $row['s_name'] . "' name='service' value='" . $row['s_name'] . "' required>";
						echo "<label for='service_" . $row['s_name'] . "'>Select</label>";
						echo '</td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
					?>
				</fieldset>
			</div><br>

			<div class="booking">
				<h4 class="ml-4">Schedule Of Barber:</h4>
				<fieldset class="schedule">
					<?php
					echo '<table class="table table-striped" style="text-align:center">';
					echo '<thead>';
					echo '<tr>';
					echo '<th style="text-align:center;">Barber</th>';
					echo '<th style="text-align:center;">Date</th>';
					echo '<th style="text-align:center;">Time</th>';
					echo '<th style="text-align:center;">Service Price</th>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';

					$currentDate = date('Y-m-d');

					$stmt_booking->execute();
					while ($row = $stmt_booking->fetch(PDO::FETCH_ASSOC)) {
						if ($row["date"] >= $currentDate) {
							echo '<tr>';
							echo '<td>' . $row["barber"] . '</td>';
							echo '<td>' . $row["date"] . '</td>';
							echo '<td>' . $row["time"] . '</td>';
							echo '<td>' . $row["s_price"] . '</td>';
							echo '</tr>';
						}
					}
					echo '</tbody>';
					echo '</table>';
					?>
				</fieldset>

				<div class="time-date">
					<div class="choose-barber">
						<h4 for="barber" class="">Select Barber:</h4>
						<select id="barber" name="barber" required>
							<?php
							while ($row = $stmt_barbers->fetch(PDO::FETCH_ASSOC)) {
								echo "<option value='" . $row['b_name'] . "'>" . $row['b_name'] . "</option>";
							}
							?>
						</select>
					</div><br>

					<div class="choose-date">
						<h4 for="date" class="ml-4">Date:</h4>
						<div class="d-date">
							<input type="date" id="date" name="date" min="<?= date('Y-m-d'); ?>" required>
						</div>
					</div><br>
				</div>
			</div>

			<div class="choose-time">
				<h4 class="time-choice ml-4">Select Time:</h4>
				<div class="d-time">
					<div class="slot1 mx-5">
						<input type="radio" id="slot_09_00" name="slottime[]" value="09:00">
						<label for="slot_09_00">09:00 AM</label>
						<input type="radio" id="slot_10_00" name="slottime[]" value="10:00">
						<label for="slot_10_00">10:00 AM</label>
						<input type="radio" id="slot_11_00" name="slottime[]" value="11:00">
						<label for="slot_11_00">11:00 AM</label>
						<input type="radio" id="slot_12_00" name="slottime[]" value="12:00">
						<label for="slot_12_00">12:00 AM</label>
					</div>

					<div class="slot2">
						<input type="radio" id="slot_01_00" name="slottime[]" value="01:00">
						<label for="slot_01_00">01:00 PM</label>
						<input type="radio" id="slot_02_00" name="slottime[]" value="02:00">
						<label for="slot_02_00">02:00 PM</label>
						<input type="radio" id="slot_03_00" name="slottime[]" value="03:00">
						<label for="slot_03_00">03:00 PM</label>
						<input type="radio" id="slot_04_00" name="slottime[]" value="04:00">
						<label for="slot_04_00">04:00 PM</label>
					</div>

					<div class="slot3">
						<input type="radio" id="slot_05_00" name="slottime[]" value="05:00">
						<label for="slot_05_00">05:00 PM</label>
						<input type="radio" id="slot_06_00" name="slottime[]" value="06:00">
						<label for="slot_06_00">06:00 PM</label>
						<input type="radio" id="slot_07_00" name="slottime[]" value="07:00">
						<label for="slot_07_00">07:00 PM</label>
						<input type="radio" id="slot_08_00" name="slottime[]" value="08:00">
						<label for="slot_08_00">08:00 PM</label>
					</div>

				</div>
			</div>
			<div class="submit">
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</div>

		</form>
	</div>

	<!-- Javascript Files  -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/core.js"></script>
</body>

</html>
