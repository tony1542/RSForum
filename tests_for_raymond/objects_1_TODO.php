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
    // correct, can only have one constructor per class in PHP

    $player = new runescape_player('2277');
    
   echo "<h1>Notice the declaration of two variables down here:</h1>";
    echo "<pre>";
    print_r($player);
    echo "</pre>";
   
    $exp = new max_club('451,380,905'); // nice, actually used my exp lol

    echo "<h1>Notice the declaration of two variables down here:</h1>";
    echo "<pre>";
    print_r($exp);
    echo "</pre>";

   echo "Total Level for Tony_X is " .$player->totalLevel. " and his total EXP is " . $exp->maxExp . " for now...";

   echo "<h3>You are getting two variables in the object because you are dynamically declaring a variable.
             This is happening because you are using `this->variableNameThatDoesntExistYet` if that makes sense.
             PHP sees this and dyanmically creates a `public variableNameThatDoesntExistYet` if you assign it like you did in your constructors.
             Let me know when you're avaiable to have a chat about it for me to clear more up about it. It's a confusing concept.
             What you wrote technically works, but it only works because PHP can be a messy tool.
         </h3>";
   
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

    // lmao
    echo "BREAKING NEWS: KIZE HAS HIT THE MAX RECORD OF " .$player2->getTotalLVL() . " TOTAL LEVEL, RUNESCAPE IS CROWNING HIM THE BEST EVER AT RUNESCAPE WITH 16 KING BLACK DRAGON KILLS!!";


    
    /*
     * Here is an example of what you're doing, i use the declaredVariable, and then the way you did it, by copying the parameter name
     * It should hopefully shed some light on why it is 'incorrect', but we can chat sometime to go over it more thoroughly
     */
    class test_class {
        public $declaredVariable = '';
        
        public function __construct($variable_that_is_declared) {
            $this->declaredVariable = $variable_that_is_declared;
            $this->variable_that_is_declared = $variable_that_is_declared;
        }
    }
    
    $test = new test_class('test_string');
    echo "<h3>Notice the two types of variables within the object.</h3>";
    echo "<pre>";
    print_r($test);
    echo "</pre>";
    