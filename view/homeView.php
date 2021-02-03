<?php

class homeView extends View{

    public function __construct( $param='')
    {
        //require $_SERVER['PHP_SELF'];
        //print_r($param);
        //$param = ltrim($param, '/');
        $art=$this->loadModel('home');
        $this->set('title', 'HOME');
        if ($param==''){
            $this->set('artData', $art->homeData());
            
        }else{
            $this->set('artData', "Przekazano parametr $param");
        }
        $this->render('home');       
    }

    

}