<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/12/16
 * Time: 1:45 PM
 */
require_once("iexception.php");

class CustomException extends Exception implements IException
{
    /**
     * CustomException constructor.
     */
    public function __construct($message = null, $code = 0) {
        if (!$message) {
            throw new $this('Unknown '. get_class($this));
        }
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n";
    }
}