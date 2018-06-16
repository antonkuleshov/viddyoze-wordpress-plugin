<?php

/*
Plugin Name: Get Quote Api
Plugin URI: http://get-quote-api-info
Description: Get Quote Api
Version: 1.0
Author: Anton Kuleshov
Author URI: anton.kuleshov.biz


Copyright 2018  Anton_Kuleshov  (email: antonkuleshov8@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once('GetQuoteApiClass.php');

add_action('wp_footer', 'print_random_quote');
add_action('admin_menu', 'quotes_admin_menu');

function print_random_quote() {
    $data = GetQuoteApiClass::quotes();

    $quotes = json_decode($data, true);

    $quotesIdArray = [];
    foreach ($quotes['data'] as $quote) {
        array_push($quotesIdArray, $quote['id']);
    }

    $randQuoteId = array_rand($quotesIdArray);

    $randQuote = GetQuoteApiClass::quote($randQuoteId);

    dd($randQuote);

    echo "<blockquote><p>".$randQuote['data']['text']."</p></blockquote><hr><p>".$randQuote['data']['author']."</p>";
}

function quotes_admin_menu() {
    add_menu_page('Quotes Admin',
        'Quotes Admin Menu', 'manage_options',
        'get-quote-api-index',
        'quotes_admin_page', 'dashicons-tickets',
        6
    );

    add_submenu_page('get-quote-api-index',
        'Create Quote',
        'Create',
        'manage_options',
        'get-quote-api-create-form',
        'quote_create_form'
    );

    add_submenu_page(null,
        '',
        '',
        'manage_options',
        'get-quote-api-create',
        'quote_create'
    );

    add_submenu_page(null,
        'Edit Quote',
        'Edit',
        'manage_options',
        'get-quote-api-edit',
        'quote_edit'
    );

    add_submenu_page(null,
        '',
        '',
        'manage_options',
        'get-quote-api-update',
        'quote_create'
    );

    add_submenu_page(null,
        '',
        '',
        'manage_options',
        'delete_quote_api',
        'quote_delete'
    );
}

function quotes_admin_page(){

    add_query_arg([
        'numPage' => 'numPage',
        'totalItems' => 'totalItems',
        'itemsPerPage' => 'itemsPerPage',
        'page'=>'get-quote-api-index',
        'author' => 'author'
    ], admin_url('admin.php'));

    $data = GetQuoteApiClass::quotes();

    $quotes = json_decode($data, true);

    require_once('templates/index.html.php');
}

function quote_create_form(){
    require_once('templates/create.html.php');
}

function quote_create(){
    if('POST' == $_SERVER['REQUEST_METHOD']) {

        $data = ['data' => ['author' => $_POST['author'], 'text' => $_POST['text']]];
        $json = json_encode($data);

        //GetQuoteApiClass::create($json);

        wp_redirect(admin_url('admin.php?page=quotes_admin_page'));
        exit;
    }
}

function quote_edit(){

    add_query_arg([
        'id' => 'id',
        'page'=>'get-quote-api-edit'
    ], admin_url('admin.php'));

    $data = GetQuoteApiClass::quote();

    $quote = json_decode($data, true);

    require_once('templates/edit.html.php');
}

function quote_update(){
    if('POST' == $_SERVER['REQUEST_METHOD']) {

        $data = ['data' => ['author' => $_POST['author'], 'text' => $_POST['text']]];
        $json = json_encode($data);

        GetQuoteApiClass::update($json);

        wp_redirect(admin_url('admin.php?page=quotes_admin_page'));
        exit;
    }
}

function quote_delete() {
    add_query_arg([
        'id' => 'id',
        'page'=>'delete_quote_api'
    ], admin_url('admin.php'));

    GetQuoteApiClass::delete();

    wp_redirect('quotes_admin_page');
    exit;
}


