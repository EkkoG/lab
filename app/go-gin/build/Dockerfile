FROM centos:7
MAINTAINER "Tom" <tom_hejiaxi@163.com>

ENV GOLANG_VERSION 1.12
ENV GOPATH /app
ENV PATH $GOPATH/bin:/usr/local/go/bin:$PATH
ENV GOPROXY https://goproxy.io

RUN yum clean all; \ 
	yum update -y; \
	yum install wget git -y; \
	yum clean all && yum update -y; \
	wget -O go.tgz "https://dl.google.com/go/go$GOLANG_VERSION.linux-amd64.tar.gz"; \
	tar -C /usr/local -xzf go.tgz; \
    rm -rf /tmp/*

# RUN go get -u -v github.com/gin-gonic/gin

RUN go get -u -v github.com/ramya-rao-a/go-outline; \
	go get -u -v golang.org/x/tools/cmd/gopls; \
	go get -u -v github.com/acroca/go-symbols; \
	go get -u -v github.com/nsf/gocode; \
	go get -u -v github.com/rogpeppe/godef; \
	go get -u -v golang.org/x/tools/cmd/godoc; \
	go get -u -v github.com/zmb3/gogetdoc; \
	go get -u -v golang.org/x/lint/golint; \
	go get -u -v github.com/fatih/gomodifytags; \
	go get -u -v golang.org/x/tools/cmd/gorename; \
	go get -u -v sourcegraph.com/sqs/goreturns; \
	go get -u -v golang.org/x/tools/cmd/goimports; \
	go get -u -v github.com/cweill/gotests/...; \
	go get -u -v golang.org/x/tools/cmd/guru; \
	go get -u -v github.com/josharian/impl; \
	go get -u -v github.com/haya14busa/goplay/cmd/goplay; \
	go get -u -v github.com/uudashr/gopkgs/cmd/gopkgs; \
	go get -u -v github.com/davidrjenni/reftools/cmd/fillstruct; \
	go get -u -v github.com/alecthomas/gometalinter

# gocode-gomod
RUN cd $GOPATH/bin; \
	ls -alh; \
    cp gocode gocode-gomod; \
    cp godef godef-gomod

RUN go version

COPY start.sh /start.sh
RUN chmod +x /start.sh 

WORKDIR /src

CMD /start.sh