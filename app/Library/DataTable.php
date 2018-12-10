<?php

use App\Library\XMLConverter;
use App\Library\Encryption;
use App\Library\DateTimeBuilder;
use Illuminate\Support\Facades\DB;

namespace App\Library;

class DataTable {
	
	private $request = null;
	private $requiredColumns = array();

	function __construct($request = null) {
		if($this->validateParametersFormat($request)) {
			$this->request = $request;
		}
	}

	/* FORMAT STRUCTURE */
	private function parametersFormat() {
		$parameters = array(
		    'xmlSearchOptions' 	=> null,
		    'xmlFields'    		=> null,
		    'textInputSearch'	=> '',
		    'xmlDateFilters'    => null,
		    'textInputFrom' 	=> '',
		    'textInputTo'		=> '',

		    'pagination'		=> array(
		    							'currentPage'	=> 1,
		    							'rowsPerPage'	=> 100,
		    						),

		    'valid'				=> false
		    );

		return $parameters;
	}

	public function validateParametersFormat($request) {
		
		$return = false;
		$xmlConverter = new XMLConverter();

		if(	$request != null
			&& isset($request['xmlSearchOptions'])
			&& $xmlConverter->validateStringToXml($request['xmlSearchOptions'])
			&& isset($request['xmlFields'])
			&& $xmlConverter->validateStringToXml($request['xmlFields'])
			&& isset($request['xmlDateFilters'])
			&& $xmlConverter->validateStringToXml($request['xmlDateFilters'])
			&& isset($request['textInputSearch'])
			&& isset($request['textInputFrom'])
			&& isset($request['textInputTo'])
			) {
			$return = true;
		}

		return $return;
	}

	public function getParameters($request) {
	
		$parameters = $this->parametersFormat();

		$xmlConverter = new XMLConverter();
		$Encryption = new Encryption();

		if($this->validateParametersFormat($request)) {
			$parameters['valid'] = true;

			//xmlSearchOptions>
			$parameters['xmlSearchOptions'] = $xmlConverter->stringToXml($request['xmlSearchOptions']);
			for($i = 0; $i < sizeof($parameters['xmlSearchOptions']); $i++) $parameters['xmlSearchOptions']->search_option[$i] = $Encryption->decrypt($parameters['xmlSearchOptions']->search_option[$i]);

			//xmlFields>
			$parameters['xmlFields'] = $xmlConverter->stringToXml($request['xmlFields']);
			for($i = 0; $i < sizeof($parameters['xmlFields']); $i++) $parameters['xmlFields']->item[$i]->field = $Encryption->decrypt($parameters['xmlFields']->item[$i]->field);

			//textInputSearch
			$parameters['textInputSearch'] = $request['textInputSearch'];


			//dateFields
			$parameters['xmlDateFilters'] = $xmlConverter->stringToXml($request['xmlDateFilters']);
			for($i = 0; $i < sizeof($parameters['xmlDateFilters']); $i++) $parameters['xmlDateFilters']->item[$i]->field = $Encryption->decrypt($parameters['xmlDateFilters']->item[$i]->field);
			
			$textInputFrom = DateTimeBuilder::create($request['textInputFrom']);
			$textInputTo = DateTimeBuilder::create($request['textInputTo']);
			
			if($textInputFrom != false && $textInputTo != false) {
				$parameters['textInputFrom'] = (($textInputFrom->isDate)? $textInputFrom->getDateAtom():'');
	            $parameters['textInputTo'] = (($textInputTo->isDate)? $textInputTo->getDateAtom():'');
        	} else {
        		$parameters['textInputFrom'] = '';
            	$parameters['textInputTo'] = '';
        	}

			//PAGINATION
			$parameters['pagination']['currentPage'] = (isset($request['currentPage']))?$request['currentPage']:1;
			$parameters['pagination']['rowsPerPage'] = (isset($request['rowsPerPage']))?$request['rowsPerPage']:100;
		}

		return $parameters;

	}

	




	/**
	**
	** DATA TABLE ELOQUENT
	**
	**/

