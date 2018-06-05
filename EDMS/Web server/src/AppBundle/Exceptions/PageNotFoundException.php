<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 06.05.18
 * Time: 22:26
 */

namespace AppBundle\Exceptions;


use Throwable;

class PageNotFoundException extends \Exception
{

    protected $message;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->message = $message;
    }


    public function __toString()
    {
        return " ".$this->message.'<br>';
    }

}
