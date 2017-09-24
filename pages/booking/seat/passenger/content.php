<div class="content-md">
	<form method="POST">
		<input type="hidden" name="flightID" value="<?php echo $flightID; ?>"/>
		<?php foreach($seats as $seat){ ?>
			<input type="hidden" name="seats[]" value="<?php echo $seat; ?>"/>
		<?php } ?>
		<?php 
			$flightInfo = getFlightInfo($flightID)->fetch_assoc();
		?>
		<div class="input-group">
			<span class="input-group-addon">Source</span>
			<input 
				class="form-control"
				type="text" 
				value="<?php echo $flightInfo['sourceCity'].' ('.$flightInfo['source'].')'; ?>" 
				disabled="disabled"
			/>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Destination</span>
			<input 
				class="form-control"
				type="text" 
				value="<?php echo $flightInfo['destinationCity'].' ('.$flightInfo['destination'].')'; ?>" 
				disabled="disabled"
			/>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Departure Time</span>
			<input 
				class="form-control"
				type="text" 
				value="<?php echo $flightInfo['departureTime']; ?>" 
				disabled="disabled"
			/>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Arrival Time</span>
			<input 
				class="form-control"
				type="text" 
				value="<?php echo $flightInfo['arrivalTime']; ?>" 
				disabled="disabled"
			/>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Fare</span>
			<input 
				class="form-control"
				type="text" 
				value="<?php echo 'UAH '.$flightInfo['fare']; ?>" 
				disabled="disabled"
			/>
		</div>
		<br/>
		<?php 
			$lockedSeats = getLockedSeats($flightID, $_SESSION['username']);
			$lockedSeatCount = $lockedSeats->num_rows;
			
			for ($i = 0; $i < $lockedSeatCount; $i++){
				$lockedSeat = $lockedSeats->fetch_assoc();
				$name = '';
				if ($passengers !== null && isset($passengers[$i])){
					$name = $passengers[$i];
				}
		?>
		<div class="input-group">
			<span class="input-group-addon">Seat <?php echo $lockedSeat['seatID'].'-'.$lockedSeat['col']; ?></span>
			<input 
				type="text"
				class="form-control"
				name="passenger[]"
				value="<?php echo $name; ?>"
				placeholder="Passenger Name"
				data-toggle="popover"
				title="Passenger Name"
				data-placement="right"
				data-html="true"
				data-content="The allowed charcaters are:<br/>
				- case insensitive alphabetic characters<br/>
				- period (.)<br/>
				- space ( )<br/>
				<b>Must contain 3 to 100 characters</b>
				"
			/>
			<input 
				type="hidden"
				name="seat[]"
				value="<?php echo $lockedSeat['seatID']; ?>"
			/>
			<input 
				type="hidden"
				name="col[]"
				value="<?php echo $lockedSeat['col']; ?>"
			/>
		</div>
		<?php
			}//END for
		?>
		<div class="action">
			<button id="bookTicket" class="btn btn-success">Book</button>
			<button class="btn btn-warning" formaction="/booking/seat">Reselect Seats</button>
			<a href="/" class="btn btn-danger">Cancel</a>
		</div>
	</form>
</div><!-- .content-md -->