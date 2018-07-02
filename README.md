# 简介

对感兴趣的技术做做实验

# 目录

* [简介](#简介)
* [安装 Docker Compose](#安装-docker-compose)
* [文件结构](#文件结构)
* [RabbitMQ](#RabbitMQ)
    * [集群](#集群)
    * [监控](#监控)
    * [单播消息](#单播消息)
    * [广播消息](#广播消息)
    * [消息堆积](#消息堆积)
    * [消费重试](#消费重试)
    * [临时队列](#临时队列)
    * [消息数量上限](#消息数量上限)
    * [参考资料](#参考资料)


# 安装 Docker Compose

```bash
$ curl -sSL https://get.docker.com/ | sh
$ sudo pip install docker-compose
```


# 文件结构

```
./
├── tmp           （存放临时文件）
├── container     （存放容器文件）
├── data          （存放数据文件）
├── bin           （存放可执行文件，脚本或二进制文件等）
├── etc           （存放配置文件）
├── htdocs        （存放web项目）
├── app           （存放进程项目）
└── log           （存放日志文件）

```


# RabbitMQ

## 集群


## 监控

```bash
./bin/rabbitmq/monitor.sh
```


## 单播消息

```bash
./bin/rabbitmq/new_task.sh
```

```bash
./bin/rabbitmq/worker.sh
./bin/rabbitmq/worker.sh
```


## 广播消息

```bash
./bin/rabbitmq/broadcast_new_event.sh
```

```bash
./bin/rabbitmq/event_subscriber1.sh
./bin/rabbitmq/event_subscriber2.sh
```

## 消息堆积

```bash
./bin/rabbitmq/new_task.sh
```

```bash
./bin/rabbitmq/worker_no_ack.sh
./bin/rabbitmq/worker.sh
```


## 消费重试



## 临时队列

```bash
./bin/rabbitmq/new_tmp.sh
```

```bash
./bin/rabbitmq/tmp_subscriber.sh
```

## 参考资料


* http://www.rabbitmq.com/documentation.html

* https://www.jianshu.com/p/79ca08116d57

[Back to TOC](#目录)
