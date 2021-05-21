<?php


namespace App\Repositories;


use App\Repositories\Interfaces\IRepository;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements IRepository
{
    protected $app;

    protected $model;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Model");
        }

        return $this->model = $model;
    }

    public function all(){
        return $this->model->orderBy('id')->get();
    }

    public function show($id){
        return $this->model->find($id);
    }

    public function destroy($id){

        try {
            $item = $this->model->find($id);
            if(!$item){
                return new \Exception('Nenhum registro encontrado');
            }
            return $item->delete($id);
        } catch (\Exception $e){
            return new \Exception('Erro ao deletar registro');
        }


    }

    function paginate($limit = 20){
        return $this->model->paginate($limit);
    }

    function getFillable(){
        return $this->model->getFillable();
    }

    abstract function model(): string;
}
