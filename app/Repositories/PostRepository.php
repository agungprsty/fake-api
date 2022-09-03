<?php

namespace App\Repositories;

class PostRepository extends BaseRepository
{
    /**
    * Get data post.
    *
    * @return Post
    */
    protected function posts()
    {
        return json_decode(file_get_contents(storage_path("app") . "/posts.json"), true);
    }

    /**
    * Get data comments.
    *
    * @return Array
    */
    protected function relations(): array
    {
        $comments = json_decode(file_get_contents(storage_path("app") . "/comments.json"), true);
        
        return ["comments" => $comments];
    }

     /**
     * Get all post.
     *
     * @return Post
     */
    public function all(array $qs)
    {
        $posts = $this->posts();

        $page = $qs['page'];
        $per_page = $qs['per_page'];

        // Calculate total number of records, and total number of pages
        $total_records = count($posts);
        $total_pages   = ceil($total_records / $per_page);

        // Validation: Page to display can not be greater than the total number of pages
        if ($page > $total_pages) {
            $page = $total_pages;
        }

        // Calculate the position of the first record of the page to display
        $offset = ($page - 1) * $per_page;

        return array_slice($posts, $offset, $per_page);
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

    /**
     * Get comments by ID post
     *
     * @param Array $data
     * @return Comments
     */

    public function comments(string $id): array
    {
        $comments = $this->relations()['comments'];
        
        $result = [];
        if ($id > 100){
            return $result;
        }

        foreach ($comments as $data) {
            if ($data["post_id"] == $id) {
                array_push($result, $data);
            }
        }
        
        return $result;
    }
}