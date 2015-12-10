<?php
class Translate {

    private $language;
	private $lang 		= array();
	
	public function __construct($language){
		$this->language = $language;
	}
	
    private function findString($str) {
        if (array_key_exists($str, $this->lang[$this->language])) {
			return $this->lang[$this->language][$str];
			
        }
        return $str;
    }
    
	private function splitStrings($str) {
        return explode('=',trim($str));
    }
	
	public function trans($str) {	
        if (!array_key_exists($this->language, $this->lang)) {
            if (file_exists('assets/locale/'.$this->language.'.txt')) {
                $strings = array_map(array($this,'splitStrings'),file('assets/locale/'.$this->language.'.txt'));
                foreach ($strings as $k => $v) {
					$this->lang[$this->language][$v[0]] = $v[1];
                }
                $this->findString($str);
            }
            else {
                return $str;
            }
        }
        else {
            return $this->findString($str);
        }
    }
}

