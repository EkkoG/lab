# 简介

实验室

# 目录

* [简介](#简介)
* [安装 Docker Compose](#安装-docker-compose)
* [项目结构](#文件结构)

* 消息队列
    * Kafka
    * NSQ
    * [RabbitMQ](./MQ-RabbitMQ.md)

* 代理服务器
    * [OpenResty](#OpenResty)
    * [NGINX](#NGINX)
    * [NGINX Unit](#NGINX-Unit)
    * [Envoy](#Envoy)

* Service Mesh
    * [Istio](#Istio)

* API网关
    * kong

* 非关系型数据库
    * Redis

* 分布式缓存
    * Memcache

* 数据同步
    * otter

* 日志轮切工具
    * logrotate

* 配置中心
    * apollo

* 容器
    * docker
    * Kubernetes

* 分布式搜索引擎
    * Elasticsearch


# 安装 Docker Compose

```bash
$ curl -sSL https://get.docker.com/ | sh
$ sudo pip install docker-compose
```


# 项目结构

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



# OpenResty

# NGINX

# NGINX Unit


# Envoy

https://www.envoyproxy.io/

# Istio

https://blog.csdn.net/u012211419/article/details/78963276

http://istio.doczh.cn/docs/concepts/what-is-istio/overview.html
