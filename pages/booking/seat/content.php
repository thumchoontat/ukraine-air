<div class="content-md">
	<form method="POST" action="seat/passenger">
		<input type="hidden" name="flightID" value="<?php echo $flightID; ?>"/>
		<div class="actions">
			<a href="/booking" class="btn btn-warning">
				<span class="glyphicon glyphicon-chevron-left"></span>
				Back to flight selection
			</a>
			<button id="bookSeat" class="btn btn-success" style="float:right;">
				Book selected seat
				<span class="glyphicon glyphicon-chevron-right"></span>
			</button>
		</div>
		
		<div class="seat-map-container">
			<div class="info">
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
			</div>
			<div class="seat-map">
				<div class="front">Front</div>
				<?php 
					$seats = getSeats($flightID);
					$seatCount = $seats->num_rows;
					$seatRow = 0;
					$tagClosed = true;
					
					for ($i = 0; $i < $seatCount; $i++){
						$seat = $seats->fetch_assoc();
						$seatCode = $seat['seatID'].'-'.$seat['col'];
						
						if ($seatRow != $seat['seatID']){
							$seatRow = $seat['seatID'];
							if (!$tagClosed){
				?>
					</div>
				<?php
							}
				?>
					<div class="seat-row">
				<?php
							$tagClosed = false;
						}//END unmatch seat row
						if ($seat['available'] == 1 && $seat['locked'] == 0){
				?>
						<input id="<?php echo $seatCode; ?>" type="checkbox" name="seats[]" value="<?php echo $seatCode; ?>"/>
				<?php
						}//END available seat
				?>
						
						<label for="<?php echo $seatCode; ?>">
				<?php 
						if ($seat['available'] == 0){
				?>
							<span class="glyphicon glyphicon-user"></span>
				<?php
						}//END available seat
						else if ($seat['locked'] == 1){
				?>
							<span class="glyphicon glyphicon-lock"></span>
				<?php
						}
						else{
				?>
							<?php echo $seatCode; ?>
				<?php
						}
				?>
						</label>
				<?php
					}//END for
					if (!$tagClosed){
				?>
					</div>
				<?php
					}
				?>
			</div><!-- .seat-map -->
		</div>
		<div class="legend">
			Legend
			<div>
				<span class="glyphicon glyphicon-user"></span>
				Booked
			</div>
			<div>
				<span class="glyphicon glyphicon-lock"></span>
				Locked for 5 minutes
			</div>
		</div><!-- .legend -->
	</form>
</div><!-- .content-md -->