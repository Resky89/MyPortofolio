<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $techStacks = [
            // Frameworks
            [
                'name' => 'Laravel',
                'image' => 'https://cdn.worldvectorlogo.com/logos/laravel-2.svg',
                'url' => 'https://laravel.com',
                'delay' => '100',
                'category' => 'framework'
            ],
            [
                'name' => 'Flutter',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg',
                'url' => 'https://flutter.dev',
                'delay' => '200',
                'category' => 'framework'
            ],
            [
                'name' => 'Express.js',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/express/express-original.svg',
                'url' => 'https://expressjs.com',
                'delay' => '300',
                'category' => 'framework'
            ],
            [
                'name' => 'Bootstrap',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg',
                'url' => 'https://getbootstrap.com',
                'delay' => '400',
                'category' => 'framework'
            ],
            [
                'name' => 'Tailwind',
                'image' => 'https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg',
                'url' => 'https://tailwindcss.com',
                'delay' => '500',
                'category' => 'framework'
            ],

            // Languages
            [
                'name' => 'JavaScript',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg',
                'url' => 'https://developer.mozilla.org/en-US/docs/Web/JavaScript',
                'delay' => '600',
                'category' => 'language'
            ],
            [
                'name' => 'HTML',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg',
                'url' => 'https://developer.mozilla.org/en-US/docs/Web/HTML',
                'delay' => '700',
                'category' => 'language'
            ],
            [
                'name' => 'CSS',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg',
                'url' => 'https://developer.mozilla.org/en-US/docs/Web/CSS',
                'delay' => '800',
                'category' => 'language'
            ],
            [
                'name' => 'Dart',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/dart/dart-original.svg',
                'url' => 'https://dart.dev',
                'delay' => '900',
                'category' => 'language'
            ],
            [
                'name' => 'Golang',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/go/go-original-wordmark.svg',
                'url' => 'https://golang.org',
                'delay' => '1000',
                'category' => 'language'
            ],
            [
                'name' => 'PHP',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg',
                'url' => 'https://www.php.net',
                'delay' => '1100',
                'category' => 'language'
            ],

            // Tools
            [
                'name' => 'Node.js',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg',
                'url' => 'https://nodejs.org',
                'delay' => '1200',
                'category' => 'tool'
            ],
            [
                'name' => 'Git',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg',
                'url' => 'https://git-scm.com',
                'delay' => '1300',
                'category' => 'tool'
            ],
            [
                'name' => 'MySQL',
                'image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg',
                'url' => 'https://www.mysql.com',
                'delay' => '1400',
                'category' => 'tool'
            ],
            [
                'name' => 'JWT',
                'image' => 'https://jwt.io/img/pic_logo.svg',
                'url' => 'https://jwt.io',
                'delay' => '1500',
                'category' => 'tool'
            ],
            [
                'name' => 'Postman',
                'image' => 'https://www.vectorlogo.zone/logos/getpostman/getpostman-icon.svg',
                'url' => 'https://www.postman.com',
                'delay' => '1600',
                'category' => 'tool'
            ]
        ];

        // Mengurutkan array berdasarkan kategori
        $techStacks = collect($techStacks)->sortBy('category')->values()->all();

        return view('home', compact('techStacks'));
    }
}

