<?php


class homeController extends Controller{

    public function __construct($request)
    {
        
        $this->loadView($request);
    }

}
?>