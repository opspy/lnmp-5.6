<?php 
   $link=mysql_connect("mysql","root","123456"); 
   if(!$link) echo "MYSQL FAILD!连接错误，用户名密码不对"; 
   else echo "MYSQL OK!可以连接"; 

   $redis = new Redis();    
   $redis->connect("redis","6379");  //php客户端设置的ip及端口    
   //存储一个 值    
   $redis->set("key1","Hello redis!");    
   echo $redis->get("key1");     //应输出hello world  
  
   //1. 创建对象 
   $mem = new Memcache();
   //2. 添加服务 ，多个memcache
   $mem->addServer("memcached",11211);
   //3. 放置信息 
   $mem->add("mystr","hello memcache!",MEMCACHE_COMPRESSED,0); 
   $mem->add("myarray",array(10,20,30,40),MEMCACHE_COMPRESSED,0); 
   #$mem->add("myob",new Stu(),MEMCACHE_COMPRESSED,0);   #这里没给对象，字节写个试试
   //4. 获取信息
   echo $mem->get("mystr")."<br/>";
   var_dump($mem->get('myarray')); 
   echo "<br/>"; 
   #$mem->get("myob")->getinfo();
      
?> 
