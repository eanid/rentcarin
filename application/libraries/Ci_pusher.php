<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Ci_pusher
{
    //public $pusher;

    public function __construct()
    {
        // Load config
        // $this->load->config('pusher');
        $this->load->model('Settings_model');

        // Get config variables
        $app_id     = $this->Settings_model->get_setting('pusher_app_id');
        $app_key    = $this->Settings_model->get_setting('pusher_app_key');
        $app_secret = $this->Settings_model->get_setting('pusher_app_secret');
        $options    = $this->options();

        // Create Pusher object only if we don't already have one
        if (!isset($this->pusher))
        {
            // Create new Pusher object
            $this->pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, $options);
            log_message('debug', 'CI Pusher library loaded');

            // Set logger if debug is set to true
            if ($this->Settings_model->get_setting('pusher_debug') === TRUE )
            {
                $this->pusher->set_logger(new Ci_pusher_logger());
                log_message('debug', 'CI Pusher library debug ON');
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Get Pusher object
     *
     * @return  Object
     */
    public function get_pusher()
    {
        return $this->pusher;
    }

    // --------------------------------------------------------------------

    /**
     * Build optional options array
     *
     * @return  array
     */
    private function options()
    {       
        $options['cluster'] = ($this->Settings_model->get_setting('pusher_cluster')) ?: NULL;
        $options['useTLS'] = ($this->Settings_model->get_setting('pusher_use_tls')) ?: NULL;

        $options = array_filter($options);

        return $options;
    }

    // --------------------------------------------------------------------

    /**
    * Enables the use of CI super-global without having to define an extra variable.
    * I can't remember where I first saw this, so thank you if you are the original author.
    *
    * Copied from the Ion Auth library
    *
    * @access  public
    * @param   $var
    * @return  mixed
    */
    public function __get($var)
    {
        return get_instance()->$var;
    }

}

// --------------------------------------------------------------------

/**
 * Logger class
 *
 * Logs all messages to CodeIgniter log
 */
Class Ci_pusher_logger {

    /**
     * Log Pusher log message to CodeIgniter log
     *
     * @param   string  $msg  The debug message
     */
    public function log($msg)
    {
        log_message('debug', $msg);
    }

    // --------------------------------------------------------------------

    /**
    * Enables the use of CI super-global without having to define an extra variable.
    * I can't remember where I first saw this, so thank you if you are the original author.
    *
    * Copied from the Ion Auth library
    *
    * @access  public
    * @param   $var
    * @return  mixed
    */
    public function __get($var)
    {
        return get_instance()->$var;
    }
}