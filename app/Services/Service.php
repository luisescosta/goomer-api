<?php

namespace App\Services;

use App\Repositories\Repository;
use App\Services\Interfaces\IService;
use Illuminate\Http\Request;

abstract class Service implements IService
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function show($id){
        return $this->repository->show($id);
    }

    public function paginate($limit = 20)
    {
        return $this->repository->paginate($limit);
    }

    public function destroy($id){
        return $this->repository->destroy($id);
    }

    abstract function store(Request $request);

    abstract function update(Request $request, $id);

}
