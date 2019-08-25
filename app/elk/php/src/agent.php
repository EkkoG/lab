<?php
// require 'vendor/autoload.php';

// $config = [
//     'appName'     => 'My WebApp',
//     'appVersion'  => '1.0.42',
//     'serverUrl'   => 'http://apm:8200',
//     'secretToken' => 'DKKbdsupZWEEzYd4LX34TyHF36vDKRJP',
//     'hostname'    => 'app.local',
//     'env'         => ['DOCUMENT_ROOT', 'REMOTE_ADDR'],
//     'cookies'     => ['my-cookie'],
// ];
// $agent = new \PhilKra\Agent($config);

// $trxName = 'GET /some/transaction/name';
// // start a new transaction
// $transaction = $agent->startTransaction($trxName);

// // create a span
// $spans = [];
// $spans[] = [
//   'name' => 'Your Span Name. eg: ORM Query',
//   'type' => 'db.mysql.query',
//   'start' => 300, // when did tht query start, relative to the transaction start, in milliseconds
//   'duration' => 23, // duration, in milliseconds
//   'stacktrace' => [
//     [
//       'function' => "\\YourOrMe\\Library\\Class::methodCall()",
//       'abs_path' => '/full/path/to/file.php',
//       'filename' => 'file.php',
//       'lineno' => 30,
//       'library_frame' => false, // indicated whether this code is 'owned' by an (external) library or not
//       'vars' => [
//         'arg1' => 'value',
//         'arg2' => 'value2',
//       ],
//       'pre_context' => [ // lines of code leading to the context line
//         '<?php',
//         '',
//         '// executing query below',
//       ],
//       'context_line' => '$result = mysql_query("select * from non_existing_table")', // source code of context line
//       'post_context' => [// lines of code after to the context line
//         '',
//         '$table = $fakeTableBuilder->buildWithResult($result);',
//         'return $table;',
//       ],
//     ],
//   ],
//   'context' => [
//     'db' => [
//       'instance' => 'my_database', // the database name
//       'statement' => 'select * from non_existing_table', // the query being executed
//       'type' => 'sql',
//       'user' => 'root', // the user executing the query (don't use root!)
//     ],
//   ],
// ];

// // add the array of spans to the transaction
// $transaction->setSpans($spans);

// // Do some stuff you want to watch ...
// sleep(1);

// $agent->stopTransaction($trxName);

// // send our transactions to te apm
// $agent->send();


$url = 'http://apm:8200/v1/transactions';

$req = [
  '$id' => 'docs/spec/transactions/payload.json',
  'title' =>  'Transactions payload',
];