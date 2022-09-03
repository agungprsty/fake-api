<?php

use Illuminate\Http\Response;


if(!function_exists('safe_int')){
    /**
     * Safely convert a string to an integer.
     */
    function safe_int(int $value, int $default = 0)
    {
        return $value ?: $default;
    }
}

if(!function_exists('json_response')){
    /**
     * Wrap json response.
     */
    function json_response(
        mixed $data = null,
        mixed $pagination = null,
        int $status = 200
    ){
        $content = [
            'meta' => [
                'status' => $status,
                'message' => Response::$statusTexts[$status]
            ],
        ];

        if ($data){
            $content['data'] = $data;
        }
        if ($pagination){
            $content['meta']['pagination'] = $pagination;
        }

        return response()->json($content, $status);
    }
}

if(!function_exists('check_query_string')){
    /**
     * Check query string.
     */
    function check_query_string(): array
    {
        $result['page'] = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $result['per_page'] = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10;

        // Validation: Page to display can not be less than 1 or 
        // Request page greater than 100
        if ($result['page'] < 1 || $result['page'] > 100) {
            $result['page'] = 1;
        }

        // Validation: Request per page greater than 100
        if ($result['per_page'] > 100) {
            $result['per_page'] = 10;
        }

        return $result;
    }
}