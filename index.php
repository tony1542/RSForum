<?php

include 'classes/Skills.php';

foreach (Skills::ALL as $skill) {
    echo '<img src="' . Skills::getSkillIconFromName($skill) . '" />';
    echo '<br>';
}
