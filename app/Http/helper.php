<?php

if(!function_exists('responseApi'))
{
    function responseApi($data = null, string $message, int $status)
    {
        $response = [
            'message' => $message,
            'status' => $status
        ];
        if($data){
            $response['data'] = $data;
        }
        return response()->json($response, $status);
    }
}
