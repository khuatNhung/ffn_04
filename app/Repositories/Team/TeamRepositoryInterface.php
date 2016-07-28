<?php

namespace App\Repositories\Team;

interface TeamRepositoryInterface
{
    public function index($subject, $options = []);
    public function show($id);
    public function store($data);
    public function all($filters = []);
    public function update($data, $id);
    public function delete($id);
}
