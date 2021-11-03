<?php

class PCJSAPI {

    public $url;
    protected $System;

    public function __construct($url) {
        $this->url = $url;
        $this->System = json_decode(file_get_contents($url + "?MM1_jc=200", false,
                        stream_context_create(array(
            "http" => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST' /* ,
              'content' => http_build_query(array(

              )) */
            )
        ))));
    }

    public function getResolveBySystem($name, $post_data = null) {
        if ($post_data == null) {
            $post_data = array();
        }

        function getUrl($url, $getData) {
            $data_get = array();
            foreach ($getData as $key => $value) {
                $data_get[] = $key + "=" + $value;
            }
            return $url + "?" + implode("&", $data_get);
        }

        return file_get_contents(getUrl($this->url, $this->System[$name]["GET"]), false,
                stream_context_create(array(
            "http" => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($post_data)
            )
        )));
    }
    
    public function getJsBySystem($name, $post_data=null) {
        return json_decode($this->getResolveBySystem($name, $post_data));
    }

}
