<?php
namespace App\Domain\Utils;

class Phrases
{
    public function incorrectLink(): string
    {
        return "Некорректная ссылка";
    }

    public function yourLink($token): string
    {
        return "Ваша ссылка ".$_ENV['APP_URL'].$token;
    }

    public function errorLink(): string
    {
        return "Такой ссылки не существует";
    }

    public function timeLinkIsUp(): string
    {
        return "Время жизни ссылки истекло";
    }
}