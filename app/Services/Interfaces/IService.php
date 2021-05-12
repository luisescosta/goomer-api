<?php


namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface IService
{
    public function all();

    public function show($id);

    public function store(Request $request);

    public function update(Request $request, $id);

    public function destroy($id);

    public function paginate($limit = 20);

}
