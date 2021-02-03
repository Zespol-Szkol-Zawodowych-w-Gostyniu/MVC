<?php
class loginView extends View{
    public function __construct()
    {
        $auth = $this->loadModel('login');
        $this->set("error", "");
        $this->set('islogin',false);
        if ($this->isLogged($auth)){
            $this->set('title', $auth->login);
            $this->set('islogin',true);
        }else{
            if (isset($_POST['submit'])) {
                if ($auth->checkLoginPassword()){
                    $this->set('islogin',true);
                    //$this->set("error", "Udało się zalogować");
                    $this->set('title', $auth->login);
                }else {
                    $this->set('islogin',false);
                    $this->set("error", "Niepoprawny login lub hasło");
                    $this->set('title', '');
                }
            }
        }
        $this->render("login");
    }
}

?>