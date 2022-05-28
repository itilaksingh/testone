TEST ONE:

1. Git Clone: https://github.com/tilaksingh94/testone.git

2. update .env file with the database and Google Auth access.

GOOGLE_CLIENT_ID=317801910834-0tiiusd0ntrr2sssa5gbvqofbuv299hl.apps.googleusercontent.com

GOOGLE_CLIENT_SECRET=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

GOOGLE_REDIRECT=http://localhost:8000/google_callback

if any case google authentication will not work please try the below settings

\vendor\guzzlehttp\guzzle\src\Client.php
$defaults = [
            'allow_redirects' => RedirectMiddleware::$defaultSettings,
            'http_errors'     => true,
            'decode_content'  => true,
            'verify'          => true, //make it false
            'cookies'         => false,
            'idn_conversion'  => false,
        ];

3. run composer install/update.

4. php artisan migrate

5. php artisan db:seed

6. php artisan serve
Please watch the below video for user experience details: 

https://drive.google.com/file/d/15C0LoSeTEvwoMioOWF6mVqFolO7iOBhl/view?usp=sharing