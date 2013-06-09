<?php
/**
 * Laravel 4 文件產生器設定檔
 *     作者:KeJyun
 *     建立日期:2013-06-09
 *     最後修改日期:2013-06-09
 *     聯絡方式:kejyun@gmail.com
 */
return array(
    'allow_route'=>array(
        'doc'=>array(
            // 前言
            'introduction',
            'quick',
            'contributing',
            // 入門
            'installation',
            'configuration',
            'lifecycle',
            'routing',
            'requests',
            'responses',
            'controllers',
            'errors',
            // 更多
            'cache',
            'events',
            'facades',
            'html',
            'ioc',
            'localization',
            'mail',
            'packages',
            'pagination',
            'queues',
            'security',
            'session',
            'templates',
            'testing',
            'validation',
            // 資料庫
            'database',
            'queries',
            'eloquent',
            'schema',
            'migrations',
            'redis',
            // Artisan CLI
            'artisan',
            'commands',
        ),
        'subdoc'=>array(
            // 前言
            'preface'=>array(
                'introduction',
                'quick',
                'contributing',
            ),
            // 入門
            'getting_started'=>array(
                'installation',
                'configuration',
                'lifecycle',
                'routing',
                'requests',
                'responses',
                'controllers',
                'errors',
            ),
            'learning_more'=>array(
                'cache',
                'events',
                'facades',
                'html',
                'ioc',
                'localization',
                'mail',
                'packages',
                'pagination',
                'queues',
                'security',
                'session',
                'templates',
                'testing',
                'validation',
            ),
            'db'=>array(
                'database',
                'queries',
                'eloquent',
                'schema',
                'migrations',
                'redis',
            ),
            'artisancli'=>array(
                'artisan',
                'commands',
            )
        )
    ),
    'generate_path'=>array(
        '/'=>'docs',
        '/docs/'=>array(
            // 前言
            'introduction',
            'quick',
            'contributing',
            // 入門
            'installation',
            'configuration',
            'lifecycle',
            'routing',
            'requests',
            'responses',
            'controllers',
            'errors',
            // 更多
            'cache',
            'events',
            'facades',
            'html',
            'ioc',
            'localization',
            'mail',
            'packages',
            'pagination',
            'queues',
            'security',
            'session',
            'templates',
            'testing',
            'validation',
            // 資料庫
            'database',
            'queries',
            'eloquent',
            'schema',
            'migrations',
            'redis',
            // Artisan CLI
            'artisan',
            'commands',
        )
    )
);