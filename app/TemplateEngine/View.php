<?php

namespace App\TemplateEngine;

use App\Exceptions\ViewException;
use App\Library\Parser\HtmlParser;

class View
{
    private string $view;
    private array $params;
    private $directory;
    private HtmlParser $parser;

    public function __construct(string $view, array $params)
    {
        $this->view = $view;
        $this->params = $params;
        $this->directory = __DIR__ . "/../../resource/views/";
        $this->parser = new HtmlParser();
        
    }

    /**
     * Will check if the file exists and then handle the rendering
     *
     * @throws ViewException
     */
    public function doesFileExist()
    {   
        if (!file_exists(__DIR__ . "/../../resource/views/{$this->view}.php")) {
            throw new ViewException('View Cannot be found', 404);
        }

        return $this->handle();
    }

    private function handle()
    {
        //$this->view = 'shopping-cart/parse-test';
        //TODO will need to look at parsing the text and convert the bracket syntax
        //$file = file_get_contents($this->directory . $this->view . '.php', true);

        //dd($this->parser->parse($file));
        //exit;
        // //need to assign the html to a variable
        foreach($this->params as $key => $value) {
            $$key = $value;
        }
        //echo $this->parser->parse($file);
        ob_start();
        //extract view
        include_once __DIR__ . "/../../resource/views/{$this->view}.php";
        //this will contain the contents of the view and clean the buffer
        $content = ob_get_clean(); //static::obGetClean();
        //then return the output between the header and footer
        include_once __DIR__ . "/../../resource/layout/layout.php";
    }


    // public function getHTML()
    // {
    //     $fileDirectory = __DIR__ . "/../../resource/views/{$this->view}.php";
    //     $html = $this->dom->loadHtml($fileDirectory);
       
    //     if ($html) {
    //         $this->dom->saveHtml();
    //     }
        
    // }

}
