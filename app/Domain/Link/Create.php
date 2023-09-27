<?php

namespace App\Domain\Link;
use App\Domain\Utils\Tools;

class Create extends Worker
{
    protected string $link;

    public function __construct(string $link)
    {
        $this->link = $link;
    }

    public function exec(): array
    {
        try {
            if ($this->isLink()) {
                $result = $this->createOrFind();

                return [
                    'success' => true,
                    'message' =>$this->getPhrases()->yourLink($result->token)
                ];
            } else {
                return [
                    'success' => false,
                    'message' => $this->getPhrases()->incorrectLink()
                ];
            }
        }catch (\Throwable $exception){
            return [
                'success'=>false,
                'message'=>$exception->getMessage()
            ];
        }


    }

    protected function isLink(): bool
    {
        if (preg_match('/https?:\/\/(.+)?\.(.+)/', $this->link)) {
            return true;
        } else {
            return false;
        }
    }

    protected function createOrFind()
    {
        return $this->getModel()::firstOrCreate(
            [
                'base_link' => htmlspecialchars($this->link)
            ],
            [
                'token' => $this->generateCode(5)
            ]
        );
    }

    protected function generateCode(int $length): string
    {
        $result = "";

        $chars = (new Tools())->getPermittedChars();
        $lenChars = strlen($chars);

        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[mt_rand(0, $lenChars - 1)];
        }

        return $result;
    }
}