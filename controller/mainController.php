<?php


class mainController extends Controller{

    public function __construct($request, $path='controller/')
    {
        global $route;
        $name=$request;
       
        if (($name=='')||($name=='/')){
            $name='home';
            $request='home';
        }else if (!in_array($name, $route)){
            $name='notFound';
            $request='notFound';
        }
        $name = ltrim($name, '/');
        $request = ltrim($request, '/');
        $name=$name.'Controller';
        $path=$path.$name.'.php';
        
        try {
            if(is_file($path)) {
                require $path;
                $obj=new $name($request);
            } else {
                throw new Exception('Can not open controller '.$name.' in: '.$path);
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

    public function redirect($url) {
        header("location: ".$url);
    }

    
}
?>