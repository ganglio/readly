<?php

class Library {
	
	public $books;
	
	public function __construct() {
		if ($dh=opendir(LIBDIR)) {
			while ($fname=readdir($dh))
				if (strpos($fname,"epub")) {
					$ebook = new ebookRead(LIBDIR.$fname);
					$cover_manif = $ebook->getManifestById("cover");
					$cover=$ebook->getContentFile($cover_manif->href);
					$this->books[]=array(
						"cover"=>"data:".$cover_manif->type.";base64,".base64_encode($cover),
						"title"=>$ebook->ebookData->title,
						"author"=>$ebook->ebookData->creator,
					);
				}
			closedir($dh);
		} else die("Unable to open library");
	}
}
