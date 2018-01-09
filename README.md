安装 docker-compose
```bash
curl -L https://get.daocloud.io/docker/compose/releases/download/1.12.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose
```
运行
```
docker-compose up -d
```
docker-compose  常用命令
```
build 构建或重建服务
help 命令帮助
kill 杀掉容器
logs 显示容器的输出内容
port 打印绑定的开放端口
ps 显示容器
pull 拉取服务镜像
restart 重启服务
rm 删除停止的容器
run 运行一个一次性命令
scale 设置服务的容器数目
start 开启服务
stop 停止服务
up 创建并启动容器
```
查看容器
```
# docker-compose  ps
  Name                 Command               State                    Ports                   
---------------------------------------------------------------------------------------------
memcached   docker-entrypoint.sh memca ...   Up      0.0.0.0:11211->11211/tcp                 
mysql       docker-entrypoint.sh mysqld      Up      0.0.0.0:3306->3306/tcp                   
nginx       nginx -g daemon off;             Up      0.0.0.0:433->433/tcp, 0.0.0.0:80->80/tcp 
php-fpm     entrypoint.sh php-fpm            Up      0.0.0.0:9000->9000/tcp                   
redis       docker-entrypoint.sh redis ...   Up      0.0.0.0:6379->6379/tcp  
```
查看日志
```
docker-compose logs
```
停止服务
```
docker-compose down
```
访问测试
```
curl  ip/info.php
curl  ip/test.php
```
清理集群
```
docker-compose  down
docker-compose  rm
```
