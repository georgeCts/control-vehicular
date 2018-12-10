<?php

namespace App\Library;

class XMLConverter {
	
	public static function stringToXml($string) {
		$return = false;
		if(!is_null($string) && !empty($string)) {
			//$return = self::castSpecialCharsStringToXml($string);
			if(self::validateStringToXML($string))
			{
				$return = @simplexml_load_string($string, NULL, LIBXML_NOCDATA);
			}
			else
			{
				$return = false;
			}
		}
		return $return;
	}

	public static function validateStringToXml($string) {
		
		$return = false;

		if(!is_null($string) && !empty($string)) {

			libxml_use_internal_errors(true);
		 	

			$document = new \DOMDocument('1.0', 'utf-8');
			$document->loadXML($string);
			$xmlErrors = libxml_get_errors();
			
			$return = empty($xmlErrors);
		}

		return $return;
	}

	public static function xmlToArrayList($xml, $node) {
		$arrayListNode = self::recursiveXmlNode($xml, $node);
		return (implode(",", $arrayListNode));
	}
	
	public static function recursiveXmlNode($xml, $node, $value = array()) {
		if($xml->getName() == $node)
		{
			$return = $xml;
			array_push($value, self::castSpecialCharsXmlToString((string)$xml));
		}

		foreach($xml->children() as $child)
		{
			$value = self::recursiveXmlNode($child, $node, $value);

		}
		
		return $value;
	}

	private static function castSpecialCharsStringToXml($string) {
		$string = str_replace("#", "", $string);
		$string = str_replace('"', "", $string);
		$string = str_replace("'", "&Apos;", $string);
		
		return $string;
	}
	
	private static function castSpecialCharsXmlToString($string) {
		$string = str_replace("&Apos;", "'", $string);
		
		return $string;
	}

}

?>