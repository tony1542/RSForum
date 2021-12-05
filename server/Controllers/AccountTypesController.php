<?php

namespace App\Controllers;

use App\Utils\Runescape\AccountType;

class AccountTypesController extends AbstractBaseController
{
    public function canAccess(string $action, array $parameters = []): bool
    {
        return true;
    }

    public function all(): void
    {
        jsonResponse(AccountType::getAll(), JSON_FORCE_OBJECT);
    }
}
