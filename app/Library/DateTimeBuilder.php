<?php

use Illuminate\Support\Facades\DB;

namespace App\Library;

class DateTimeBuilder {

	public $timeZone = 'America/Mexico_City';

	public static function create() {

		$return = false;

		switch(func_num_args()) {

			case 0:

			break;

			case 1:
				switch(gettype(func_get_args()[0])) {
					case 'string':
						$return = self::createInstance(func_get_args()[0]);
					break;
				}
			break;

		}

		

		

		return $return;
	}

	private static function createInstance($argDateTime) {
		$objReturn = null;

		$objDateTimeBuilder = new DateTimeBuilder();
		$objDateTimeBuilder->validateDateTime($argDateTime);

		if($objDateTimeBuilder->validateDateTime($argDateTime)) {
			$objReturn = (new DateTimeBuilder\DeltaDateTime())->setFromFormat($argDateTime);	
		}

		return $objReturn;
	}

	public static function validateDateTime($argDateTime) {
		return DateTimeBuilder\DeltaDateTime::validateDateTime($argDateTime);
	}

	public static function getStringFormat($argDateTime) {
		return DateTimeBuilder\DeltaDateTime::getStringFormat($argDateTime);
	}

	public static function getTypeFormat($argDateTime) {
		return DateTimeBuilder\DeltaDateTime::getTypeFormat($argDateTime);
	}

	
}

namespace App\Library\DateTimeBuilder;

class DeltaDateTime {

	public $valid = false;
	public $type = null;
	public $isDate = false;
	public $isTime = false;
	public $isDateTime = false;
	public $DateTime = false;
	public $timeZone = 'America/Mexico_City';
	public $locale = 'es_ES';

	public function setFromFormat($argDateTime) {
		if($this->validateDateTime($argDateTime)) {
			$this->valid = true;
			$this->type = $this->getType($argDateTime);
			switch($this->type) {
				case 'DATETIME': 
					$this->isDateTime = true; 
					$this->isDate = true; 
					$this->isTime = true; 
				break;
				case 'DATE': $this->isDate = true; break;
				case 'TIME': $this->isTime = true; break;
			}

			$this->DateTime = \DateTime::createFromFormat(self::getStringFormat($argDateTime), $argDateTime);
			$this->DateTime->setTimeZone(new \DateTimeZone($this->timeZone));
		}

		return $this;
	}

	public static function getStringFormat($argDateTime) {
		
		$return = "";

		// DATE - DD/MM/YYYY
		if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $argDateTime)) {
			$return = "d/m/Y";
		}


		// DATE - DD/MM/YY
		if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}$/', $argDateTime)) {
			$return = "d/m/y";
		}

		// DATE - YYYY-MM-DD
		if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $argDateTime)) {
			$return = "Y-m-d";
		}

		// TIME - HH:ii:ss
		if (preg_match('/^\d{1,2}:\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "H:i:s";
		}

		// TIME - HH:ii
		if (preg_match('/^\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "H:i";
		}


		// DATETIME - YYYY-MM-DD HH:ii:ss
		if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}\s\d{1,2}:\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "Y-m-d H:i:s";
		}

		// DATETIME - DD/MM/YYYY HH:ii:ss
		if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}\s\d{1,2}:\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "d/m/Y H:i:s";
		}

		// DATETIME - DD/MM/YY HH:ii:ss
		if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}\s\d{1,2}:\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "d/m/y H:i:s";
		}

		// DATETIME - DD/MM/YYYY HH:ii
		if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}\s\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "d/m/Y H:i";
		}

		// DATETIME - YYYY-MM-DD HH:ii
		if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}\s\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "Y-m-d H:i";
		}

		// DATETIME - DD/MM/YY HH:ii
		if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}\s\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "d/m/y H:i";
		}

		return $return;
		
	}

	public static function getType($argDateTime) {
		
		$return = "";


		if(	preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $argDateTime)
			|| preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}$/', $argDateTime)
			|| preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $argDateTime)
			) {
			$return = "DATE";
		} else if( preg_match('/^\d{1,2}:\d{1,2}:\d{1,2}$/', $argDateTime)
			|| preg_match('/^\d{1,2}:\d{1,2}$/', $argDateTime)) {
			$return = "TIME";
		} else if( preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}\s\d{1,2}:\d{1,2}:\d{1,2}$/', $argDateTime)
			|| preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}\s\d{1,2}:\d{1,2}:\d{1,2}$/', $argDateTime)
			|| preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}\s\d{1,2}:\d{1,2}$/', $argDateTime)
			|| preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}\s\d{1,2}:\d{1,2}$/', $argDateTime) 
			|| preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}\s\d{1,2}:\d{1,2}:\d{1,2}$/', $argDateTime)
			|| preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}\s\d{1,2}:\d{1,2}$/', $argDateTime)  ) {
			$return = "DATETIME";
		}

		return $return;
		
	}

	public static function validateDateTime($argDateTime) {
		return (\DateTime::createFromFormat(self::getStringFormat($argDateTime), $argDateTime) !== false);
	}

	//DATE TIME FORMATS
	public function getDateTimeAtom() {
		$return = false;
		if($this->isDateTime) {
			$return = $this->getDateAtom() . ' ' . $this->getTimeLong();
		}
		return $return;
	}

	public function getDateTimeEuropeanShort() {
		$return = false;
		if($this->isDateTime) {
			$return = $this->getDateEuropean() . '-' . $this->getTimeShort();
		}
		return $return;
	}

	public function getDateTimeEuropeanLong() {
		$return = false;
		if($this->isDateTime) {
			$return = $this->getDateEuropean() . '-' . $this->getTimeLong();
		}
		return $return;
	}

	public function getDateTimeEnglshShort() {
		$return = false;
		if($this->isDateTime) {
			$return = $this->getDateEnglish() . '-' . $this->getTimeShort();
		}
		return $return;
	}

	public function getDateTimeEnglishLong() {
		$return = false;
		if($this->isDateTime) {
			$return = $this->getDateEnglish() . '-' . $this->getTimeLong();
		}
		return $return;
	}

	public function getDateTimeLocaleLong() {
		$return = false;
		
		/*

		INCOMPLETO 
		
		setlocale(LC_ALL, $this->locale);
		// martes, 21 de julio de 2015, 14:11:11 (Hora de verano británica)
		if($this->isDateTime) {
			$return = $this->DateTime->format('l');
		}
		*/

		return $return;
	}


	//DATE FORMATS
	public function getDateAtom() {
		$return = false;
		if($this->isDate || $this->isDateTime) {
			$return = $this->DateTime->format('Y-m-d');
		}
		return $return;
	}

	public function getDateEuropean() {
		$return = false;
		if($this->isDate || $this->isDateTime) {
			$return = $this->DateTime->format('d/m/Y');
		}
		return $return;
	}

	public function getDateEnglish() {
		$return = false;
		if($this->isDate || $this->isDateTime) {
			$return = $this->DateTime->format('m/d/Y');
		}
		return $return;
	}

	
	//TIME FORMATS
	public function getTimeShort() {
		$return = false;
		if($this->isTime || $this->isDateTime) {
			$return = $this->DateTime->format('H:i');
		}
		return $return;
	}

	public function getTimeLong() {
		$return = false;
		if($this->isTime || $this->isDateTime) {
			$return = $this->DateTime->format('H:i:s');
		}
		return $return;
	}


}

?>