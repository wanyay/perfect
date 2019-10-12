<?php
namespace App\Services;

use App\Exceptions\ColumnNotFoundException;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    private $model;

    protected $sortableFields = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function search($keyword = "", $sortType = 'desc', $perPage = 20, $sortable = null)
    {
        if (!is_null($sortable)) {
            $this->isSortableFields($sortable);
        }


        if ($keyword != null) {
            return $this->model->search($keyword)
                ->orderBy($sortable, $sortType)
                ->paginate($perPage);
        }

        return $this->model->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    private function isSortableFields($sortable)
    {
        if (! in_array($sortable, $this->sortableFields)) {
            return new ColumnNotFoundException("Column {$sortable} not found.");
        }
    }

    public function all()
    {
        return $this->model->latest();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->getById($id);

        return tap($model)->update($data);
    }

    public function delete($id)
    {
        $model = $this->getById($id);
        try {
            return $model->delete();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function with($relation)
    {
        return $this->model->with($relation);
    }
}
