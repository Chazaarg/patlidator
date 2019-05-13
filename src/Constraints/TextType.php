<?php 
namespace Patlidator\Constraints;

class TextType
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
        foreach($this->options as $option => $req){
            switch ($option) {
                case 'max':
                    if(strlen($value) > $req){                                                        
                        return "Solo se admiten hasta " . $req . " caracteres.";
                    }
                    break;
                case 'required':
                    if($req){
                        if(empty($value)){
                            return "Campo Requerido";
                        }
                    }
                    break;
                
                default:
                    throw new \Exception("Restricción " . $option . ": no válida en TextType");
                    break;
            }
        }
    }
}