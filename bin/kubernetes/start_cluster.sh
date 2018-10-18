#!/bin/bash

function install_minikube() {

    r=`which minikube`
    if [[ ! -z "$r" ]]; then
        echo "minikube 已安装"
        return
    fi

    echo "安装 minikube"

    curl -Lo minikube https://storage.googleapis.com/minikube/releases/latest/minikube-darwin-amd64 && 
    chmod +x minikube && 
    sudo mv minikube /usr/local/bin/

    if [[ 0 != $? ]]; then
        echo "minikube 安装失败"
        exit 1
    fi

    echo "安装 minikube 完毕"
}

function install_hyperkit() {
    
    r=`which docker-machine-driver-hyperkit`
    if [[ ! -z "$r" ]]; then
        echo "hyperkit 已安装"
        return
    fi

    curl -Lo docker-machine-driver-hyperkit https://storage.googleapis.com/minikube/releases/latest/docker-machine-driver-hyperkit \
    && chmod +x docker-machine-driver-hyperkit \
    && sudo cp docker-machine-driver-hyperkit /usr/local/bin/ \
    && rm docker-machine-driver-hyperkit \
    && sudo chown root:wheel /usr/local/bin/docker-machine-driver-hyperkit \
    && sudo chmod u+s /usr/local/bin/docker-machine-driver-hyperkit


    if [[ 0 != $? ]]; then
        echo "hyperkit 安装失败"
        exit 1
    fi

    echo "安装 hyperkit 完毕"
}


function config_minikube() {
    echo "配置minikube"
    minikube config set vm-driver hyperkit
}

function start_minikube() {

    r=`minikube status|grep Running`
    if [[ ! -z "$r" ]]; then
        echo "minikube 已启动"
        return
    fi

    echo "启动minikube"
    minikube delete
    eval $(minikube docker-env)
    minikube start
    kubectl config use-context minikube
}

function minikube_mount() {

    r=`ps -ef | grep 'minikube mount'|grep '/mount/repo'`
    if [[ ! -z "$r" ]]; then
        echo "minikube 已挂载 $HOME/Repository"
        return
    fi

    echo "minikube 开始挂载 $HOME/Repository"

    nohup minikube mount ~/Repository:/mount/repo &
}

install_minikube
install_hyperkit
config_minikube
start_minikube
minikube_mount

