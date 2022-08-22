<?php

namespace App\Repositories;

class PostRepository extends BaseRepository
{
    /**
    * Initiation post by user ID.
    *
    * @return Post
    */
    protected function posts()
    {
        return json_decode(file_get_contents(storage_path() . "/app/posts.json"), true);
    }

     /**
     * Get all post.
     *
     * @return Post
     */
    public function all()
    {
        return $this->posts();
    }

     /**
     * Get by id post.
     *
     * @param String $id
     * @return Post
     */
    public function get_by_id(string $id): object
    {
        $result = (object) [];
        foreach ($this->posts() as $posts) {
            if ($posts['id'] == $id){
                $result->uid = $posts['uid'];
                $result->id = $posts['id'];
                $result->title = $posts['title'];
                $result->body = $posts['body'];
            }
        }

        return $result;
    }

    /**
     * Create new post
     *
     * @return Post
     */
    public function store(): object
    {
        $input = request()->all();
        
        return (object) [
            "id" => 101,
            "title" => $input['title'],
            "body" => $input['body'],
        ];
    }

    /**
     * Update post
     *
     * @param Object $data
     * @return Post
     */
    public function update(object $data): object
    {
        $input = request()->all();

        return (object) [
            "uid" => $data->uid,
            "id" => $data->id,
            "title" => $input['title'],
            "body" => $input['body'],
        ];
    }
}