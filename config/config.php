<?php

define("ROOT", dirname(__DIR__));
const DEBUG = 1;
const WWW = ROOT . '/public';
const CONFIG = ROOT . '/config';
const HELPERS = ROOT . '/helpers';
const APP = ROOT . '/app';
const CORE = ROOT . '/core';
const VIEWS = APP . '/Views';
const ERROR_LOGS = ROOT . '/tmp/error.log';
const CACHE = ROOT . '/tmp/cache';
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
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];

const MAIL_SETTINGS = [
    'host' => 'sandbox.smtp.mailtrap.io', // smtp.gmail.com
    'auth' => true,
    'username' => 'ed44375e57e113', // your_email@gmail.com
    'password' => '7d7e2efb810ab4', // xxxx xxxx xxxx xxxx
    'secure' => 'tls', // ssl
    'port' => 587,
    'from_email' => '97908d3713-5eb56a@inbox.mailtrap.io', // your_email@gmail.com
    'from_name' => 'My Framework',
    'is_html' => true,
    'charset' => 'UTF-8',
    'debug' => 0, // 0 - 4
];

const PAGINATION_SETTINGS = [
    'perPage' => 3,
    'midSize' => 2,
    'maxPages' => 7,
    'tpl' => 'pagination/base',
];

const MULTILANGS = 1;

const LANGS = [
    'ru' => [
        'id' => 1,
        'code' => 'ru',
        'title' => 'Русский',
        'base' => 1,
    ],
    'en' => [
        'id' => 2,
        'code' => 'en',
        'title' => 'English',
        'base' => 0,
    ],
    'fr' => [
        'id' => 3,
        'code' => 'fr',
        'title' => 'France',
        'base' => 0,
    ],
];
