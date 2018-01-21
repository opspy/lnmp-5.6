<?php 
   $mysql = new mysqli();
   $mysql->connect('mysql','root','123456');
   if(!$mysql) echo "MySQL connect failed!"; 
   else echo "Hello MySQL!<br/>"; 

   $redis = new Redis();    
   $redis->connect("redis","6379");
   $redis->set("key1","Hello Redis!");    
   echo $redis->get("key1")."<br/>";
   
   $mem = new Memcached();
   $mem->addServer("memcached",11211);
   $mem->set("key1","Hello Memcached!",0); 
   echo $mem->get("key1")."<br/>";
?> 
