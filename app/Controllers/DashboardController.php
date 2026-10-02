<?php

namespace App\Controllers;

use CodeIgniter\Shield\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        $authGroups = config('AuthGroups');

        $data = [
            'title'           => 'Dashboard',
            'page_title'      => 'Dashboard',
            'user'            => $user,
            'userGroups'      => $user->getGroups(),
            'activeGroup'     => activeGroup(),
            'groupTitle'      => activeGroupTitle(),
            'userCount'       => activeGroupCan('admin.access') ? (new UserModel())->countAllResults() : null,
            'roleCount'       => count($authGroups->groups),
            'permissionCount' => count($authGroups->permissions),
        ];

        return $this->renderView('dashboard/adminlte', $data, 'layouts/adminlte');
    }
}
