<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author daniel
 */

/**
 * Modified to use REST client to get port data from our server.
 */
define('REST_SERVER', 'http://backend.local');  // the REST server host
define('REST_PORT', $_SERVER['SERVER_PORT']);   // the port you are running the server on

class Menu extends CI_Model {
    // constructor
    function __construct() {
        parent::__construct();
        //*** Explicitly load the REST libraries. 
        $this->load->library(['curl', 'format', 'rest']);
    }
        
    function rules() { 
        $config = [
            ['field'=>'id', 'label'=>'Menu code', 'rules'=> 'required|integer'],
            ['field'=>'name', 'label'=>'Item name', 'rules'=> 'required'], 
            ['field'=>'description', 'label'=>'Item description', 'rules'=> 'required|max_length[256]'],
            ['field'=>'price', 'label'=>'Item price', 'rules'=> 'required|decimal'], 
            ['field'=>'picture', 'label'=>'Item picture', 'rules'=> 'required'],
            ['field'=>'category', 'label'=>'Menu category', 'rules'=> 'required']
        ];
        return $config; 
    }
    
    // Return all records as an array of objects
    function all()
    {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->get('/maintenance');
    }
    
    // Retrieve an existing DB record as an object
    function get($key, $key2 = null)
    {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->get('/maintenance/item/id/' . $key);
    }
    
    // Create a new data object.
    // Only use this method if intending to create an empty record and then
    // populate it.
    function create()
    {
        //$names = $this->db->list_fields($this->_tableName);
        $names = ['id','name','description','price','picture','category'];
        $object = new StdClass;
        foreach ($names as $name)
            $object->$name = "";
        return $object;
    }
    
    // Delete a record from the DB
    function delete($key, $key2 = null)
    {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->delete('/maintenance/item/id/' . $key);
    }
    
    // Determine if a key exists
    function exists($key, $key2 = null)
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $result = $this->rest->get('/maintenance/item/id/' . $key);
            return ! empty($result);
    }
    
    // Update a record in the DB
    function update($record)
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $retrieved = $this->rest->put('/maintenance/item/id/' . $record['code'], $record);
    }

    // Add a record to the DB
    function add($record)
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $retrieved = $this->rest->post('/maintenance/item/id/' . $record['code'], $record);
    }
}
