# 使用Visual Studio Code配合go开发

* 安装 [Visual Studio Code](https://code.visualstudio.com)

* 安装 [Visual Studio Code Remote - Containers
 extension](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)

* 安装docker

https://store.docker.com/editions/community/docker-ce-desktop-mac

* 安装docker compose

```bash

$ curl -sSL https://get.docker.com/ | sh
$ sudo pip install docker-compose

```

* 构建golang环境

```bash

docker-compose -f ./docker-compose.yml up -d

```

* 通过Visual Studio Code进入docker容器

![Remote - Containers](https://tva1.sinaimg.cn/large/006y8mN6gy1g6c7atnt9kj31c00u00x6.jpg)

![Remote - Containers](https://tva1.sinaimg.cn/large/006y8mN6gy1g6c7cr6jg5j31c00u0dnn.jpg)

* 进入容器后，在容器内部安装Visual Studio Code的Go插件

* ![](https://tva1.sinaimg.cn/large/006y8mN6gy1g6c7loc93yj31c00u0als.jpg)

