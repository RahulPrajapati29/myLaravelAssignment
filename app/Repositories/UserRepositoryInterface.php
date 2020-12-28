<?php


namespace App\Repositories;


interface UserRepositoryInterface
{
    public function all();

    public function selectDataWhereNotAdmin();

    public function pluckNameHavingGivenId($user_id);

    public function find($id);

    public function create();

    public function store($user_id);

    public function setPermission($user_id, $user_name);

    public function redirectUser();

    public function fetchDashboardData();
}
