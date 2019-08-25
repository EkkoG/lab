#!/bin/bash
mycard=$1
myip=$2
ip addr add ${myip} broadcast ${myip} label ${mycard}:0 dev ${mycard}