<?php

function ParseRomanNumerals($input)
{
	$numerals = [
		'M' => 1000,
		'D' => 500,
		'C' => 100,
		'L' => 50,
		'X' => 10,
		'V' => 5,
		'I' => 1,
	];

	$input = str_split(strtoupper($input));		// split string into array and convert to uppercase values
	$count = count($input) - 1;					// how many values in our array, for use in the loop

	// initialise some variables for use in our loop
	$i = 0; 		// iterations
	$prev = 0;		// value of previous numeral in string
	$next = 0;		// value of next numeral in string
	$val = 0;		// the value to add to the total
	$total = 0;		// the total

	foreach ($input as $inp) {
		
		$current = $numerals[$inp];		// store current value for easier access and cleaner code
	
		if($i < $count) {				// we have a next value
			$next = $numerals[$input[$i + 1]];
		}

		if($i > 0 && $i <= $count) {		// we have a prev value
			$prev = $numerals[$input[$i - 1]];
		}

		if($next > $current) {			// next numeral is greater than the current,
			$val = $next - $current;	// we should delete current val from the next

		} elseif($current > $prev && $i > 0 && $i <= $count) {	// current is greater than prev, 
			$val = 0;											// do nothing as we've already handled this above
																// make sure $i > 0 and < count so we don't set the 
																// value to 0 for first and last item in array
		
		} else {
			$val = $current;
		}

		// add value of this iteration to total
		$total += $val;
		
		// reset vars to tidy up for next iteration
		$next = 0;		
		$current = 0;		
		$prev = 0;		

		$i++; 	// increment iterator for next run of the loop
	}	

	return $total;
}

echo ParseRomanNumerals("MCMLXI");
?>