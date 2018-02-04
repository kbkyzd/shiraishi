<?php

namespace tsumugi\Repositories;

class RoleRepository
{
    /**
     * @var array
     */
    protected $availableRoles = [
        'root',
        'merchant',
        'user',
    ];

    /**
     * @return array
     */
    public function getAvailableRoles()
    {
        return $this->availableRoles;
    }
}
