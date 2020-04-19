<?php
/**
 * tcc module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Tcc_controller extends Module_controller
{
    
    /*** Protect methods with auth! ****/
    public function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }
    
    /**
    * Default method
    *
    * @author AvB
    **/
    public function index()
    {
        echo "You've loaded the tcc module!";
    }
    
    /**
    * Retrieve data in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_tab_data($serial_number = '')
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
        
        $sql = "SELECT service, client, allowed, prompt_count, indirect_object_identifier, last_modified, dbpath 
                        FROM tcc 
                        WHERE serial_number = '$serial_number'";
        
        $queryobj = new Tcc_model();
        $tcc_tab = $queryobj->query($sql);
        $obj->view('json', array('msg' => current(array('msg' => $tcc_tab)))); 
    }
} // END class Tcc_devices_controller