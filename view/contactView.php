<?php

class contactView extends View{

    public function __construct( $param='')
    {
        
        $art=$this->loadModel('home');
        $this->set('conData', $art->contactData());
        $this->set('title', 'CONTACT');
        $this->render('contact');       
    }
}
?>