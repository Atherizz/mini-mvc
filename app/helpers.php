<?php 
function view($view, $data = []): void
{
    extract($data);
    ob_start();
    require BASE_PATH . "/resources/views/$view.php"; 
    $content = ob_get_clean();
    extract(['content' => $content]);
    require BASE_PATH . "/resources/views/layouts/main.php"; 
}