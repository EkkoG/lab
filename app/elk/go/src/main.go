package main

import (
	"go.elastic.co/apm"
	"fmt"
	"errors"
)

func main() {
	
	tracer, err := apm.NewTracer("transporttest", "")
	if err != nil {
		panic(err)
	}
	transaction := tracer.StartTransaction("GET /myapi", "request")
	transaction.Result = "Success"
	transaction.Context.SetTag("region", "us-east-1")
	defer func() {
		transaction.End()
		tracer.Flush(nil)
	}()

	fmt.Println("Hello, 世界")
	span := transaction.StartSpan("SELECT FROM foo1", "db.mysql.query", nil)
	t := span.TraceContext()
	fmt.Println(t)
	span.End()


	span2 := transaction.StartSpan("SELECT FROM foo2", "db.mysql.query", nil)
	span2.End()

	// e := tracer.NewErrorLog(apm.ErrorLogRecord{
	// 	Message: "Somebody set up us the bomb.",
	// })
	e := tracer.NewError(errors.New("math: square root of negative number"))
	e.SetTransaction(transaction)
	e.Send()


}