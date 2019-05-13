<?php 
    namespace Patlidator;

    class Validator
{   
    private $form = [];
    private $errors = [];

    private function handleRestriction($field, $value, $restriction){
        $validation = $restriction->validate($value);
        if($validation){
            $this->errors[] = [
                "campo" => $field,
                "valor" => $value,
                "message" => $restriction->getMessage() ? $restriction->getMessage() : $validation
            ];
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