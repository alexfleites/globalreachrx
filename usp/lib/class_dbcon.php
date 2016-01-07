<?php
/*
	HEZECOM PHP CODE GENERATOR ULTIMATE (UltimateSpeed)
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2013 ALL RIGHTS RESERVED
	FILE NAME class_dbcon.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
*/
class DB{
private static $instance = NULL;
private function __construct() {
}
public static function getInstance() {

if (!self::$instance)
    {
    self::$instance = new PDO("".DB_TYPE.":host=".LOCALHOST.";dbname=".DB_NAME."", DB_USERNAME, DB_PASSWORD);
    self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
return self::$instance;
}
private function __clone(){
}
}
/////////////////////////

class dboptions{
	
 		public function dbSelect($table, $fieldname=null, $id=null,$classname)
        {
            $db=DB::getInstance();
            $sql = "SELECT * FROM `$table` WHERE `$fieldname`=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $idd);
			//$id=$idd;
            $stmt->execute();
            return $stmt->fetchObject($classname);
        }

		public function rawSelect($sql)
        {
        $db=DB::getInstance();
		try{
			return $db->query($sql);
			} catch (PDOException $e){
			die($e->getMessage());
		}
        }

    
		public function dbInsert($table, $values)
        {
            $db=DB::getInstance();
            $fieldnames = array_keys($values[0]);
            $size = sizeof($fieldnames);
            $i = 1;
            $sql = "INSERT INTO $table";
            $fields = '( ' . implode(' ,', $fieldnames) . ' )';
            $bound = '(:' . implode(', :', $fieldnames) . ' )';
            $sql .= $fields.' VALUES '.$bound;
            $stmt = $db->prepare($sql);
            foreach($values as $vals)
            {
                $stmt->execute($vals);
            }
        }
        public function dbUpdate($table, $fieldname, $value, $pk, $id)
        {
            $db=DB::getInstance();
            $sql = "UPDATE `$table` SET `$fieldname`='{$value}' WHERE `$pk` = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }
        public function dbDelete($table, $fieldname, $id)
        {
            $db=DB::getInstance();
            $sql = "DELETE FROM `$table` WHERE `$fieldname` = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }
}

?>