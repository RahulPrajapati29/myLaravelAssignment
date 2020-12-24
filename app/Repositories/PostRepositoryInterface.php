<?php


namespace App\Repositories;


interface PostRepositoryInterface
{
    public function find($id);

    public function all();

    public function index();

    public function create();

    public function store();

    public function edit($id);

    public function update($id);

    public function destroy($id);
}
