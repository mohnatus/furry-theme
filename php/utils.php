<?php

function declination($number, $titles) {
	$cases = array(2, 0, 1, 1, 1, 2);
	return $titles[($number%100>4 && $number%100<20) ? 2 : $cases[min($number%10, 5)]];
}
