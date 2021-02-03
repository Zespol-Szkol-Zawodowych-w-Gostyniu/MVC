<?php


class mainController extends Controller{

    public function __construct($request, $path='controller/')
    {
        global $route;
        $param='';
        $request = ltrim($request, '/');
        $name=$request;
        //echo $request;
        $param=explode('/',$request);
        //print_r($param);
        if (($name=='')||($name=='/')){
            $name='home';
            $request='home';
            $param='';
        }else if (count($param)>1) {
            $request=$param[0]; 
            //print_r($param);
            if (count($param)>2) {//sprawdzamy czy przekazano tylko jeden parametr
                $request='notFound';
            }
            array_shift($param);
            //array_shift($param);
            //print_r($param);
            if ( (is_numeric($param[0])) ) $param='/'.implode('/',$param); else $request='NotFound';
            $name=$request;
            //print_r($param);
        }else if (count($param)==1) $param=''; 
        
        if (!in_array($name, $route)){
            $name='notFound';
            $request='notFound';
            
        }
        //$name = ltrim($name, '/');
        //$request = ltrim($request, '/');
        $name=$name.'Controller';
        $path=$path.$name.'.php';
        
        try {
            if(is_file($path)) {
                require $path;
                $obj=new $name($request, $param);
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