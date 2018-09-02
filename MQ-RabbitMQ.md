# RabbitMQ

## 消息

```
├── 转发模型
│       ├── Direct
│       │   ├── 使用
│       │   ├── 设计
│       │   ├── 适用场景
│       │   ├── 不适用场景
│       │   ├── 生产
│       │   │    ├── 新增队列，没消费端会怎样？
│       │   │    └── 队列容量达到上限后会怎样?
│       │   └── 消费
│       │       ├── 与服务端交互
│       │       │    ├── 短连接
│       │       │    └── 长连接
│       │       ├── 处理消息
│       │       │    ├── 水平扩容消费节点是否会消费到同一条消息
│       │       │    ├── 不回复任何信号会在一直收到该消息
│       │       │    │    ├── 每条消息间隔多久?
│       │       │    │    ├── 发了多少次会结束?
│       │       │    │    └── 什么时候结束?
│       │       │    └── 回复确认信号后不再收到该条消息
│       │       ├── 消费节点状态变更
│       │       │    ├── 新增消费节点
│       │       │    │    ├── 先启动消费后声明队列
│       │       │    │    │    └── 
│       │       │    │    ├── 从哪条消息开始接受?
│       │       │    │    └── 对其他已存在的消费节点的影响是什么?
│       │       │    ├── 销毁消费节点
│       │       │    │    ├── 没有任何消费节点时队列是什么状态?
│       │       │    │    ├── 是否会引起消息堆积?
│       │       │    │    ├── 最后消费到的消息是什么时候的?
│       │       │    │    └── 对其他已存在的消费节点的影响是什么?
│       │       │    ├── 中断消费
│       │       │    │    ├── 是否会引起消息堆积?
│       │       │    │    └── 对其他已存在的消费节点的影响是什么?
│       │       │    └── 恢复消费
│       │       │         ├── 是否可以消费到中断期间生产的消息?
│       │       │         └── 对其他已存在的消费节点的影响是什么?
│       │       └── 临时消费节点
│       ├── Fanout
│       ├── Topic
│       ├── Headers
│       └── Invalid
 
```

* 转发模型 > Direct >  使用

生产端

```bash
./bin/rabbitmq/direct_producer.sh
```

消费端

```bash
./bin/rabbitmq/direct_consumer.sh
./bin/rabbitmq/direct_consumer.sh
```

* 转发模型 > Direct >  设计


* 转发模型 > Direct >  生产 > 新增队列，没消费端会怎样？

messages_ready 会累计，占用内存，发生堆积

* 转发模型 > Direct >  消费 > 消费节点状态变更 > 新增消费节点 > 如果此时没声明过队列会抛异常

```bash

$ docker-compose -f etc/docker/compose/app.yml down && docker-compose -f etc/docker/compose/app.yml up -d
$ ./bin/rabbitmq/direct_consumer.sh

```




## 集群

```
├── 集群如何实现
├── 集群节点管理
│       ├── 新增节点
│       ├── 删除节点
│       └── 节点状态如何探知
│ 
├── 发布消息
│       ├── 数据在多节点的状态
│ 
├── 订阅消息
│       ├── 数据在多节点的状态

```


* 新增节点

```rabbit@c65e5f03f794``` 加入到 `rabbit@5da9463b7000`节点的集群，作为内存节点

```bash
$ rabbitmqctl cluster_status
```

```
Cluster status of node rabbit@910c05e9a904 ...
[{nodes,[{disc,[rabbit@e804272c9320]},{ram,[rabbit@910c05e9a904]}]},
 {running_nodes,[rabbit@e804272c9320,rabbit@910c05e9a904]},
 {cluster_name,<<"rabbit@e804272c9320">>},
 {partitions,[]},
 {alarms,[{rabbit@e804272c9320,[]},{rabbit@910c05e9a904,[]}]}]
```

```bash
$ rabbitmqctl stop_app
```

```bash
$ rabbitmqctl join_cluster --ram rabbit@5da9463b7000
```
```
Clustering node rabbit@c65e5f03f794 with rabbit@5da9463b7000
```

```bash
$ rabbitmqctl start_app
$ rabbitmqctl cluster_status
```
```
Cluster status of node rabbit@c65e5f03f794 ...
[{nodes,[{disc,[rabbit@5da9463b7000]},{ram,[rabbit@c65e5f03f794]}]},
 {running_nodes,[rabbit@5da9463b7000,rabbit@c65e5f03f794]},
 {cluster_name,<<"rabbit@5da9463b7000">>},
 {partitions,[]},
 {alarms,[{rabbit@5da9463b7000,[]},{rabbit@c65e5f03f794,[]}]}]

```



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

* 发送消息。循环执行

```bash
./bin/rabbitmq/new_task.sh
```

*  消费但不确认消息，循环执行

```bash
./bin/rabbitmq/worker_no_ack.sh
```


*  消费且确认消息，循环执行

```bash
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

[Back to TOC](/README.md)
