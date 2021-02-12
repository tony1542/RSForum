<?php

namespace App\Controllers;

use App\Utils\Http\Request;
use App\Utils\StylePreference;

class StylePreferencesController extends AbstractBaseController
{
    protected function getIncludePrefix() : string
    {
        return '';
    }
    
    protected function toView(string $view, array $parameters = []) : void {}
    
    public function canAccess($action, $parameters = []): bool
    {
        return true;
    }
    
    public function toggle(): void
    {
        $redirect_url = ucwords(Request::getParameters()['redirectUrl']);
        $preference = StylePreference::get();
        
        $light = StylePreference::STYLE_LIGHT;
        $dark = StylePreference::STYLE_DARK;
    
        $preference = match ($preference) {
            $light => $dark,
            $dark  => $light,
        };
        
        StylePreference::set($preference);
        
        redirect($redirect_url ?: '');
    }
}
