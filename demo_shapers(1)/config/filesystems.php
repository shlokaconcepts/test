<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'gcs' => [
            'driver' => 'gcs',
            // 'key_file_path' => public_path('google-cloud-key.json'), // optional: /path/to/service-account.json
            'driver' => 'gcs',
            'project_id' => "shapers-hr-portal",
            'key_file' => [
                "type" => "service_account",
                "project_id" => "shapers-hr-portal",
                "private_key_id" => "7835dd209ef0cdc8bd77bd7bf0c64a104974ca34",
                "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDsGapapR0/K6Pz\n7i+MRLNIUUfewL+Q07v2rjQOskVNEDAUYyRQWnJAKNgrojp9MAP4De4Aw2SU6j6h\nXaixdoPjA1Al0FKt5nMGA2m7ofN2nEvL7qDJWwEL5Kc3g+w2EIqx5WivFoSWCyUt\nCV4ijJftZ838pkujC2q5ixqfTBtUAFMrwKBMO2eUt/DZzZoAFUY5D5X8xrPqP6Fi\nFPuYns6/myiUpwAfPIHTkVhjZJmt20xfaOUtFnuqyORK1cSPsloiAtWqiv4eKg/v\ngiOnx45z2EMH6q5abIxgIx5sVhrvrL8G1/+DfZrMe9P1xYmrIyxYvzgXCf6YZaMy\nacgtY9/5AgMBAAECggEACUIwZgGXlgSWF1i90JhZF3rogJm6aWmEM3Y9YF4pTY5W\n9FW29Ne3J0DyyTNBa+tYHIAfVzRSW2ycLCPKG7t0DJDysajrtRoWZKP5n3wIWhxi\n9IpVD9BbyCWdURYBS1V2uucuJb+ST3f8azm00VIGGy846rFyweAOvVvxHVIUuER/\ntjwu/wI7E/TyBCq61VuU7HTXjLmoPQ5CW0vKL4VTKypQ0yMwGijLHKv4BeSLUt3P\nX3fCaCyy3wSGnmrnJ9FkeM3qB0AlS0gnRdhX9siVcoEFEQB8VLJ+NfnPwV2oQDMJ\nisf069vwQapV2xOAq5y0dERqHvefao672Aua2w/9IQKBgQD21jZgYMSU7IJrX/sQ\nX+3xxAlvIdBAqLpoKRWYFg6CuLMkpbkZISOJmCeMolraDW7GbLrTdKNmdDP9XUIT\nleCGiYvx1f/nwT/zv5kHSSGA9kByhWkqymABqRxdIkOm1/gNhtTJK9t2dENbHflK\n7byQQGXlqyJd0zuvN6fmJIac7QKBgQD03WtyZ0IFPZ+Ck3Kcvf7cH5TLQaQTW/ei\np8AWete/udvdI7jJLKBQV2VYBR2Mr0CrrD3refulFGAk/cLzC7HsFIqHrHt+aetA\nDBbAaowhgO7qzg47IJoZHKCUvt/jq8xtL2CtS8srjlmXLuvyU60grhPBQBn+L+6L\ngnt3yG55vQKBgQDXxY/JFi4h5NFpHYDx4nm08uIwVIWgUB6K+QcYaIeMu/pVmczB\na9eN6wT/idkTbdSc/eUe/YHtCL19yKz/Q+/+i3RbFe/a3nKSF7WkycfQ3PKfaYHy\nVvAv422Y+F/dFEORR4DwzjbNSHqsxvnqBwHjs3efmcaz7/fnhiZuJxXJTQKBgQDm\ny0g55X+BxwpwnZ96g04TliS9y5nlsVpgUjKoPZLbIEhOUBwcadaUwzs/Ulr+vjR7\nWvZl22zHtMPGOfSk9pH1zYqgxH8FsLnOfVZ4eDSqY4dNg3hAXMNCBgyJBruqMMSW\n6P/7dyQBYsOozs4PcrUMx2bRUCTvw6fYkNzlEuKmFQKBgQCBS76BPNeRmz3YVq14\nafEX2UXsC+P7YiubvKsQvOpwOHmrOps3cGzJxIV5kzPZCRAwC0L7s4bbO9mI7EUY\nZZxPduTk7axNsyTwgFpqkfWHiFtTLtdoJgoUajSPeBJHW286F23msCFPNsESk3b5\n7eVX3ugj53sLrhxGHLT33zztYg==\n-----END PRIVATE KEY-----\n",
                "client_email" => "shaper-hr-upload@shapers-hr-portal.iam.gserviceaccount.com",
                "client_id" => "110328112063419928993",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/shaper-hr-upload%40shapers-hr-portal.iam.gserviceaccount.com"
            ],
            'bucket' => "shapers-hr-portal-upload",
            'visibility' => 'public',
            'predefinedAcl' => 'publicRead',
            'x-goog-acl' => 'public-read',
            'storage_api_uri' =>  'https://storage.googleapis.com/shapers-hr-portal-upload/',
            'visibility' => 'public',
        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
