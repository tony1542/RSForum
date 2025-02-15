<?php

namespace App\Models\User;

abstract class AbstractHighscoreComponent
{
    // Get latest updated stats from database (within last 24 hours)
    abstract protected function getUpdatedInLastDay(): array;

    // Insert new highscore component
    abstract protected function insert(): void;
}
