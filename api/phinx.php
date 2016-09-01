<?php

return array(
    "paths" => array(
        "migrations" => "resources/db/migrations",
        "seeds" => "resources/db/seeds"
    ),
    "environments" => array(
        "default_migration_table" => "migration",
        "default_database" => "development",
        "development" => array(
            "adapter" => "mysql",
            "host" => 'localhost',
            "name" => 'root',
            "user" => 'root',
            "pass" =>'root',
            "port" => '3306',
            "charset" => 'utf8'
        ),
        "testing" => array(
            "adapter" => "mysql",
            "host" => '',
            "name" => '',
            "user" => '',
            "pass" =>'',
            "port" => '',
            "charset" => ''
        ),
        "production" => array(
            "adapter" => "mysql",
            "host" => '',
            "name" => '',
            "user" => '',
            "pass" =>'',
            "port" => '',
            "charset" => ''
        )
    )
);