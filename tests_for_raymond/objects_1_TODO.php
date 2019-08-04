<?php

/*
 * What I want to see:
 *
 * 1. Make a class called 'runescape_player'
 * 2. Make it have a constructor that accepts a number for that player's total level
 * 3. Assign the class a total_level variable that the constructor uses, like in the instructions script
 * 4. Print out that total level by either accessing it as a variable, or via a function. Again like in the instructions script
 */



   class runescape_player {

       public $TL = '';


        public function __construct($TL){

           $this->totalLevel = $TL;

     }

   }


   class max_club{

       public $MS = '';

       public function __construct($MS){

           $this->maxExp = $MS;


       }


}




    # I was going to have 1 construct but I learned I can't have 2 in 1 class, or at least not that someone of my skill level knows of.

    $player = new runescape_player('2277');
    $exp = new max_club('451,380,905');
   echo "Total Level for Tony_X is " .$player->totalLevel. " and his total EXP is " . $exp->maxExp . " for now...";





   //Also doing it via your 2nd method just to say I did it.

    class runescape_player2 {

        protected $TL = '';

        public function __construct($TL){
            $this->totalLevel = $TL;
        }

        public function getTotalLVL() {
            return $this->totalLevel;
        }

    }

    $player2 = new runescape_player2('9999');
    echo "BREAKING NEWS: KIZE HAS HIT THE MAX RECORD OF " .$player2->getTotalLVL() . " TOTAL LEVEL, RUNESCAPE IS CROWNING HIM THE BEST EVER AT RUNESCAPE WITH 16 KING BLACK DRAGON KILLS!!";



















