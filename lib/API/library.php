<?php

require_once("lib/eBookLib/ebookRead.php");

class Library extends API {
	
	public $books;
	
	public function __construct() {
		if ($dh=opendir(LIBDIR)) {
			while ($fname=readdir($dh))
				if (strpos($fname,"epub")) {
					$ebook = new ebookRead(LIBDIR.$fname);
					$cover=$this->resampleCover($ebook->getCover(),$fname);
					$book=array(
						"cover"=>"data:image/jpeg;base64,".base64_encode($cover),
						"title"=>$ebook->ebookData->title,
						"author"=>$ebook->ebookData->creator,
					);
					//print_r($ebook->ebookData);//*/
					$this->books[]=$book;
				}
			closedir($dh);
			//print_r($this->books);
		} else throw new Exception("Unable to open library",503);
	}
	
	public function getbooks() {
		return $this->books;
	}
	
	private function resampleCover($cover,$fname) {
		$cover_image=imagecreatefromstring($cover);
		if (!$cover_image)
			$cover_image=imagecreatefromjpeg("images/default_cover.jpg");
		$xx=imagesx($cover_image);
		$yy=imagesy($cover_image);

		if (($xx/$yy)<1) {
			$WW=($xx*COVERSIZE)/$yy;
			$HH=COVERSIZE;
		} else {
			$HH=($yy*COVERSIZE)/$xx;
			$WW=COVERSIZE;
		}
		$resized_cover=imagecreatetruecolor($WW,$HH);
		imagecopyresampled($resized_cover,$cover_image,0,0,0,0,$WW,$HH,$xx,$yy);
		imagedestroy($cover_image);

		ob_start();
		imagejpeg($resized_cover);
		$img=ob_get_clean();

		imagedestroy($resized_cover);

		return $img;
	}
}

