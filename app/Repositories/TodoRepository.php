<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository extends BaseRepository
{
    /**
    * Initiation todo by user ID.
    *
    * @return Todo
    */
    protected function todos()
    {        
        return json_decode(file_get_contents(storage_path() . "/app/todos.json"), true);
    }

     /**
     * Get all todo.
     *
     * @return Todo
     */
    public function all()
    {
        return $this->todos();
    }

     /**
     * Get by id todo.
     *
     * @param String $id
     * @return Todo
     */
    public function get_by_id(string $id): object
    {
        $result = (object) [];
        foreach ($this->todos() as $posts) {
            if ($posts['id'] == $id){
                $result->uid = $posts['uid'];
                $result->id = $posts['id'];
                $result->title = $posts['title'];
                $result->completed = $posts['completed'];
            }
        }

        return $result;
    }

    /**
     * Create new todo
     *
     * @return Todo
     */
    public function store(): object
    {
        $input = request()->all();
        
        return (object) [
            "id" => 201,
            "title" => $input['title'],
            "completed" => $input['completed'],
        ];
    }

    /**
     * Update todo
     *
     * @param Object $data
     * @return Todo
     */
    public function update(object $data): object
    {
        $input = request()->all();
        return (object) [
            "uid" => $data->uid,
            "id" => $data->id,
            "title" => $input['title'],
            "completed" => $input['completed'],
        ];
    }
}