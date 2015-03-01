<?php

    class FSystem {
        
        private static $_instance;
        private $_root;
        private $_list;   
        private $_content;
        
        public static function getInstance(){
            if(!self::$_instance){
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        
        private function __construct() {
            $this->_root = opendir('.');
        }
        
        public function getRoot(){
            return $this->_root;
        }
        
        public function getList(){
            if ($this->_root) {
                while (false !== ($entry = readdir($this->_root))) {
                    if ($entry != "." && $entry != "..") {
                       $lastModified = date('F d Y, H:i:s',filemtime($entry));
                       $this->_list[$entry]['fname'] = $entry;
                       $this->_list[$entry]['fext'] = @end(explode('.', $entry));
                       $this->_list[$entry]['fdate'] = $lastModified;
                       $this->_list[$entry]['fsize'] = filesize($entry);
                    }
                } 
                closedir($this->_root);
            }
            return $this->_list;
        }
        
        public function sortByDate(){
                usort($this->_list, create_function('$a, $b', 'return strcmp($a["fdate"], $b["fdate"]);'));
                return $this->_list;
        }
        
        public function sortByExt(){
                usort($this->_list, create_function('$a, $b', 'return strcmp($a["fext"], $b["fext"]);'));
                return $this->_list;
        }
        
        public function sortByName(){
                usort($this->_list, create_function('$a, $b', 'return strcmp($a["fname"], $b["fname"]);'));
                return $this->_list;
        }
        
        public function sortBySize(){
                usort($this->_list, create_function('$a, $b', 'return strcmp($a["fsize"], $b["fsize"]);'));
                return $this->_list;
        }    
        
        public function getContent($filename){
            if(!is_dir($filename)){
                $this->_content = file_get_contents('./'.$filename, FILE_USE_INCLUDE_PATH);
                return $this->_content;
            }    
            return 'This is directory';
        }
    }
