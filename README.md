# 简介

对感兴趣的技术做做实验

# 索引

* [简介](#简介)
* [安装 Docker Compose](#安装 Docker Compose)
* [目录结构](#目录结构)
* [RabbitMQ](#RabbitMQ)
    * [集群]
    * [监控]
    * [订阅处理去单点]
    * [消息堆积时订阅情况]
    * [消费重试]
    * [多业务订阅同事件]
    * [临时队列]
    * [消息数量上限]


# 安装 Docker Compose

```bash
$ curl -sSL https://get.docker.com/ | sh
$ sudo pip install docker-compose
```


# 目录结构

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

http://www.rabbitmq.com/documentation.html


## 集群


## 监控

```bash
./bin/rabbitmq/monitor.sh
```


## 订阅处理去单点

```bash
./bin/rabbitmq/new_task.sh
```

```bash
./bin/rabbitmq/worker.sh
./bin/rabbitmq/worker.sh
```

## 消费重试


## 多业务订阅同事件

