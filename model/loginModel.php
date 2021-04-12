<?php
class loginModel{

    public function setLogin($value){
        $this->login=$value;
    }


    public function connectDB()
    {
        $mysqli=new mysqli('localhost','root','','test');
        if (mysqli_connect_errno()) { 
            printf("Brak połączenia z serwerem MySQL. Kod błędu: %s\n", mysqli_connect_error()); 
            return null; 
        }else return $mysqli;

    }
    public function setToken($id){
        $conn=$this->connectDB();
        $token = bin2hex(random_bytes(16));
        $this->token=$token;
        $date = date("Y-m-d H:i:s");
        
        //print( $token);
        $sql = "INSERT INTO tokens VALUES (NULL, '" . $token . "', '" . $date . "'," . $id . ")";
        print($sql);
        $result = $conn->query($sql);
        if ($result) {
            $conn->close();
            return true;
         } else {
            $conn->close();
            return false;
        }
    }

    public function getToken($idu){
        $conn=$this->connectDB();
        $sql="SELECT token FROM tokens WHERE idu=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('d', $idu);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($token);
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();
        $conn->close();
        return $token;
    }

    public function getDateToken($idu){
        $conn=$this->connectDB();
        $sql="SELECT date FROM tokens WHERE idu=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param('d', $idu);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($date);
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();
        $conn->close();
        return $date;
    }

    public function deleteToken($idu){
        $conn=$this->connectDB();
        $sql = "DELETE FROM tokens WHERE idu=$idu";
        //print($sql);
        $result = $conn->query($sql);
        if ($result) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
       }
    }

    public function updateToken($idu){
        $conn=$this->connectDB();
        $date = date("Y-m-d H:i:s");
        $sql = "UPDATE tokens SET date ='$date' WHERE idu=$idu";
        //print($sql);
        $result = $conn->query($sql);
        if ($result) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
       }
    }

    public function checkLoginPassword(){
        // $options = [
        //     'cost' => 12,
        // ];
        // echo password_hash("123", PASSWORD_BCRYPT, $options);
        $conn=$this->connectDB();
        //print(gettype($conn));
        if (!is_null($conn)){
            $sql="SELECT id FROM users WHERE login=?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param('s', $_POST['email']);
            $stmt->execute();
            print("A");
            $stmt->store_result();
            if ($stmt->num_rows>0){
                $stmt->bind_result($id);
                $stmt->fetch();
                $sql="SELECT pwd FROM users WHERE id=?";
                $stmt->free_result();
                $stmt->close();
                $stmt=$conn->prepare($sql);
                //print_r($conn);
                $stmt->bind_param('s', $id);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows>0){
                    //$this->set("error", "Udało się zalogować");
                    $stmt->bind_result($pwd);
                    $stmt->fetch();
                    //print($id);
                    $stmt->free_result();
                    if (password_verify( $_POST['pwd'],$pwd)) {
                        $stmt->close();
                        $conn->close();
                        //session_start();
                        $this->setLogin($_POST['email']);
                        $this->setToken($id);
                        $this->setSession($id,$this->login,$this->token);
                        return true;
                    }else{
                        $stmt->close();
                        $conn->close();
                        return false;
                    }
                }else{ 
                    $stmt->close();
                    $conn->close();
                    return false;
                }
            }else{
                $conn->close();
                return false;
            }
        }else{
            $conn->close();
            return false;
        }
        // if (($_POST['email']=="bartek@gmail.com") && ($_POST['pwd']=="bartek")){
        //     //$this->set("error", "Udało się zalogować");
        //     //session_start();
        //     $this->setLogin($_POST['email']);
        //     $this->setPassword($_POST['pwd']);
        //     $this->setSession($this->login,$this->password);
        //     return true;
        // }else return false;   
    }

    public function setSession($idu,$login, $token){
        $_SESSION['idu'] = $idu;
        $_SESSION['login'] = $login;
        $_SESSION['token'] = $token;
    }


    public function logout(){
        $this->deleteToken($_SESSION['idu']);
        session_destroy();
    }
}


?>