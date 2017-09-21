<div class="content-lg">
	<form method="POST" id="searchForm">
		<div class="input-group">
			<span class="input-group-addon">Departure Date</span>
			<input class="form-control" type="date" name="queryDate" value="<?php echo $queryDate; ?>"/>
			<span class="input-group-addon btn-success" id="searchFlight">
				<span class="glyphicon glyphicon-search"></span>
				Search
			</span>
		</div>
	</form>
	<table class="table">
		<thead>
			<tr>
				<th rowspan="2">No.</th>
				<th colspan="2">Source</th>
				<th colspan="2">Destination</th>
				<th rowspan="2">Departure Time</th>
				<th rowspan="2">Arrival Time</th>
				<th rowspan="2">Fare (UAH)</th>
			</tr>
			<tr>
				<th>City</th>
				<th>Code</th>
				<th>City</th>
				<th>Code</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$flights = getFlights($queryDate);
			$flightsCount = $flights->num_rows;
			
			for ($i = 0; $i < $flightsCount; $i++){
				$flight = $flights->fetch_assoc();
		?>
			<tr data-flightid="<?php echo $flight['flightID']; ?>">
				<td><?php echo $i + 1; ?></td>
				<td><?php echo $flight['sourceCity']; ?></td>
				<td><?php echo $flight['source']; ?></td>
				<td><?php echo $flight['destinationCity']; ?></td>
				<td><?php echo $flight['destination']; ?></td>
				<td><?php echo $flight['departureTime']; ?></td>
				<td><?php echo $flight['arrivalTime']; ?></td>
				<td><?php echo $flight['fare']; ?></td>
				<td class="hidden">
					<form method="POST" action="booking/seat">
						<input type="hidden" name="flightID" value="<?php echo $flight['flightID']; ?>"/>
					</form>
				</td>
			</tr>
		<?php } //END for ?>
		</tbody>
	</table>
</div>