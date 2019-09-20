<?php

class slayer {
     public $task;
     public $qty;

     public $CompletedTask = false;

    public function __construct($task, $qty)
    {
        $this->task = $task;
        $this->qty = $qty;
    }
    public function complete()
    {
        $this->CompletedTask = true;
    }
}

$slayer = new slayer('Hell Hounds', 153);


$slayer->Complete();

var_dump($slayer);
var_dump($slayer->CompletedTask);

