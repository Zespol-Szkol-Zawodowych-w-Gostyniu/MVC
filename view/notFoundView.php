<?php
include 'view/homeView.php';
class notFoundView extends homeView{
    public function __construct()
    {
        $this->render('404');       
    }
}
?>