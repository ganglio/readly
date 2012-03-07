<?php

require_once("lib/eBookLib/ebookRead.php");

class Library extends API {
	
	public $books;
	
	public function __construct() {
		if ($dh=opendir(LIBDIR)) {
			while ($fname=readdir($dh))
				if (strpos($fname,"epub")) {
					$ebook = new ebookRead(LIBDIR.$fname);
					$cover_manif = $ebook->getManifestById("cover");
					$cover=$this->resampleCover($ebook->getContentFile($cover_manif->href));
					
					$this->books[]=array(
						"cover"=>"data:".$cover_manif->type.";base64,".base64_encode($cover),
						"title"=>$ebook->ebookData->title,
						"author"=>$ebook->ebookData->creator,
					);
				}
			closedir($dh);
		} else throw new Exception("Unable to open library",503);
	}
	
	public function getbooks() {
		return $this->books;
	}
	
	private function resampleCover($cover) {
		$cover=imagecreatefromstring($cover);
		$xx=imagesx($cover);
		$yy=imagesy($cover);
		
		if (($xx/$yy)<1) {
			$WW=($xx*COVERSIZE)/$yy;
			$HH=COVERSIZE;
		} else {
			$HH=($yy*COVERSIZE)/$xx;
			$WW=COVERSIZE;
		}
		$resized_cover=imagecreatetruecolor($WW,$HH);
		imagecopyresampled($resized_cover,$cover,0,0,0,0,$WW,$HH,$xx,$yy);
		imagedestroy($cover);

		ob_start();
		imagejpeg($resized_cover);
		$img=ob_get_clean();

		imagedestroy($resized_cover);
		return $img;
	}
}

