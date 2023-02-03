<?php

namespace Source\Core;

final class Environment
{
    public static function load(string $dir): bool
    {
        if (!file_exists($dir . '/.env'))
            return false;

        $lines = file($dir . '/.env');
        foreach ($lines as $line) {
            putenv(trim($line));
        }

        return true;
    }
}