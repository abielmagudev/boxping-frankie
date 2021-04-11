<?php namespace System\Core;

abstract class Session {
    
    static public function start()
    {
        return session_start();
    }
    
    static public function sid()
    {
        return session_id();
    }
    
    static public function all()
    {
        return $_SESSION;
    }
    
    static public function has($key, $subkey = null)
    {
        if( !is_null($subkey) )
            return isset( $_SESSION[$key][$subkey] ) && !empty( $_SESSION[$key][$subkey] );

        return isset( $_SESSION[$key] ) && !empty($_SESSION[$key]);
    }
    
    static public function exists($key, $subkey = null)
    {
        if( !is_null($subkey) )
            return array_key_exists($subkey, $_SESSION[$key]);

        return array_key_exists($key, $_SESSION);
    }
    
    static public function set($key, $val)
    {
        if($key <> 'flash')
            return $_SESSION[$key] = $val;
        Warning::stop('[flash] is reserved word, use another');
    }
    
    static public function flash($val)
    {
        return $_SESSION['flash'] = $val;
    }
    
    static public function get($key, $subkey = null)
    {
        if( self::has($key) )
        {
            if( !is_null($subkey) && isset($_SESSION[$key][$subkey]) )
                return $_SESSION[$key][$subkey];
            
            return $_SESSION[$key];
        }
        return false;
    }
        
    static public function erase($key)
    {
        if( self::exists($key) )
            unset($_SESSION[$key]);
        return true;
    }
    
    static public function finish()
    {
        $_SESSION = [];
        return session_destroy();
    }
}