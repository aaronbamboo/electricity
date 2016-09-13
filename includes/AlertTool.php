<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlertTool
 *
 * @author Aaron
 */
class AlertMessager {
    
    private $message = null;
    
    private $style = 0;
    
    public function __construct() {
        $this->message = func_get_arg(0);
        $this->style = func_get_arg(1);
    }

    public function alertMessage() {
        switch ($this->style) {
            case 1: 
                echo "<div class = 'alert alert-success pull-right'>". $this->message ."</div>";
                break;
            case 2: 
                echo "<div class = 'alert alert-info pull-right'>". $this->message ."</div>";
                break;
            case 3: 
                echo "<div class = 'alert alert-warning pull-right'>". $this->message ."</div>";
                break;
            case 4: 
                echo "<div class = 'alert alert-danger pull-right'>". $this->message ."</div>";
                break;
            default: echo "";
        }
    }
    
     public function getMessage() {
         return $this->message;
     }
}
