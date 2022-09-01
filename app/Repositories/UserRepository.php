<?php

namespace App\Repositories;

class UserRepository extends BaseRepository
{
    /**
    * Initiation user by user ID.
    *
    * @return User
    */
    protected function users()
    {
        return json_decode(file_get_contents(storage_path() . "/app/users.json"), true);
    }

     /**
     * Get all user.
     *
     * @return User
     */
    public function all(array $qs)
    {
        $users = $this->users();
        
        $page = $qs['page'];
        $per_page = $qs['per_page'];

        // Calculate total number of records, and total number of pages
        $total_records = count($users);
        $total_pages   = ceil($total_records / $per_page);

        // Validation: Page to display can not be greater than the total number of pages
        if ($page > $total_pages) {
            $page = $total_pages;
        }

        // Calculate the position of the first record of the page to display
        $offset = ($page - 1) * $per_page;

        return array_slice($users, $offset, $per_page);
    }

     /**
     * Get by id user.
     *
     * @param String $id
     * @return User
     */
    public function get_by_id(string $id): object
    {
        $result = (object) [];
        foreach ($this->users() as $users) {
            if ($users['id'] == $id) {
                $result->id = $users['id'];
                $result->name = $users['name'];
                $result->username = $users['username'];
                $result->email = $users['email'];
                $result->address = $users['address'];
                $result->phone = $users['phone'];
                $result->website = $users['website'];
                $result->company = $users['company'];
            }
        }

        return $result;
    }

    /**
     * Create new user
     *
     * @return User
     */
    public function store(): object
    {
        $input = request()->all();
        $result = ["id" => 11];

        foreach ($input as $key => $value) {
            $result[$key] = $value;
        }

        return (object)$result;
    }

    /**
     * Update user
     *
     * @param Object $data
     * @return User
     */
    public function update(object $data): object
    {
        $input = request()->all();
        $result = ["id" => $data->id];
        
        $result_data = [];
        foreach ((array)$data as $key => $value) {
            if ($key != "id") {
                $result_data[$key] = $value;
            }
        }

        $input_data = [];
        foreach ($input as $key => $value) {
            if ($key != "id") {
                $input_data[$key] = $value;
            }
        }

        return (object) array_replace($result, $result_data, $input_data);
    }
}