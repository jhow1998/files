<?php

namespace App\file;

  
class Upload{

      /**
     * Nome do arquivo (sem extensão)
     * @var string
     */
     private $name;

      /**
     * Nome do arquivo (sem ponto)
     * @var string
     */
     private $extension;


      /**
     * private description
     * @var string
     */
    private $type;


     /**
     * Nome temporario
     * @var string
     */
    private $tmpName;

     /**
     * Nome do arquivo (sem extensão)
     * @var integer
     */

    private $error;

     /**
     * tamanho do arquivo
     * 
     * @var integer
     */

    private $size;

    private $duplicates = 0;


    public function __construct($file){
        $this->type = $file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error = $file['error'];
        $this->size = $file['size'];

        $info = pathinfo($file['name']);
        $this->name = $info['filename'];
        $this->extension = $info['extension'];
    }

    /**
     * metodo responsavel por mover o arquivo de upload 
     * @param string $dir
     * @return boolean
     */


     public function setName($name){
         $this->name = $name;
     }

     public function generateNewName(){
         $this->name = time().'-'.rand(100000,999999).'-'.uniqid();
     }

     public function getBasename(){

         $extension = strlen($this->extension) ? '.'.$this->extension : '';

         //valida duplicação
         $duplicates = $this->duplicates > 0 ? '-'.$this->duplicates : '';
         
         return $this->name.$duplicates.$extension; 
     }


     private function getPossibleBasename($dir,$overwrite){
        //sobreescrever arquivo
        if($overwrite) return $this->getBasename();

        //não pode sobrescrever arquivo
        $basename = $this->getBasename();

        //verifica duplicacao
        if(!file_exists($dir.'/'.$basename)){
            return $basename;
        }

        //incrementar duplicações
        $this->duplicates++;

        return $this->getPossibleBasename($dir,$overwrite);

     }

    public function upload($dir, $overwrite = true){
        
        if($this->error != 0) return false;

        $path = $dir.'/'.$this->getPossibleBasename($dir,$overwrite);
        

        //move para arquivo de destino
        return move_uploaded_file($this->tmpName,$path);

    }

    public static function createMultiUpload($files){
        $uploads = [];

        foreach ($files['name'] as $key => $value) {
            $file = [

                'name'     =>$files['name'][$key],
                'type'     =>$files['type'][$key],
                'tmp_name' =>$files['tmp_name'][$key],
                'error'    =>$files['error'][$key],
                'size'     =>$files['size'][$key]
            ];
           $uploads[] = new Upload($file);
        }


        return $uploads;
    }


}




?>