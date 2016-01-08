<?php
 class Database
 {
 var $host;
 var $password;
 var $user;
 var $database;
 var $link;
 var $query;
 var $result;
 var $rows;
 
 function Database()
 { 
  $this->host =LOCALHOST;              
  $this->password = DB_PASSWORD;        
  $this->user = DB_USERNAME;                   
  $this->database = DB_NAME;
  $this->rows = 0;
 }
 function open_db()
 {
  $this->dbcon = @mysql_connect($this->host,$this->user,$this->password) or die ('Class Database'.mysql_errno());
 }
 function select_db()
 { 
 @mysql_select_db($this->database,$this->dbcon) or die ('Database Select Error'.mysql_errno());
 }
 
 function closedb()
 {
 mysql_close();
 }
 function query($query)
 {
 $this->open_db();
 $this->select_db();
 $this->query = $query;
 $this->result = mysql_query($query,$this->dbcon) or die ('Error while executing Query'.mysql_errno());
/*if(mb_eregi("SELECT",$query))
{
 $this->rows = mysql_num_rows($this->result);
}
*/ $this->closedb();
 } 
 }
 
?>
