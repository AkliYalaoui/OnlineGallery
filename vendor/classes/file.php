<?php


class File
{
    private array $errors = [];
    private ?string $ext = null;
    private const MAX_SIZE = 2**25;
    private const EXTENSION = ["jpg","jpeg","gif","mp4","mp3","png"];

    public function __construct(private array $file){}

    public function store($name):bool{
        if(count($this->getErrors()) > 0)
                return false;

        return move_uploaded_file($this->file["tmp_name"],"../../storage/".$name.".".$this->ext);
    }
    public function getExt(): string
    {
        return $this->ext = strtolower(pathinfo($this->file['name'],PATHINFO_EXTENSION));
    }
    public function getErrors():array{
        if($this->file['error'] !== 0){
            $this->errors[] = "sorry,something went wrong";
        }
        if($this->file["size"] > self::MAX_SIZE){
            $this->errors[] = "max size is reached,try to compress file before uploading it";
        }
        if(!in_array($this->getExt(),self::EXTENSION)){
            $this->errors[] = "extension not recognised";
        }
        return $this->errors;
    }
}