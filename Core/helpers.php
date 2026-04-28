<?php

if (!function_exists('url')) {
    function url(string $path = ''): string {
        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
        return $base . '/' . ltrim($path, '/');
    }
}