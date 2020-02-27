# Laravel VueJs Phonebook Demo Project
It is a demo written on PHP and JavaScript over Laravel and VueJs framework. Is very simple project with one used services, modules, web component, etc.

# run develop enviroment
- php artisan serve
- npm run watch

# create new project
- php composer.phar create-project --prefer-dist laravel/laravel laravel-phonebook
  - Installing laravel/laravel (v6.8.0): Downloading (100%)
  - Installing symfony/polyfill-ctype (v1.13.1): Downloading (100%)
  - Installing phpoption/phpoption (1.7.2): Downloading (100%)
  - Installing vlucas/phpdotenv (v3.6.0): Downloading (100%)
  - Installing symfony/css-selector (v4.4.2): Downloading (100%)
  - Installing tijsverkoyen/css-to-inline-styles (2.2.2): Downloading (100%)
  - Installing symfony/polyfill-php72 (v1.13.1): Downloading (100%)
  - Installing symfony/polyfill-mbstring (v1.13.1): Downloading (100%)
  - Installing symfony/var-dumper (v4.4.2): Downloading (100%)
  - Installing symfony/routing (v4.4.2): Downloading (100%)
  - Installing symfony/process (v4.4.2): Downloading (100%)
  - Installing psr/log (1.1.2): Downloading (100%)
  - Installing symfony/polyfill-php73 (v1.13.1): Downloading (100%)
  - Installing symfony/polyfill-intl-idn (v1.13.1): Downloading (100%)
  - Installing symfony/mime (v4.4.2): Downloading (100%)
  - Installing symfony/http-foundation (v4.4.2): Downloading (100%)
  - Installing symfony/event-dispatcher-contracts (v1.1.7): Downloading (100%)
  - Installing psr/container (1.0.0): Downloading (100%)
  - Installing symfony/event-dispatcher (v4.4.2): Downloading (100%)
  - Installing symfony/debug (v4.4.2): Downloading (100%)
  - Installing symfony/error-handler (v4.4.2): Downloading (connecting...)
  - Installing symfony/http-kernel (v4.4.2): Downloading (100%)
  - Installing symfony/finder (v4.4.2): Downloading (100%)
  - Installing symfony/service-contracts (v1.1.8): Downloading (100%)
  - Installing symfony/console (v4.4.2): Downloading (100%)
  - Installing symfony/polyfill-iconv (v1.13.1): Downloading (100%)
  - Installing doctrine/lexer (1.2.0): Downloading (100%)
  - Installing egulias/email-validator (2.1.13): Downloading (100%)
  - Installing swiftmailer/swiftmailer (v6.2.3): Downloading (100%)
  - Installing paragonie/random_compat (v9.99.99): Downloading (100%)
  - Installing ramsey/uuid (3.9.2): Downloading (100%)
  - Installing psr/simple-cache (1.0.1): Downloading (100%)
  - Installing opis/closure (3.5.1): Downloading (100%)
  - Installing symfony/translation-contracts (v1.1.7): Downloading (100%)
  - Installing symfony/translation (v4.4.2): Downloading (100%)
  - Installing nesbot/carbon (2.28.0): Downloading (100%)
  - Installing monolog/monolog (2.0.2): Downloading (100%)
  - Installing league/flysystem (1.0.62): Downloading (100%)
  - Installing erusev/parsedown (1.7.3): Downloading (100%)
  - Installing dragonmantank/cron-expression (v2.3.0): Downloading (100%)
  - Installing doctrine/inflector (1.3.1): Downloading (100%)
  - Installing laravel/framework (v6.9.0): Downloading (100%)
  - Installing fideloper/proxy (4.2.2): Downloading (100%)
  - Installing jakub-onderka/php-console-color (v0.2): Downloading (100%)
  - Installing jakub-onderka/php-console-highlighter (v0.4): Downloading (100%)
  - Installing nikic/php-parser (v4.3.0): Downloading (100%)
  - Installing dnoegel/php-xdg-base-dir (v0.1.1): Downloading (100%)
  - Installing psy/psysh (v0.9.12): Downloading (100%)
  - Installing laravel/tinker (v2.0.0): Downloading (100%)
  - Installing scrivo/highlight.php (v9.17.1.0): Downloading (100%)
  - Installing filp/whoops (2.7.0): Downloading (100%)
  - Installing facade/ignition-contracts (1.0.0): Downloading (100%)
  - Installing facade/flare-client-php (1.3.1): Downloading (100%)
  - Installing facade/ignition (1.13.0): Downloading (100%)
  - Installing fzaninotto/faker (v1.9.1): Downloading (100%)
  - Installing hamcrest/hamcrest-php (v2.0.0): Downloading (100%)
  - Installing mockery/mockery (1.3.1): Downloading (100%)
  - Installing nunomaduro/collision (v3.0.1): Downloading (100%)
  - Installing sebastian/version (2.0.1): Downloading (100%)
  - Installing sebastian/type (1.1.3): Downloading (100%)
  - Installing sebastian/resource-operations (2.0.1): Downloading (100%)
  - Installing sebastian/object-reflector (1.1.1): Downloading (100%)
  - Installing sebastian/recursion-context (3.0.0): Downloading (100%)
  - Installing sebastian/object-enumerator (3.0.3): Downloading (100%)
  - Installing sebastian/global-state (3.0.0): Downloading (100%)
  - Installing sebastian/exporter (3.1.2): Downloading (100%)
  - Installing sebastian/environment (4.2.3): Downloading (100%)
  - Installing sebastian/diff (3.0.2): Downloading (100%)
  - Installing sebastian/comparator (3.0.2): Downloading (100%)
  - Installing phpunit/php-timer (2.1.2): Downloading (100%)
  - Installing phpunit/php-text-template (1.2.1): Downloading (100%)
  - Installing phpunit/php-file-iterator (2.0.2): Downloading (100%)
  - Installing phpunit/php-token-stream (3.1.1): Downloading (100%)
  - Installing theseer/tokenizer (1.1.3): Downloading (100%)
  - Installing sebastian/code-unit-reverse-lookup (1.0.1): Downloading (100%)
  - Installing phpunit/php-code-coverage (7.0.10): Downloading (100%)
  - Installing phpdocumentor/reflection-common (2.0.0): Downloading (100%)
  - Installing phpdocumentor/type-resolver (1.0.1): Downloading (100%)
  - Installing webmozart/assert (1.6.0): Downloading (100%)
  - Installing phpdocumentor/reflection-docblock (4.3.4): Downloading (100%)
  - Installing doctrine/instantiator (1.3.0): Downloading (100%)
  - Installing phpspec/prophecy (1.10.1): Downloading (100%)
  - Installing phar-io/version (2.0.1): Downloading (100%)
  - Installing phar-io/manifest (1.0.3): Downloading (connecting...)
  - Installing myclabs/deep-copy (1.9.4): Downloading (100%)
  - Installing phpunit/phpunit (8.5.1): Downloading (100%)
- php composer.phar require laravel/ui
  - Installing laravel/ui (v1.1.2): Downloading (100%)
- php artisan ui vue --auth
- npm install 
- npm run dev

# make a auth
- php artisan migrate
- php artisan make:auth

# set proxy 
set http_proxy=192.168.3.100:3128
set https_proxy=192.168.3.100:3128
