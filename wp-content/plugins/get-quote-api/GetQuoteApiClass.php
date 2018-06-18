<?php

class GetQuoteApiClass
{
    const BASE_URL = "http://18.209.4.126/viddyoze-laravel";

    public function quotes()
    {
        $page = $_GET['numPage'];
        $totalItems = $_GET['totalItems'];
        $itemsPerPage = $_GET['itemsPerPage'];

        if(isset($_GET['author'])) {
            $author = $_GET['author'];
        }

        $url = GetQuoteApiClass::BASE_URL."/api/quotes?page=".$page."&totalItems=".$totalItems."&itemsPerPage=".$itemsPerPage.((isset($author)) ? "&author=".$author : null);

        $request = wp_remote_get($url);

        if( is_wp_error($request) ) {
            return false;
        }

        $body = wp_remote_retrieve_body($request);

        return $body;
    }

    public function quote($quoteId = null)
    {
        if($quoteId != null) {
            $id = $quoteId;
        } else {
            $id = $_GET['id'];
        }

        $url = GetQuoteApiClass::BASE_URL."/api/quotes/".$id;

        $request = wp_remote_get($url);

        if( is_wp_error($request) ) {
            return false;
        }

        $body = wp_remote_retrieve_body($request);

        return $body;
    }

    /**
     * Create a quote
     */
    public function create($json)
    {
        $url = GetQuoteApiClass::BASE_URL."/api/quotes/";

        $request = wp_remote_request($url, [
            'method' => 'POST',
            'body' => [
                'json' => $json
            ]
        ]);

        if( is_wp_error($request) ) {
            return false;
        }

        wp_remote_retrieve_body($request);
    }

    /**
     * Updates a quote
     */
    public function update($id, $json)
    {
        $url = GetQuoteApiClass::BASE_URL."/api/quotes/".$id;

        $request = wp_remote_request($url, [
            'method' => 'PUT',
            'headers'  => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'body' => [
                'json' => $json
            ]
        ]);

        if( is_wp_error($request) ) {
            return false;
        }

        wp_remote_retrieve_body($request);
    }

    /**
     * Delete a quote
     */
    public function delete()
    {
        $id = $_GET['id'];

        $url = GetQuoteApiClass::BASE_URL."/api/quotes/".$id;

        $request = wp_remote_request($url, ['method' => 'DELETE']);

        if(is_wp_error($request)) {
            return false;
        }

        wp_remote_retrieve_body($request);
    }
}