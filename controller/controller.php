<?php

class Controller{

    public function loadView($name, $path='view/') {
        $name=$name.'View';
        
        $path=$path.$name.'.php';
        try {
            if(is_file($path)) {
                require $path;
                $obj=new $name();
            } else {
                throw new Exception('Can not open view '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $obj;
    }
    

    public function loadModel($name, $path='model/') {
        $name=$name.'Model';
        $path=$path.$name.'.php';
        try {
            if(is_file($path)) {
                require $path;
                $ob=new $name();
            } else {
                throw new Exception('Can not open model '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $ob;
    }

    
}

?>