<?php

namespace App\Models;

use PHPFramework\Model;

class User extends Model
{

    protected string $table = 'users';
    public bool $timestamps = false;
    protected array $loaded = ['name', 'email', 'password', 'confirmPassword'];
    protected array $fillable = ['name', 'email', 'password'];

    protected array $rules = [
        'required' => ['name', 'email', 'password', 'confirmPassword'],
        'email' => ['email'],
        'lengthMin' => [
            ['password', 6]
        ],
        'equals' => [
            ['password', 'confirmPassword']
        ]
    ];

    protected array $labels = [
        'name' => 'Имя',
        'email' => 'E-mail',
        'password' => 'Пароль',
        'confirmPassword' => 'Подтверждение пароля',
    ];


}