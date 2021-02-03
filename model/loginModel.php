<?php
class loginModel{

    public function setLogin($value){
        $this->login=$value;
    }

    public function setPassword($value){
        $this->password=$value;
    }

    public function checkLoginPassword(){
        if (($_POST['email']=="bartek@gmail.com") && ($_POST['pwd']=="bartek")){
            //$this->set("error", "Udało się zalogować");
            //session_start();
            $this->setLogin($_POST['email']);
            $this->setPassword($_POST['pwd']);
            $this->setSession($this->login,$this->password);
            return true;
        }else return false;   
    }

    public function setSession($login, $password){
        $_SESSION['login'] = $login;
        $_SESSION['pwd'] = $password;
    }


    public function logout(){
        session_destroy();
    }
}


?>