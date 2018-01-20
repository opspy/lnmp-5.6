<?php 
   $link=mysql_connect("mysql","root","123456"); 
   if(!$link) echo "MYSQL FAILD!连接错误，用户名密码不对"; 
   else echo "MYSQL OK!可以连接 <br/>"; 

   $redis = new Redis();    
   $redis->connect("redis","6379");
   $redis->set("key1","Hello redis!");    
   echo $redis->get("key1")."<br/>";
   
   $mem = new Memcache();
   $mem->addServer("memcached",11211);
   $mem->add("mystr","hello memcached!",MEMCACHE_COMPRESSED,0); 
   echo $mem->get("mystr")."<br/>";
?> 
