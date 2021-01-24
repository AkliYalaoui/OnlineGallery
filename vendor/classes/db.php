<?php


class DB
{
    private ?PDO $con;

    public function __construct(private string $dsn, private string $user, private string $pwd){}

    public function connect(){
        try {
            $this->con =  new PDO($this->dsn,$this->user,$this->pwd);
        }catch (PDOException $e){
            view("../../exceptions/views/e.500.php");
        }
    }
    public function query(string $query){
        $stmt = $this->con->query($query);
        $stmt->execute();
    }

    public function getCon(): ?PDO
    {
        return $this->con;
    }
}