<?php 
namespace Patlidator\Constraints;

class DateType
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
        $year = date("Y", strtotime($value));
        $month = date("m", strtotime($value));
        $day = date("d", strtotime($value));
        $isValid= checkdate($month, $day, $year);

        if($isValid === false){
            $this->errors[] = [
                "campo" => $field,
                "valor" => $value,
                "message" => "Campo inválido."
            ];
        }
    }
}