<?php

define("ROOT", dirname(__DIR__));
const WWW = ROOT . '/public';
const CONFIG = ROOT . '/config';
const HELPERS = ROOT . '/helpers';
const APP = ROOT . '/app';
const CORE = ROOT . '/core';
const VIEWS = APP . '/Views';
const LAYOUT = 'default';
const PATH = 'https://fr.loc';

const DB_SETTINGS = [
    'driver' => 'mysql',
    'host' => 'MariaDB-11.2',
    'database' => 'fr_loc',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'port' => 3306,
    'prefix' => '',
];
