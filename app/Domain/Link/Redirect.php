<?php
namespace App\Domain\Link;

class Redirect extends Worker
{
    protected string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function exec(): array
    {
        try {
            if ($res = $this->isExistsLink()){
                if ($this->checkTime($res)){
                    return [
                        'success'=>true,
                        'message'=>$this->getLink($res)
                    ];
                }else{
                    return [
                        'success'=>false,
                        'message'=>$this->getPhrases()->timeLinkIsUp()
                    ];
                }
            }else{
                return [
                    'success'=>false,
                    'message'=>$this->getPhrases()->errorLink()
                ];
            }
        }catch (\Throwable $exception){
            return [
                'success'=>false,
                'message'=>$exception->getMessage()
            ];
        }

    }

    protected function isExistsLink()
    {
        if ($res = $this->getModel()::where('token', $this->token)->first())
            return $res;

        return false;
    }

    protected function checkTime($res): bool
    {
        if ($res->created_at >= now()->subMinutes(5))
            return true;

        return false;
    }

    protected function getLink($res)
    {
        return $res->base_link;
    }
}