<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PostFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function title($title)
    {
        return $this->where('title', 'LIKE', '%' . $title . '%');
    }

    public function user($id)
    {
        return $this->where('user_id', '=', $id);
    }

    public function search($query)
    {
        return $this->where('title', 'LIKE', '%' . $query . '%');
    }

    public function sort($how)
    {
        if ($how == 'asc') {
            return $this->oldest();
        } else {
            return $this->latest();
        }
    }
}
