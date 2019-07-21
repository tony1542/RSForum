<?php

include 'classes/Skills.php';

echo '<h1>Showing icons</h1>';
foreach (Skills::ALL as $skill) {
    echo '<img src="' . Skills::getSkillIconFromName($skill) . '" />';
    echo '<br>';
}

echo '<h1>Invalid usage</h1>';
Skills::getSkillIconFromName('Shovel');
