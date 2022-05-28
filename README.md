TEST ONE:

1. Git Clone: https://github.com/tilaksingh94/testone.git

2. update .env file with the database and Google Auth access.

GOOGLE_CLIENT_ID=317801910834-0tiiusd0ntrr2sssa5gbvqofbuv299hl.apps.googleusercontent.com

GOOGLE_CLIENT_SECRET=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

GOOGLE_REDIRECT=http://localhost:8000/google_callback

if any case google authentication will not work please try the below settings

``` \vendor\guzzlehttp\guzzle\src\Client.php
$defaults = [
            'allow_redirects' => RedirectMiddleware::$defaultSettings,
            'http_errors'     => true,
            'decode_content'  => true,
            'verify'          => true, //make it false
            'cookies'         => false,
            'idn_conversion'  => false,
        ];
```
3. run composer install/update.

4. php artisan migrate

5. php artisan db:seed

6. php artisan serve
APP URL: http://localhost:8000/
Please watch the below video for user experience details: 

<p align="center">
<a target="_blank" href="https://drive.google.com/file/d/1gNsdN8gihYPWRwIdRKXwXAOd-ZlRzCh-/view?usp=sharing"><img src="https://drive.google.com/file/d/1gNsdN8gihYPWRwIdRKXwXAOd-ZlRzCh-/view?usp=sharing" alt="img1"></a>
<a target="_blank" href="https://drive.google.com/file/d/1-BEz_3P39fBB-ruIQ8nphkPLTi9h-a34/view?usp=sharing"><img src="https://drive.google.com/file/d/1-BEz_3P39fBB-ruIQ8nphkPLTi9h-a34/view?usp=sharing" alt="img12"></a>
<a target="_blank" href="https://drive.google.com/file/d/15sicWjnhAXYxLyedXFZ4l4s1EZ3UZgfO/view?usp=sharing"><img src="https://drive.google.com/file/d/15sicWjnhAXYxLyedXFZ4l4s1EZ3UZgfO/view?usp=sharing" alt="img3"></a>

</p>


https://drive.google.com/file/d/15C0LoSeTEvwoMioOWF6mVqFolO7iOBhl/view?usp=sharing