<?php

namespace PHPFramework;

use Valitron\Validator;

abstract class Model
{

    protected string $table;
    public bool $timestamps = true;
    protected array $loaded = [];
    protected array $fillable = [];
    public array $attributes = [];
    protected array $rules = [];
    protected array $labels = [];
    protected array $errors = [];

    public function save(): false|string
    {
        foreach ($this->attributes as $k => $v) {
            if (!in_array($k, $this->fillable)) {
                unset($this->attributes[$k]);
            }
        }
        // insert into $tbl (f1, f2, ...) values (?,?,...)
        // insert into $tbl (`f1`, `f2`, ...) values (:f1, :f2, ...)
        $fields_keys = array_keys($this->attributes);
        $fields = array_map(fn($field) => "`{$field}`", $fields_keys);
        $fields = implode(',', $fields);
        if ($this->timestamps) {
            $fields .= ', `created_at`, `updated_at`';
        }

        $placeholders = array_map(fn($field) => ":{$field}", $fields_keys);
        $placeholders = implode(',', $placeholders);
        if ($this->timestamps) {
            $placeholders .= ', :created_at, :updated_at';
            $this->attributes['created_at'] = date("Y-m-d H:i:s");
            $this->attributes['updated_at'] = date("Y-m-d H:i:s");
        }

        $query = "insert into {$this->table} ($fields) values ($placeholders)";
        db()->query($query, $this->attributes);
        return db()->getInsertId();
    }

    public function loadData(): void
    {
        $data = request()->getData();
        foreach ($this->loaded as $field) {
            if (isset($data[$field])) {
                $this->attributes[$field] = $data[$field];
            } else {
                $this->attributes[$field] = '';
            }
        }
    }

    public function validate($data = [], $rules = [], $labels = []): bool
    {
        if (!$data) {
            $data = $this->attributes;
        }
        if (!$rules) {
            $rules = $this->rules;
        }
        if (!$labels) {
            $labels = $this->labels;
        }

        Validator::addRule('unique', function ($field, $value, array $params, array $fields) {
            $data = explode(',', $params[0]);
            return !(db()->findOne($data[0], $value, $data[1]));
            //dd($field, $value, $params, $data, $user);
        }, 'must be unique');

        Validator::langDir(WWW . '/lang');
        Validator::lang('ru');
        $validator = new Validator($data);
        $validator->rules($rules);
        $validator->labels($labels);
        if ($validator->validate()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}