	public function createQuery($table) {
		$query = false;
		$parameters = $this->getParameters($this->request);

		if($parameters['valid']) {
			$query = \DB::table($table);

			//SELECT
			for($i=0; $i < sizeof($parameters['xmlFields']); $i++) {
				$query->addSelect($parameters['xmlFields']->item[$i]->field);
	        }

	        //SEARCHOPTIONS
	        if(sizeof($parameters['xmlSearchOptions']) > 0) {
	        	 $query->where(function($innerQuery) use($parameters) {
					for($i=0; $i < sizeof($parameters['xmlSearchOptions']); $i++) {
			            if($i == 0) {
			            	$innerQuery->where( (string)$parameters['xmlSearchOptions']->search_option[$i], 'like', '%' . $parameters['textInputSearch'] . '%');
			            } else {
			            	$innerQuery->orWhere( (string)$parameters['xmlSearchOptions']->search_option[$i], 'like', '%' . $parameters['textInputSearch'] . '%');
			            }
			        }
		    	});
			}
			

	        //DATEFILTERS
	        //var_dump($parameters['xmlDateFilters']);
			for($i=0; $i < sizeof($parameters['xmlDateFilters']); $i++) {
				if($parameters['textInputFrom'] != '') {
					$query->where( \DB::raw('DATE(' . (string)$parameters['xmlDateFilters']->item[$i]->field . ')'), '>=', $parameters['textInputFrom']);
				}

				if($parameters['textInputTo'] != '') {
					$query->where( \DB::raw('DATE(' . (string)$parameters['xmlDateFilters']->item[$i]->field . ')'), '<=', $parameters['textInputTo']);
				}
			}

	    }


		return $query;
	}


	



	public function createTable($query, $prefixView, $arguments = []) {

		$tableParameters = array(
			'tableWidth'	=> 0,
			'head'			=> '',
			'body'			=> '',
			'foot'			=> '',
			'pagination'	=> array(
									'rowsPerPage'	=> 100,
									'currentPage'	=> 1,
		    						'totalPages'	=> 1,
		    						'totalRows'		=> 0,
		    						'from'			=> 0,
		    						'to'			=> 0,
								),

		);

		if($this->request != null) {
			$parameters = $this->getParameters($this->request);
			//***************** PAGINATION *****************
			$currentPage = $parameters['pagination']['currentPage'];
			\Illuminate\Pagination\Paginator::currentPageResolver(function() use ($currentPage) { return $currentPage; });
			$paginationParameters = json_decode($query->paginate($parameters['pagination']['rowsPerPage'])->toJson());

			$tableParameters['pagination']['currentPage'] = $paginationParameters->current_page;
			$tableParameters['pagination']['rowsPerPage'] = $paginationParameters->per_page;
			$tableParameters['pagination']['totalPages'] = $paginationParameters->last_page;
			$tableParameters['pagination']['totalRows'] = $paginationParameters->total;
			$tableParameters['pagination']['from'] = $paginationParameters->from;
			$tableParameters['pagination']['to'] = $paginationParameters->to;


			$rows = $query->get();

			//******************** HEAD ********************
		
			for($i=0; $i < sizeof($parameters['xmlFields']); $i++) {
				if($parameters['xmlFields']->item[$i]->selected) {
					$tableParameters['tableWidth'] += (int)($parameters['xmlFields']->item[$i]->width);
				}
			}

			if (\View::exists($prefixView . '.Head')) {
				$tableParameters['head'] = \View::Make($prefixView . '.Head', array_merge(array(
					'xmlFields' => $parameters['xmlFields']
				), $arguments))->render();
			}
			


			//******************** BODY ********************
			if (\View::exists($prefixView . '.Body')) {
				$tableParameters['body'] = \View::Make($prefixView . '.Body', array_merge(array(
					'xmlFields' => $parameters['xmlFields'],
					'rows'		=> $rows
				), $arguments))->render();
			}

			

		}

		return $tableParameters;
	}

	public function createJsonTable($query, $previxView, $arguments = []) {
		return json_encode($this->createTable($query, $previxView, $arguments));
	}

}

?>