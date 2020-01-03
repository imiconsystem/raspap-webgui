<?php
$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

if($user == 'imicon'){
    $validated = ($user == $config['imicon']) && password_verify($pass, '$2y$10$kPsgr0AOZgD0KqQeQTgnPOR1MvhbNNQiwkliS6g59agrrQMa1OgxK');
}else{
    $validated = ($user == $config['admin_user']) && password_verify($pass, $config['admin_pass']);
}


if (!$validated) {
    header('WWW-Authenticate: Basic realm="RaspAP"');
    if (function_exists('http_response_code')) {
        // http_response_code will respond with proper HTTP version back.
        http_response_code(401);
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }

    exit('Not authorized'.PHP_EOL);
}
