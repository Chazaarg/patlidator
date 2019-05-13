<?php 
namespace Patlidator\Constraints;

class EmailType
{
    private $options;
    private $message;
    
    function __construct($options = null)
    {
        if($options["message"]){
            $this->message = $options["message"];
            unset($options["message"]);
        }
         
        $this->options = $options;
    }
    public function getMessage(){
        return $this->message;
    }

    public function validate($value){
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "Por Favor ingrese un email válido";
        }
    }
}