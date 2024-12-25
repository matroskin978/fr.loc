<?php

namespace PHPFramework;

class File
{

    protected string $name;
    protected string $type;
    protected string $tmpName;
    protected int $error;
    protected int $size;
    public bool $isFile;

    public function __construct(string $fileName)
    {
        $files = request()->files;
        $this->name = $files[$fileName]['name'] ?? '';
        $this->type = $files[$fileName]['type'] ?? '';
        $this->tmpName = $files[$fileName]['tmp_name'] ?? '';
        $this->error = $files[$fileName]['error'] ?? 4;
        $this->size = $files[$fileName]['size'] ?? 0;
        $this->isFile = (bool)$this->size;
    }

    public function save($folder = ''): bool|string
    {
        if (!$this->isFile) {
            return false;
        }

        $dir = UPLOADS;
        if ($folder) {
            $dir .= '/' . trim($folder, '/');
        }

        $dir .= '/' . date('Y') . '/' . date('m') . '/' . date('d');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $dir_url = str_replace(WWW, '', $dir);
        $file_name = md5($this->name . time() . uniqid('', true)) . '.' . $this->getExt();
        $file_url = $dir_url . '/' . $file_name;
        $file_path = $dir . '/' . $file_name;

        if (move_uploaded_file($this->tmpName, $file_path)) {
            return $file_url;
        }
        return false;
    }

    public function getExt(): string
    {
        $file_ext = explode('.', $this->name);
        return end($file_ext);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTmpName(): string
    {
        return $this->tmpName;
    }

    public function getError(): int
    {
        return $this->error;
    }

    public function getSize(): int
    {
        return $this->size;
    }


}