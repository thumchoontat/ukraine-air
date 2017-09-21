<?php 
	if (!$validUser){
?>
<img src="<?php echo $resourceDir; ?>/img/plane.jpg" class="home-img"></img>
<div class="welcome">
	Ukraine International Airline
	<br/>
	<span class="subtitle">Flight booking system</span>
</div>
<?php
	}
	else{
?>
<div class="page-title">Ticket List</div>
<div class="content-md">
	<form method="POST" style="text-align:center;">
		<div class="input-group">
			<span class="input-group-addon">Booking Date From</span>
			<input type="date" class="form-control" name="book-from" value="<?php echo $bookFrom; ?>"/>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Booking Date To</span>
			<input type="date" class="form-control" name="book-to" value="<?php echo $bookTo; ?>"/>
		</div>
		<br/>
		<div class="input-group">
			<span class="input-group-addon">Flight Date From</span>
			<input type="date" class="form-control" name="flight-from" value="<?php echo $flightFrom; ?>"/>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Flight Date To</span>
			<input type="date" class="form-control" name="flight-to" value="<?php echo $flightTo; ?>"/>
		</div>
		<br/>
		<button class="btn btn-success">Search Tickets</button>
	</form>
	
	<?php 
		$tickets = getTickets($bookFrom, $bookTo, $flightFrom, $flightTo, $_SESSION['username']);
		$ticketCount = $tickets->num_rows;
	?>
	<table class="table">
		<thead>
			<tr>
				<th rowspan="2">No.</th>
				<th rowspan="2">Booking Date</th>
				<th rowspan="2">Passenger</th>
				<th rowspan="2">Seat</th>
				<th rowspan="2">Source</th>
				<th rowspan="2">Destination</th>
				<th colspan="2">Flight Time</th>
			</tr>
			<tr>
				<th>Departure</th>
				<th>Arrival</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			for ($i = 0; $i < $ticketCount; $i++){ 
				$ticket = $tickets->fetch_assoc();
		?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo $ticket['bookingDate']; ?></td>
				<td><?php echo $ticket['passengerName']; ?></td>
				<td><?php echo $ticket['seatID']; ?></td>
				<td><?php echo $ticket['source']; ?></td>
				<td><?php echo $ticket['destination']; ?></td>
				<td><?php echo $ticket['departureTime']; ?></td>
				<td><?php echo $ticket['arrivalTime']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<?php
	}
?>
