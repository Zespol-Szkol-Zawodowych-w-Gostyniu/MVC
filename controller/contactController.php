<?php
class contactController extends Controller{

    public function __construct($request)
    {
        
        $this->loadView($request);
    }

}