<?php

namespace App\Utils;

class Session
{
    /**
     * Show the contents of a session variable & unset it after
     *
     * @param string $key
     */
    public static function flash($key)
    {
        if ( isset($_SESSION['username']) )
        {
?>
            <div class="alert alert-success" role="alert">
                Welcome, <?= $_SESSION[$key]?>
            </div>

<?php
            unset($_SESSION[$key]);
        }
    }
}

?>
