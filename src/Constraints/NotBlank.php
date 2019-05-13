<?php 
namespace Patlidator\Constraints;

class NotBlank
{
       public function validate($value){
           if(empty($value)){
               return "Campo Requerido";
           }
       
    }
}