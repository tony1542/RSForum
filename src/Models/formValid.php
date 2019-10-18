<?php

namespace App\Models;

class formValid
{
    public function test_input($formValidate)
    {
        $formValidate = trim($formValidate); // removes white spaces and other predifined characters from the left and right side of a string.
        $formValidate = stripslashes($formValidate); // removes backslashes
        $formValidate = htmlspecialchars($formValidate); // converts predifined html entities back to characters, e.g. > becomes &gt;
        
        return $formValidate;
    }
}
