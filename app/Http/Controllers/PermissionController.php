<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;
class PermissionController extends Controller
{
    //
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create()
    {
        return $this->userRepository->create();
    }
    public function store()
    {
        return $this->userRepository->store();

    }
    public function setPermission($user_id, $user_name, $data)
    {
        return $this->userRepository->setPermission($user_id, $user_name, $data);
    }
}
