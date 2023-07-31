<?php

namespace Modules\Field\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class FieldTLinkPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
