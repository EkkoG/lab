# 简介

实验室

# 目录

* [简介](#简介)
* [安装 Docker Compose](#安装-docker-compose)
* [项目结构](#文件结构)

* 消息队列
    * Kafka
    * NSQ
    * [RabbitMQ](./app/rabbitmq)

* 数据库

    * mysql

* 代理
    * [OpenResty](#OpenResty)
    * [NGINX](#NGINX)
    * [NGINX Unit](#NGINX-Unit)
    * [Envoy](#Envoy)
    * [F5](#F5)

* 服务注册/发现
   
    * [Eureka](#Eureka)

* Service Mesh
    * [Istio](#Istio)

* API网关
    * kong

* NoSQL
    * [Redis](./app/redis)

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

* 容器化管理
    * [Kubernetes](./app/kubernetes)

* 分布式搜索引擎
    * Elasticsearch

* 日志系统

   * LogDevice
   * syslog
   * rsyslog
   * syslog ng

* 分布式服务框架

   * Dubbo
   * Spring Cloud

* 前端架构
   * [Flux](http://www.ruanyifeng.com/blog/2016/01/flux.html)

* 前端应用
   * [webassembly](https://www.ibm.com/developerworks/cn/web/wa-lo-webassembly-status-and-reality/index.html)


* 扩展阅读
   * [进程/线程/协程](#进程/线程/协程)
   * [微服务的核心技术问题](#微服务的核心技术问题)

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


# mysql

https://yq.aliyun.com/articles/225137?spm=a2c4e.11153940.blogcont464186.13.7ff61b0c2X5h0z


# OpenResty

# NGINX

# NGINX Unit

# Envoy

https://www.envoyproxy.io/

# F5

https://www.f5.com/
https://f5.com/zh

# Istio

https://blog.csdn.net/u012211419/article/details/78963276

http://istio.doczh.cn/docs/concepts/what-is-istio/overview.html


# 进程/线程/协程

https://www.cnblogs.com/lxmhhy/p/6041001.html

https://www.chiark.greenend.org.uk/~sgtatham/coroutines.html

# 微服务的核心技术问题

https://mp.weixin.qq.com/s/-tyjB6QCPmEAbSXjUaz_bg