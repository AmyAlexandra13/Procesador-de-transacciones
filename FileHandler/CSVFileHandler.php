<?php 
class CSVFileHandler extends FileHandlerBase implements IFileHandler{
    function __construct($directory,$filename)
    {       
        parent::__construct($directory,$filename);
    }


    function SaveFile($value){

        $this->CreateDirectory($this->directory);
        $path = $this->directory . "/". $this->filename . ".csv";

        $file = fopen($path,"w+");
        
        
        $serializeData = serialize($value);
           
        fwrite($file,$serializeData);
        fclose($file);   
}

function ReadFile(){

    parent::CreateDirectory($this->directory);
    $path = $this->directory . "/". $this->filename . ".csv";      

    if(file_exists($path)){
        $file = fopen($path,"r");

        $contents = fread($file,filesize($path));
        fclose($file);
        return unserialize($contents);
      
    }else{
        return false;
    }      

}

}

?>





