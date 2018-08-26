# Redis

# 目录

* 概述
    
    * [官网](http://redis.io)

    * [源码](https://github.com/antirez/redis)

* 使用
   
    * [自带客户端访问redis](#自带客户端访问redis)
    * [减运算不超扣](#减运算不超扣)

* 原理
  
    * 架构

    * lua脚本实现事务比MULTI命令更快？

* 适用场景

* 不适用场景





# 使用

### 自带客户端访问redis

```bash
root@a4502cd60fdd:/data# redis-cli set mykey 'abc'
OK
root@a4502cd60fdd:/data# redis-cli get mykey
"abc"
```


### 减运算不超扣

```bash

php ./app/redis/decr-not-over.php

```



