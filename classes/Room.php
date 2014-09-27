<?php

class Room{
    
    private $_db,
            $_result,
            $_query,
            $_geustID,
            $_roomID,
            $_roomNumber,
            $_roomCategory,
            $_roomType;
    
    public function __construct() {
        $this->_db = DB::getInstance();
        
    }
    
    public function sqlResult($sql){
        $this->_result = $this->_db->get()->result();
        foreach ($this->_result as $res){
            $this->_roomID = $res->id;
            $this->_roomNumber = $res->room_number;
            $this->_roomType = $res->room_type_id;
            $this->_roomCategory= $res->room_category_id;            
        }
    }
    
    public function getRoomID(){
        return $this->_roomID;
    }
    public function getRoomNumber(){
        return $this->_roomNumber;
    }
    public function getRoomType(){
        return $this->_roomType;
    }
    public function getRoomCategory(){
        return $this->_roomCategory;
    }
    public function getCurrentGuest(){
        return $this->_roomGuest;
    }
    
    
    
    
    
}

