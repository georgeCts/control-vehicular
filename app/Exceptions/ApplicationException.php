<?php

namespace App\Exceptions;

use App\Library\Errors;

class ApplicationException extends \Exception {
    private $ID;
    private $title;

    public function __construct($ID, $title = null, $message = null) {

        if( $title == null
            && $message == null) {
            parent::__construct(Errors::class . '::' . $ID . '_MESSAGE', 9001);
            $this->ID = constant(Errors::class . '::' . $ID . '_ID');
            $this->title = constant(Errors::class . '::' . $ID . '_TITLE');
        } else {
            parent::__construct($message, 9001);
            $this->ID = $ID;
            $this->title = $title;
        }
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->ID}]: {$this->title} - {$this->message}\n";
    }

    public function getTitle() {
        return $this->title;
    }

    public function getID() {
        return $this->ID;
    }
}

?>