<?php

namespace App\Http\Controllers;

class Controller
{
    protected $loadedModels = [];

    public function redirect($path)
    {
        header("Location: " . BASE_URL . $path);
        exit;
    }

    protected function model($modelName)
    {
        $modelName = ucfirst($modelName);

        $fullModelName = "App\\Models\\" . $modelName;

        if (isset($this->loadedModels[$fullModelName])) {
            return $this->loadedModels[$fullModelName];
        }

        if (class_exists($fullModelName)) {
            $model = new $fullModelName(); 
            $this->loadedModels[$fullModelName] = $model;
            return $model;
        }

        throw new \Exception("Model {$fullModelName} not found.");
    }
}
