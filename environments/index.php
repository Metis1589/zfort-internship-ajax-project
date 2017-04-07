<?php
/**
 * The manifest of files that are local to specific environment.
 * This file returns a list of environments that the application
 * may be installed under. The returned data must be in the following
 * format:
 *
 * ```php
 * return [
 *     'environment name' => [
 *         'path' => 'directory storing the local files',
 *         'skipFiles'  => [
 *             // list of files that should only copied once and skipped if they already exist
 *         ],
 *         'setWritable' => [
 *             // list of directories that should be set writable
 *         ],
 *         'setExecutable' => [
 *             // list of files that should be set executable
 *         ],
 *         'setCookieValidationKey' => [
 *             // list of config files that need to be inserted with automatically generated cookie validation keys
 *         ],
 *         'createSymlink' => [
 *             // list of symlinks to be created. Keys are symlinks, and values are the targets.
 *         ],
 *     ],
 * ];
 * ```
 */
return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            'techapi/runtime',
            'api/runtime',
            'backend/runtime',
            'console/runtime',
            'backend/web/assets',
            'frontend/web/assets',
            'node_modules',
            'bower_components',
            'public',
        ],
        'setExecutable' => [
            'yii',
            'yii_test',
        ],
        'setCookieValidationKey' => [
            'backend/config/main-local.php',
        ],
        'createSymlink' => [
            'httpdocs' => 'frontend/web',
            'admdocs' => 'backend/web',
            'apidocs' => 'api/web',
            'backend/web/uploads' => 'frontend/web/uploads',
        ],
    ],
    'Production' => [
        'path' => 'prod',
        'setWritable' => [
            'api/runtime',
            'backend/runtime',
            'console/runtime',
            'backend/web/assets',
            'frontend/web/uploads',
            'node_modules',
            'bower_components',
            'public',
        ],
        'setExecutable' => [
            'yii',
        ],
        'setCookieValidationKey' => [
            'backend/config/main-local.php',
        ],
        'createSymlink' => [
            'httpdocs' => 'frontend/web',
            'admdocs' => 'backend/web',
            'apidocs' => 'api/web',
            'backend/web/uploads' => 'frontend/web/uploads',
        ],
    ],
];
