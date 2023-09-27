<?php
namespace App\Domain\Link;

use App\Models\ShortLinks;
use App\Domain\Utils\Phrases;


abstract class Worker
{
    abstract public function exec();

    public function getModel(): string
    {
        return ShortLinks::class;
    }

    public function getPhrases(): Phrases
    {
        return (new Phrases());
    }
}