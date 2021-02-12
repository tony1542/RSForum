<?php

use App\Utils\StylePreference;

$preference = StylePreference::get();

if ($preference === StylePreference::STYLE_LIGHT) {
    echo '<script src="/dist/appLight.bundle.js"></script>';
} elseif ($preference === StylePreference::STYLE_DARK) {
    echo '<script src="/dist/appDark.bundle.js"></script>';
}
