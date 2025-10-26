<?php
class Controller 
{
    protected $loadedModels = [];

    public function redirect($path) 
    {
        header("Location: " . BASE_URL . $path);
        exit;
    }

    public function model($modelName) {
        $modelName = ucfirst($modelName);

        if (isset($this->loadedModels[$modelName])) {
            return $this->loadedModels[$modelName];
        }

        if (class_exists($modelName)) {
        $model = new $modelName();

        $this->loadedModels[$modelName] = $model; 
        
        return $model;
    }


        throw new \Exception("Model {$modelName} not found.");
    }

}