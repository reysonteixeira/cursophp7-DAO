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
                $row = $result[0];

                $this->setIdusuario($row['idusuario']);
                $this->setDeslogin($row['deslogin']);
                $this->setDessenha($row['dessenha']);
                $this->setDtcadastro($row['dtcadastro']);
            }
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