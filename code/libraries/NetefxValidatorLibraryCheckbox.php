<?php

/**
* LibraryFunctions for Checkboxes for NetefxValidator
* 
* @version 0.7 (19.09.2011)
* @package NetefxValidator
*/

class NetefxValidatorLibraryCheckbox
{


    // ************************ Often used functions for validation **********************

                
        // *** at least x checkboxes of a CheckboxField must be checked ***
        public static function min_number_checkboxes_checked($data, $args)
        {
            $field = $args["field"];
            $min   = (int)$args["min"];
            
            if (($data[$field]=="") and ($min>0)) {
                return false;
            }
            
            $items = explode(",", $data[$field]);
            $checked = 0;
            foreach ($items as $key => $value) {
                $checked++;
            }
            return ($checked >= $min);
        }
      
        // *** maximal x checkboxes of a CheckboxField can be checked ***
        public static function max_number_checkboxes_checked($data, $args)
        {
            $field = $args["field"];
            $max   = (int)$args["max"];
            
            if ($data[$field]=="") {
                return true;
            }
            
            $items = explode(",", $data[$field]);
            $checked = 0;
            foreach ($items as $key => $value) {
                $checked++;
            }
            return ($checked <= $max);
        }
        
        // *** at least x checkboxes of a (Has|Many)ManyDataObjectManager must be checked ***
        public static function min_number_many_DOM_checked($data, $args)
        {
            $field = $args["field"];
            $min   = (int)$args["min"];
            
            //if ($field=="TargetCountries") debug::show($data[$field]);

            if (($data[$field]=="") and ($min>0)) {
                return false;
            }
            
            $checked = 0;
            foreach ($data[$field] as $key => $value) {
                $checked++;
            }
            return ($checked >= $min+1);
        }
        
        // *** maximal x checkboxes of a (Has|Many)ManyDataObjectManager can be checked ***
        public static function max_number_many_DOM_checked($data, $args)
        {
            $field = $args["field"];
            $max   = (int)$args["max"];
            
            if ($data[$field]=="") {
                return true;
            }
            
            $checked = 0;
            foreach ($data[$field] as $key => $value) {
                $checked++;
            }
            return ($checked <= $max+1);
        }
      
                
        /** there is no overlapping of the checked items of two checkboxes 
        * 
        * @example  $rule_excludedPersons_notInvited = new NetefxValidatorRuleFUNCTION ("excludedPersons", "you cannot invite a person and exclude her as well", 'error', 
        * 																				array('NetefxValidatorLibraryCheckbox', 'checkboxes_no_overlapping', array('field' => 'excludedPersons', otherField' => 'invitedPersons')));   
        */
        public static function checkboxes_no_overlapping($data, $args)
        {
            $field1 = $args["field"];
            $field2 = $args["otherField"];
             
            if (($data[$field1]=="") or ($data[$field2]=="")) {
                return true;
            }
            
            $items1 = explode(",", $data[$field1]);
            
            $items2 = explode(",", $data[$field2]);
            
            foreach ($items2 as $key => $value) {
                if (in_array($value, $items1)) {
                    return false;
                }
            }
            
            return true;
        }
}
