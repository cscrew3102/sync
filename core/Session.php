<?php
require_once"core/Uri_file.php";
class Session extends Uri_file
{
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;

    // The state of the session
    private $sessionState = self::SESSION_NOT_STARTED;

    // THE only instance of the class
    private static $instance;


    public function __construct() {}


    /**
    *    Returns THE instance of 'Session'.
    *    The session is automatically initialized if it wasn't.
    *
    *    @return    object
    **/

    public function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }

        self::$instance->startSession();

        return self::$instance;
    }


    /*=============================================
    set session name array
    =============================================*/
    public static function set_session($name = ''){
        if(is_array($name)){
            foreach ($name as $key=>$value) {
                $_SESSION[$key] = $value;
            }
        }
    }



    /*
    ============================================
    get id session
    to user you can do it
    $this::get_userdata('value');
    return session value
    ============================================*/
    public static function get_session($key = '')
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }



    public static function unset_session( $name ='' ){
        if(is_array($name)){
            foreach($name as $res){
               unset( $_SESSION[$res] );
            }
        }else{
            unset( $_SESSION[$name] );
        }
    }


    /**
    *    (Re)starts the session.
    *
    *    @return    bool    TRUE if the session has been initialized, else FALSE.
    **/

    public function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {

            $this->sessionState = session_start();
        }

        return $this->sessionState;
    }


    /**
    *    Stores datas in the session.
    *    Example: $instance->foo = 'bar';
    *
    *    @param    name    Name of the datas.
    *    @param    value    Your datas.
    *    @return    void
    **/

    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }


    /**
    *    Gets datas from the session.
    *    Example: echo $instance->foo;
    *
    *    @param    name    Name of the datas to get.
    *    @return    mixed    Datas stored in session.
    **/

    public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }


    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }


    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }


    /**
    *    Destroys the current session.
    *
    *    @return    bool    TRUE is session has been deleted, else FALSE.
    **/

    public  function  destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );

            return !$this->sessionState;
        }

        return FALSE;
    }

}
 ?>
