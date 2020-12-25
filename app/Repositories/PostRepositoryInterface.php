<?php


namespace App\Repositories;


interface PostRepositoryInterface
{
    public function find($id);

    public function all();

    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request,$id);

    public function destroy($id);
}
