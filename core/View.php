<?php

namespace core;

class View 
{
    public static function render(string $view_name, array $data = [], ?string $layout_name = 'main')
    {
        foreach ($data as $key => $value) 
        {
            $$key = $value;
        }

        if ($layout_name) 
        {
            ob_start();
            include_once PATH_ROOT.'/view/'.$view_name.'.php';
            $content = ob_get_clean();

            ob_start();
            include_once PATH_ROOT.'/view/layout/'.$layout_name.'.php';
            $layout = ob_get_clean();

            echo str_replace('{{content}}', $content, $layout);
        }
        else 
        {
            include_once PATH_ROOT.'/view/'.$view_name.'.php';
        }
    }
}