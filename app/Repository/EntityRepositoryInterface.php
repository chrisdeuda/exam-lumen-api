<?php


namespace App\Repository;


interface EntityRepositoryInterface
{
    public function find(int $id);
    public function getAll();
}
