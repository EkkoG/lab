package main

import (
	"github.com/gin-gonic/gin"
	"fmt"
	"log"
	"net/http"
	// "bufio"
	// "os"
)

func handle(s string)  {
	fmt.Printf("input is %s", s)
}

type Login struct {
    User     string `form:"user" json:"user" binding:"required"`
    Password string `form:"password" json:"password" binding:"required"`
}

func main() {

	r := gin.Default()
	r.GET("/ping", func(c *gin.Context) {
		c.JSON(200, gin.H{
			"message": "pong",
		})
	})

	r.POST("/post", func(c *gin.Context) {

		id := c.PostForm("id")
		page := c.DefaultQuery("page", "0")
		name := c.PostForm("name")
		message := c.PostForm("message")
		ids := c.QueryMap("ids")
		names := c.PostFormMap("names")

		log.Printf("id: %s; \npage: %s; \nname: %s; \nmessage: %s, \nids: %v, \nnames: %v", id, page, name, message, ids, names)

		c.JSON(http.StatusOK, gin.H{
			"message": "my post",
		})
	})

    r.POST("/loginJSON", func(c *gin.Context) {
        var json Login
        // 验证数据并绑定
        if err := c.ShouldBindJSON(&json); err == nil {
            if json.User == "manu" && json.Password == "123" {
                c.JSON(http.StatusOK, gin.H{"status": "you are logged in"})
            } else {
                c.JSON(http.StatusUnauthorized, gin.H{"status": "unauthorized"})
            }
        } else {
            c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
        }
	})
	
	r.GET("/header", func(c *gin.Context) {
        c.JSON(http.StatusOK, gin.H{"message": fmt.Sprintf("X-HEAD-REQUEST-ID: %s", c.GetHeader("x-head-request-id"))})
	})

	r.GET("/error", func(c *gin.Context) {
		c.JSON(http.StatusBadRequest, gin.H{
			"message": "error",
		})
	})

	r.Run(":80") // listen and serve on 0.0.0.0:8080

}