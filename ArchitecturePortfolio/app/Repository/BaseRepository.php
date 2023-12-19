<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected Model $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data): Model
    {
        $record = $this->model->find($id);
        if (!$record) {
            return false;
        }

        return $record->update($data);
    }

    /**
     * @param $id
     * @return false
     */
    public function delete($id): bool
    {
        $record = $this->model->findOrFail($id);
        if (!$record) {
            return false;
        }

        return $record->delete();
    }
}
