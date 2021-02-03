<?php
class View{

    public function isLogged($auth){
        session_start();
        if (isset($_SESSION['login'])) {
            $auth->setLogin($_SESSION['login']);
            $auth->setPassword($_SESSION['pwd']);
            return true;
        }else return false;
    }
    
    public function render($name, $path='templates/',  $param='') {
        $path=$path.$name.'.html';
        global $address;
        try {
            if(is_file($path)) {
                require $path;
            } else {
                throw new Exception('Can not open template '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
    }

    public function loadModel($name, $path='model/',  $param='') {
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

    /**
     * It sets data.
     *
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function set($name, $value) {
        $this->$name=$value;
    }
    /**
     * It gets data.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get($name) {
        return $this->$name;
    }

    public function redirect($url) {
        header("location: ".$url);
    }

}
?>
