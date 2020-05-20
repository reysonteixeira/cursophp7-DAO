<?php
    class Usuario{
        private $idusuario;
        private $deslogin;
        private $dessenha;
        private $dtcadastro;

        public function getIdusuario()
        {
                return $this->idusuario;
        }
 
        public function getDeslogin()
        {
                return $this->deslogin;
        }

        public function getDessenha()
        {
                return $this->dessenha;
        }

        public function getDtcadastro()
        {
                return $this->dtcadastro;
        }

        public function setIdusuario($value)
        {
                $this->idusuario = $value;
        }

        public function setDeslogin($value)
        {
                $this->deslogin = $value;
        }

        public function setDessenha($value)
        {
                $this->dessenha = $value;
        }

        public function setDtcadastro($dtcadastro)
        {
                $this->dtcadastro = $dtcadastro;
        }

        public function loadById($id){
            $sql = new Sql();
            $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

            if(count($result) > 0){
                $this->setData($result[0]);
            }
        }

        public static function getList(){
            $sql = new Sql();
            return ($sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin"));
        }

        public static function search($login){
            $sql = new Sql();
            return($sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :search ORDER BY deslogin",
            array(':search'=>"%".$login."%")));
        }

        public function login($login, $password){
            $sql = new Sql();
            $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :login AND dessenha = :password", array(":login"=>$login, ":password"=>$password));

            if(count($result) > 0){
                $this->setData($result[0]);
            }
            else{
                throw new Exception("Login e/ou senha invalidos!");
            }
        }

        public function setData($data){
            $this->setIdusuario($data['idusuario']);
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtcadastro($data['dtcadastro']);
        }

        public function insert(){
            $sql = new Sql();
            $results = $sql->select("CALL sp_usuarios_insert(:login, :password)", array(':login'=>$this->getDeslogin(),
            ':password' =>$this->getDessenha()));
            if(count($results)>0){
                $this->setData($results[0]);
            }
        }

        public function update($login, $password)
        {
            $this->setDeslogin($login);
            $this->setDessenha($password);

            $sql = new Sql();
            $sql->query("UPDATE tb_usuarios SET deslogin = :login, dessenha = :password WHERE idusuario = :id", array(
            ':login'=>$this->getDeslogin(), 
            ':password'=>$this->getDessenha(),
            ":id" => $this->getIdusuario()));
        }

        public function delete(){
            $sql = new Sql();
            $sql->query("DELETE FROM tb_usuario WHERE idusuario=:id",array(':id'=>$this->getIdusuario()));

            $this->setIdusuario(0);
            $this->setDeslogin("");
            $this->setDessenha("");
            $this->setDtcadastro(new DateTime());
        }
        public function __construct($login ="", $password=""){
            $this->setDeslogin($login);
            $this->setDessenha($password);
        }

        public function __toString(){
            return json_encode(array(
                "idusuario"=> $this->getIdusuario(),
                "deslogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtcadastro()
            ));
        }
    }


?>