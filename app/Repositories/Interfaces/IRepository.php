<?php

namespace App\Repositories\Interfaces;

interface IRepository
{
    public function model(): string;

    public function all();

    public function show($id);

    public function destroy($id);

    public function paginate($limit = 20);

    public function getFillable();

}
