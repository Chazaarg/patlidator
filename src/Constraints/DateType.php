<?php
namespace Patlidator\Constraints;

class DateType
{
    private $options;
    private $message;
    
    public function __construct($options = null)
    {
        if ($options["message"]) {
            $this->message = $options["message"];
            unset($options["message"]);
        }
         
        $this->options = $options;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function validate($value)
    {
        $isValid= strtotime($value);
        if (!$isValid) {
            return "Fecha inválida";
        }
    }
}