<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class PostController extends Controller{
    public function index($id) {
        echo "<h1>Showing post with ID: $id</h1>";
    }
}
