<?php 
namespace Patlidator\Constraints;

class NotBlank
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
        if(empty($value)){
            return "Campo Requerido";
        }
       
    }
}