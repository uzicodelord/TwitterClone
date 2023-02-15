<?php

namespace Request;
class Request
{
    private $get_params;
    private $post_params;

    public function __construct()
    {
        $this->get_params = $_GET;
        $this->post_params = $_POST;
    }

    public function get($key)
    {
        if (isset($this->get_params[$key])) {
            return $this->get_params[$key];
        } else {
            return null;
        }
    }

    public function post($key)
    {
        if (isset($this->post_params[$key])) {
            return $this->post_params[$key];
        } else {
            return null;
        }
    }
}

?>