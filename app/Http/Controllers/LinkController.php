<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Link\Create;
use App\Domain\Link\Redirect;

class LinkController extends Controller
{
    public function routeLink($linkToken)
    {
        $result = (new Redirect($linkToken))->exec();
        if ($result['success']){
            header("Location: ".$result['message']);
            exit();
        }else{
            return view('errorLink')->with('message',$result['message']);
        }

    }

    public function createReduction(Request $request): array
    {
        return (new Create($request->get('link')))->exec();
    }
}