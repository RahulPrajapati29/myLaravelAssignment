<?php


namespace App\Repositories;


interface UserRepositoryInterface
{
    public function selectDataWhereNotAdmin();

    public function pluckNameHavingGivenId($user_id);

    public function find($id);

    public function create();

    public function store();

    public function setPermission($user_id, $user_name, $data);

    public function redirectUser();

    public function fetchDashboardData();
}
