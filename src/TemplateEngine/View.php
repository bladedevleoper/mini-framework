<?php

namespace ShoppingCart\TemplateEngine;


class View
{

    private string $view;
    private array $params;

    public function __construct(string $view, array $params)
    {
        $this->view = $view;
        $this->params = $params;
    }

    public function handle()
    {
        //need to assign the html to a variable
        foreach($this->params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        //extract view
        include_once __DIR__ . "/../../resource/views/{$this->view}.php";
        //this will contain the contents of the view and clean the buffer
        $content = ob_get_clean(); //static::obGetClean();
        //then return the output between the header and footer
        include_once __DIR__ . "/../../resource/layout/layout.php";

    }

}