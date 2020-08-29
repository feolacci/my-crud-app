<?php

class Upload {
	public static function img($file) {
		$targetDir = "../assets/uploads/";
		$targetFile = $targetDir . basename($file["name"]);
		$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION)); // ext
		$errors = [];
		
		// Controlla se l'immagine non sia fake
		$check = getimagesize($file["tmp_name"]);
		if($check === false) {
			$errors[] = 6;
		}
		
		// Controlla se l'immagine già esiste
		if (file_exists($targetFile)) {
			$errors[] = 7;
		}
		
		// Dimensione massima del file
		if ($file["size"] > 500000) {
			$errors[] = 8;
		}
		
		// Estensioni consentite
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"	&& $imageFileType != "gif" ) {
			$errors[] = 9;
		}		
		
		if(count($errors) === 0 && !move_uploaded_file($file["tmp_name"], $targetFile)) {
			$errors[] = 10;
		}

		return (count($errors) > 0) ? $errors : $targetFile;
	}
} // Upload