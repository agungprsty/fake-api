<?php

namespace App\Repositories;

class CommentRepository extends BaseRepository
{
    /**
    * Initiation comment by comment ID.
    *
    * @return Comment
    */
    protected function comments()
    {
        return json_decode(file_get_contents(storage_path() . "/app/comments.json"), true);
    }

     /**
     * Get all comment.
     *
     * @return Comment
     */
    public function all(array $qs)
    {
        $comments = $this->comments();
        
        $page = $qs['page'];
        $per_page = $qs['per_page'];

        // Calculate total number of records, and total number of pages
        $total_records = count($comments);
        $total_pages   = ceil($total_records / $per_page);

        // Validation: Page to display can not be greater than the total number of pages
        if ($page > $total_pages) {
            $page = $total_pages;
        }

        // Calculate the position of the first record of the page to display
        $offset = ($page - 1) * $per_page;

        return array_slice($comments, $offset, $per_page);
    }

     /**
     * Get by id comment.
     *
     * @param String $id
     * @return Comment
     */
    public function get_by_id(string $id): object
    {
        $result = (object) [];
        foreach ($this->comments() as $comments) {
            if ($comments['id'] == $id){
                $result->id = $comments['id'];
                $result->post_id = $comments['post_id'];
                $result->name = $comments['name'];
                $result->email = $comments['email'];
                $result->body = $comments['body'];
            }
        }

        return $result;
    }

    /**
     * Create new comment
     *
     * @return Comment
     */
    public function store(): object
    {
        $input = request()->all();
        $result = ["id" => 501];

        foreach ($input as $key => $value) {
            $result[$key] = $value;
        }

        return (object)$result;
    }

    /**
     * Update comment
     *
     * @param Object $data
     * @return Comment
     */
    public function update(object $data): object
    {
        $input = request()->all();
        
        return (object) [
            "id" => $data->id,
            "post_id" => $data->post_id,
            "name" => $input['name'] ?? $data->name,
            "email" => $input['email'] ?? $data->email,
            "body" => $input['body'] ?? $data->body,
        ];
    }
}