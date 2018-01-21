<?php 
   $mysql = new mysqli();
   $mysql->connect('mysql','root','123456');
   if(!$mysql) echo "MYSQL FAILD!连接错误，用户名密码不对"; 
   else echo "MYSQL OK!可以连接 <br/>"; 

   $redis = new Redis();    
   $redis->connect("redis","6379");
   $redis->set("key1","Hello redis!");    
   echo $redis->get("key1")."<br/>";
   
   $mem = new Memcached();
   $mem->addServer("memcached",11211);
   $mem->set("mystr","hello memcached!",0); 
   echo $mem->get("mystr")."<br/>";
?> 
