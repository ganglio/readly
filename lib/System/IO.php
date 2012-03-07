<?php

class IO {
	static public function out($data) {
		if (isset($_REQUEST["xml"])) {
			$xml = new SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");
			self::toXML($data,$xml);
			print $xml->asXML();
		} elseif (isset($_REQUEST["array"]))
			print_r($data);
		else
			echo json_encode($data);
		echo "\n";
	}
	
	static public function close($data) {
		self::out($data);
		die();
	}
	
	static public function toXML($data, &$xml) {
		foreach($data as $key => $value) {
			if(is_array($value)) {
				if(!is_numeric($key)){
					$subnode = $xml->addChild($key);
					self::toXML($value, $subnode);
				} else {
					$subnode = $xml->addChild("entry");
					$subnode->addAttribute("index",$key);
					self::toXML($value, $subnode);
				}
			} else {
				if(!is_numeric($key)){
					$xml->addChild($key,$value);
				} else {
					$xml->addChild("entry",$value)->addAttribute("index",$key);
				}
			}
		}
	}
	
	static public function fromXML($data) {
		$xml = new XMLReader();
		$xml->xml($data);
		$out=self::xml2assoc($xml);
		$xml->close();
		return $out;
	}
	
	static private function xml2assoc($xml) {
		$tree = null;
		while($xml->read())
			switch ($xml->nodeType) {
				case XMLReader::END_ELEMENT: return $tree;
				
				case XMLReader::ELEMENT:
					$node = array('tag' => $xml->name, 'value' => $xml->isEmptyElement ? '' : self::xml2assoc($xml));
					if($xml->hasAttributes)
						while($xml->moveToNextAttribute())
							$node['attributes'][$xml->name] = $xml->value;
					$tree[] = $node;
				break;
				
				case XMLReader::TEXT:
				
				case XMLReader::CDATA:
					$tree .= $xml->value;
			}
		return $tree;
	}
}
