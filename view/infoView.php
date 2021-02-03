
<?php


class infoView extends View{
    public function __construct()
    {
        //session_start();
        $auth = $this->loadModel('login');
        $this->set("error", "");
        if ($this->isLogged($auth)){
            $this->set('title', $auth->login);
            $this->render("info");
        }else{
            $this->redirect("login");
        }
    }
}

?>