<?php 
namespace Patlidator\Constraints;

class FileType
{
    private $options;
    
    public function __construct($options = null)
    {
        $this->options = $options;
    }

    public function validate($value){
        foreach($this->options as $option => $req){
            switch ($option) {
                case 'max':
                    if($value){
                        if ($value->getSize() > $req){                                                             
                            return "El archivo es muy pesado! Valor máximo: " . $req;
                        }
                    }
                    break;
                case 'type':
                    if($value){
                        $err = true;
                        foreach ($req as $extention) {
                            if(pathinfo($value->getClientFilename(), PATHINFO_EXTENSION) == $extention){
                                $err = false;
                            }
                        }
                        if($err){
                            return "Extensión " . pathinfo($value->getClientFilename(), PATHINFO_EXTENSION) . " no permitida." ;
                        }
                    }
                    break;
                
                default:
                    throw new \Exception("Restricción " . $option . ": no válida en la fecha");
                    break;
            }
        }
    }
}