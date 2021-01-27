<?php

class homeView extends View{

    public function __construct()
    {
        //require $_SERVER['PHP_SELF'];
        $art=$this->loadModel('home');
        $this->set('artData', $art->homeData());
        $this->set('title', 'HOME');
        $this->render('home');       
    }

    

}