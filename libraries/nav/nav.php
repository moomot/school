<?php

/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 1/30/16
 * Time: 11:03 PM
 */
class Nav
{
    const ACTIVE_CLASS_NAME = 'active';

    private $baseURI = "";
    /**
     * @var array
     */
    private $links = [];

    /**
     * Nav constructor.
     * @param $baseURI
     */
    public function __construct($baseURI) { $this->baseURI = $baseURI; }

    function setModel(...$links)
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @param null $class
     */
    function render($class = null)
    {
        if ( !empty($class) )
            echo '<ul class="'.$class.'">';
        else
            echo '<ul>';

        $currentLink = $this->getCurrentLink();
        foreach ($this->links as $link) {
            $exploded = explode('/', $link['url']);
            $activeClass = null;
            // If is set action
            if ( isset($exploded[2]) ) {
                $activeClass = $exploded[2] == $currentLink ? 'class="'.self::ACTIVE_CLASS_NAME.'"' : null;
            } else {
                // If controller is set and action is not set
                if ( !empty($exploded[1]) ) $activeClass = $currentLink == 'main' ? 'class="'.self::ACTIVE_CLASS_NAME.'"' : null;
            }
            echo '<li '.$activeClass.'><a href="' . $this->baseURI . $link['url'] . '">' . $link['content'] . '</a>';
        }

        echo '</ul>';
    }

    private function getCurrentLink()
    {
        $base = Url::$baseurl;
        $request_uri = str_replace($base, "", $_SERVER['REQUEST_URI']);
        $routes = explode('/', $request_uri);
        if (!empty($routes[2])) {
            $controller = $routes[2];
            return $controller;
        }
        return "main";
    }

}