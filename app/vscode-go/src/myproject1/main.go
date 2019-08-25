package main

import (
	"fmt"
	"bufio"
	"os"
)

func handle(s string)  {
	fmt.Printf("input is %s", s)
}

func main() {
	fmt.Println("Hello, 世界")
	defer func() {
		fmt.Printf("it is over.")
	}()
	in := bufio.NewReader(os.Stdin)
	for {
		input, err := in.ReadString('\n')
		if err == nil {
			go handle(input)
		}
	}
	
}