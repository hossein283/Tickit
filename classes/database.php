<?php

namespace classes;

class database
{
    private $dbname;
    private $dbUsername;
    private $dbPssword;
    private $options;
    protected $pdo;
    public function __construct($name,$username,$password)
    {
        $this->dbname=$name;
        $this->dbUsername=$username;
        $this->dbPssword=$password;
        $this->options=array(\PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8',\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_WARNING);
        $this->pdo=new \PDO('mysql:host=localhost;dbname='.$this->dbname.';',$this->dbUsername,$this->dbPssword);
    }
}
?>