<?php


class Learner{

    private int $id;
    private string $champion;
    private string $description;
    private int $age;
    private float $size;
    private string $img;


public function getId(){
    return $this->id;
}
public function getChampion(){
    return $this->champion;
}
public function getDescription(){
    return $this->description;
}
public function getAge(){
    return $this->age;
}
public function getSize(){
    return $this->size;
}
public function getImg(){
    return $this->img;
}


public function setId(int $id){
    return $this->id = $id;
}
public function setChampion(string $champion){
    return $this->champion = $champion;
}
public function setDescription($description){
    return $this->description = $description;
}
public function setAge(int $age){
    return $this->age = $age;
}
public function setSize($size){
    return $this->size = $size;
}
public function setImg($img){
    return $this->img = $img;
}


public function hydrate(array $tab){
    if (isset($tab['id']) && !empty($tab['id'])){
        $this->setId($tab['id']);
    }
    if (isset($tab['champion']) && !empty($tab['champion'])){
        $this->setChampion($tab['champion']);
    }
    if (isset($tab['description']) && !empty($tab['description'])){
        $this->setDescription($tab['description']);
    }
    if (isset($tab['age']) && !empty($tab['age'])){
        $this->setAge($tab['age']);
    }
    if (isset($tab['size']) && !empty($tab['size'])){
        $this->setSize($tab['size']);
    }
    if (isset($tab['img']) && !empty($tab['img'])){
        $this->setImg($tab['img']);
    }

}

}