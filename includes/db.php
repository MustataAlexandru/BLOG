<?php ob_start();

$db['db_host'] = 'app-8f4568c4-00b3-4455-86ef-3c6d92116739-do-user-14301607-0.b.db.ondigitalocean.com';
$db['db_user'] = 'db';
$db['db_pass'] = 'AVNS_2G7s7YsFxUm8pQTV7ke';
$db['db_name'] = 'cms';
$db['port'] = '25060';
$db['database'] = 'db';
$db['sslmode'] = 'require';


foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);

//if($connection){
//    echo 'We are connected';
//}





?>
