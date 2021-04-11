<?php namespace System\Core;

class Url {

    private static $instance = null;
    private $server;
    private $protocol;
    private $domain;
    private $host;
    private $port;
    private $self;
    private $query;
    private $url;
    private $uri;
    private $referer;
    private $public;
    private $base;
    private $base_port;

    private function __construct()
    {
        $this->server   = $_SERVER;
        $this->protocol = isset($this->server['HTTPS']) ? 'https' : 'http';
        $this->domain   = $this->server['SERVER_NAME'];
        $this->host     = $this->server['HTTP_HOST'];
        $this->dns      = "{$this->protocol}://{$this->domain}";
        $this->port     = !empty($this->server['SERVER_PORT']) ? ":{$this->server['SERVER_PORT']}" : '';
        $this->self     = $this->server['PHP_SELF'];
        $this->query    = $this->server['QUERY_STRING'];
        $this->url      = isset($this->server['REDIRECT_URL']) ? $this->server['REDIRECT_URL'] : null;
        $this->uri      = $this->server['REQUEST_URI'];
        $this->referer  = isset($this->server['HTTP_REFERER']) ? $this->server['HTTP_REFERER'] : null;
        $this->public   = str_replace('index.php', '', $this->server['PHP_SELF']);
        $this->base     = $this->dns.$this->public;
        $this->base_port = $this->dns.$this->port.$this->public;
    }

    private function location($url = '')
    {
        return header('Location: '.$url);
        exit;
    }

    private function getQuery( $args = [] )
    {
        if( !is_array($args) || !count($args) ) 
            return '';

        $uri  = '?';
        $query = [];

        foreach($args as $pos => $value)
        {
            $key = is_string($pos) ? $pos : "X{$pos}";
            $item = "{$key}={$value}";
            array_push($query, $item);
        }

        $uri .= implode('&', $query);
        return $uri;
    }

    static public function getRoute($url, $args = null)
    {   
        $self  = self::getInstance();
        $query = $self->getQuery($args);
        return $self->base.$url.$query;
    }

    static public function redirect($url, $args = null)
    {
        $self  = self::getInstance();
        $route = self::getRoute($url, $args);
        return $self->location( $route );
    }
    
    static public function back()
    {
        $self = self::getInstance();
        $redirect = !is_null( $self->referer ) ? $self->referer : $self->base;
        return $self->location( $redirect );
    }

    static public function getInstance()
    {
        if( is_null( self::$instance ) )
            self::$instance = new Url();

        return self::$instance;
    }
}





/*
[REDIRECT_STATUS] => 200
    [HTTP_HOST] => localhost:8888
    [HTTP_CONNECTION] => keep-alive
    [HTTP_CACHE_CONTROL] => max-age=0
    [HTTP_UPGRADE_INSECURE_REQUESTS] => 1
    [HTTP_USER_AGENT] => Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36
    [HTTP_ACCEPT] => text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*_/*;q=0.8
    [HTTP_ACCEPT_ENCODING] => gzip, deflate, br
    [HTTP_ACCEPT_LANGUAGE] => en-US,en;q=0.9,es;q=0.8
    [PATH] => /usr/bin:/bin:/usr/sbin:/sbin
    [SERVER_SIGNATURE] => 
    [SERVER_SOFTWARE] => Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.2.1 mod_ssl/2.2.34 OpenSSL/1.0.2j DAV/2 mod_fastcgi/2.4.6 mod_perl/2.0.9 Perl/v5.24.0
    [SERVER_NAME] => localhost
    [SERVER_ADDR] => ::1
    [SERVER_PORT] => 8888
    [REMOTE_ADDR] => ::1
    [DOCUMENT_ROOT] => /Applications/MAMP/htdocs
    [SERVER_ADMIN] => you@example.com
    [SCRIPT_FILENAME] => /Applications/MAMP/htdocs/maguk/new/public/index.php
    [REMOTE_PORT] => 49555
    [REDIRECT_QUERY_STRING] => url=dashboard
    [REDIRECT_URL] => /maguk/new/public/dashboard
    [GATEWAY_INTERFACE] => CGI/1.1
    [SERVER_PROTOCOL] => HTTP/1.1
    [REQUEST_METHOD] => GET
    [QUERY_STRING] => url=dashboard
    [REQUEST_URI] => /maguk/new/public/dashboard
    [SCRIPT_NAME] => /maguk/new/public/index.php
    [PHP_SELF] => /maguk/new/public/index.php
    [REQUEST_TIME_FLOAT] => 1527714810.478
    [REQUEST_TIME] => 1527714810
    [argv] => Array
        (
            [0] => url=dashboard
        )

    [argc] => 1
)
*/