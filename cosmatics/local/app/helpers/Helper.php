<?php
class Helper{
	public static function limitText($givenText, $length ) {
		if (strlen($givenText) > $length) {
			$limitedText = substr($givenText, 0, $length);   
			$givenText = substr($limitedText, 0, strrpos($limitedText, ' ')).'...'; 
		}
		return $givenText;
	}
}