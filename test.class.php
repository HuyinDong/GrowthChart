<?php
 class test{

    private $host;
    private $user;
    private $password;
    private $conn;
    public  $db;
    public  $coding;
    public  $query;
    public function __construct($host,$user,$password,$conn,$db,$coding){
         $this->host=$host;
         $this->user=$user;
         $this->password=$password;
         $this->conn=$conn;
         $this->db=$db;
         $this->coding=$coding;
         $this->connect();
  }
   public function connect(){
     if($this->conn=='pconn'){
          $this->conn=mysqli_pconnect($this->host,$this->user,$this->password);
           $this->db=mysql_select_db($this->db);
            mysql_query("set names $this->coding");    
	}
    else
	{
          $this->conn=mysql_connect($this->host,$this->user,$this->password);
     $this->db=mysql_select_db($this->db);
      mysql_query("SET NAMES $this->coding");
         }
	}
   public function select($row,$table,$conditions='',$where = true){
         if($conditions!=''){
		if($where == true){
           $conditions='where '.$conditions;
		}
	  $sql="select $row from $table $conditions";
        return  $this->query=mysql_query($sql);}
	else if($conditions==''){
	  $sql="select $row from $table";
        return  $this->query=mysql_query($sql);}
         
	}
   public function update($table,$mod_content,$conditions){
          $sql="UPDATE `".$table."` SET $mode_content WHERE $conditions"; 
        return $this->query=mysql_query($sql);
	}
  public function fetch($fetch){
             $array=mysql_fetch_array($fetch);
               return    $this->query=Str_replace(" ","&nbsp;",$array);

}

public function check(){
	  if(!isset($_SESSION['UN'])){
    exit('Illegal Access ');}

   }
}






