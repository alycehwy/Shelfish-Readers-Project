<?php
    class CreateDb{
            public $servername;
            public $username;
            public $password;
            public $dbname;
            public $tablename;
            public $dbcon;
                public function __construct(
                $dbname = "shelfishrd_db",$tablename = "book_bs_tb",$servername = "localhost",$username = "root",$password = ""
        )
        {
        $this->dbname = $dbname;$this->tablename = $tablename;$this->servername = $servername;$this->username = $username;$this->password = $password;

            $this->dbcon = mysqli_connect($servername, $username, $password);

            if (!$this->dbcon){
                die("Connection failed : " . mysqli_connect_error());
            }

            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

            if(mysqli_query($this->dbcon, $sql)){

                $this->dbcon = mysqli_connect($servername, $username, $password, $dbname);

                $sql = " CREATE TABLE IF NOT EXISTS $tablename
                                (productid INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                productName VARCHAR (250) NOT NULL,
                                authorName VARCHAR (250) NOT NULL,
                                productDetails VARCHAR (100) NOT NULL,
                                price FLOAT,
                                sourceImg VARCHAR (200)
                                );";

                if (!mysqli_query($this->dbcon, $sql)){
                    echo "Error creating table : " . mysqli_error($this->dbcon);
                }

            }else{
                return false;
            }
        }

        public function getData(){
            $sql = "SELECT * FROM $this->tablename";

            $result = mysqli_query($this->dbcon, $sql);

            if(mysqli_num_rows($result) > 0){
                return $result;
            }
        }
    }

?>