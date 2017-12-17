<?php


namespace tsumugi\Repositories;

interface RepositoryInterface
{
    public function all();

    public function first();

    public function paginate();

    public function find($id);
}
