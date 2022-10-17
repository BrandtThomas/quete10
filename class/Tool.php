<?php

class Tool {

    public function getRandomFromArray(array $array)
    {
        $count = count($array);   
        return $array[rand(0, $count - 1)];
    }

}

