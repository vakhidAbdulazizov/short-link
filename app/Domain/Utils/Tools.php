<?php
namespace App\Domain\Utils;

class Tools
{
    public function getPermittedChars(): string
    {
        return "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
}