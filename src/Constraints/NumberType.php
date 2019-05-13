<?php 
namespace Patlidator\Constraints;

class NumberType
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
        if(!is_numeric($value)){
            return "Este campo solo debe contener números";
        }
    }
}