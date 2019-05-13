<?php 
    namespace Patlidator;

    class Validator
{   
    private $form = [];
    private $errors = [];

    
    private function handleRestriction($field, $value, $restriction){
        if(is_string($restriction)){
            switch ($restriction) {
                case 'DateTime':
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
                    break;
                case 'Number':
                    if (!is_numeric($value)) {
                        $this->errors[] = [
                            "campo" => $field,
                            "valor" => $value,
                            "message" => "Este campo solo debe contener números."
                        ];
                    }
                    break;
                case 'Email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->errors[] = [
                            "campo" => $field,
                            "valor" => $value,
                            "message" => "Por favor ingrese un email válido."
                        ];
                    }
                    break;
                
                default:
                throw new \Exception("La restricción " . $restriction . " no es válida. Ingresada en: " . $field);
            }
        }
        else {
            $validation = $restriction->validate($value);
            if($validation){
                $this->errors[] = [
                    "campo" => $field,
                    "valor" => $value,
                    "message" => $validation
                ];
            }
        }
    }

    public function add($field = null, $value = null, $restrictiones){
        $this->form[] = [
            "campo" => $field,
            "valor" => $value,
            "restricciones" => $restrictiones
        ];
    }

    public function validate(){
        foreach ($this->form as $value) {
           //Hago este for para que devuelva las validaciones al revés.
           for ($i=count($value["restricciones"]) -1; $i >= 0 ; $i--) { 
            $this->handleRestriction($value["campo"], $value["valor"], $value["restricciones"][$i] ); 
        }
        }
        return count($this->errors) > 0 ? $this->errors : null;
    }

}