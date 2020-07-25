<?php

namespace App\Http\Controllers;

use App\Api;
use App\EndPoint;
use App\Http\Requests\ApiFormRequest;
use App\Http\Requests\EndPointFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EndController extends Controller
{
    private function addSlash(string $url) : string
    {
        $lastChar = strlen($url) - 1;
        if ($url[$lastChar] !== "/")
            $url .= "/";

        return $url;
    }

    public function __construct()
    {
        $this->middleware('authenticator');
    }
    
    public function index(Request $request) : string
    {
        $end_points = EndPoint::where('user_id', Auth::id())->get();
        $success = $request->session()->get('success');
        $error = $request->session()->get('error');
        return view('api.index', compact('end_points', 'success', 'error'));
    }

    public function createEnd(Request $request)
    {
        $action = "Add";
        $name = "";
        $end = "";
        return view('api.createEnd', compact('action', 'name', 'end'));
    }

    public function storeEnd(EndPointFormRequest $request)
    {
        $data = $request->except("_token");
        $user = User::find(Auth::id());

        $data['end_point'] = $this->addSlash($data['end_point']);
        $end_point = $user->EndPoints()->create($data);

        $request->session()->flash('success', "End Point {$end_point->name} added with success");
        return redirect('/home');
    }

    public function deleteEnd(int $EndPointId, Request $request)
    {
        $end_point = EndPoint::find($EndPointId);
        if ($end_point !== NULL && (int)$end_point->user_id === Auth::id())
        {
            $name = $end_point->name;
            DB::beginTransaction();
            $end_point->apis->each(function (Api $api)
            {
                $api->delete();
            });
            $end_point->delete();
            DB::commit();
            $request->session()->flash('success', "End Point {$name} deleted with success");
        }
        else
        {
            $request->session()->flash('error', "ERROR: Not allowed to delete this End Point");
        }
        return redirect('/home');
    }

    public function GetEditEnd(int $EndPointId, Request $request)
    {
        $end_point = EndPoint::find($EndPointId);
        if ($end_point !== NULL && (int)$end_point->user_id === Auth::id())
        {
            $name = $end_point->name;
            $action = "Edit";
            $end = $end_point->end_point;
            return view('api.editEnd', compact('name', 'action', 'end'));
        }
        else
        {
            $request->session()->flash('error', "ERROR: Not allowed to edit this End Point");
            return redirect('/home');
        }
    }

    public function PostEditEnd(int $EndPointId, EndPointFormRequest $request)
    {
        $end_point = EndPoint::find($EndPointId);
        if ($end_point !== NULL && (int)$end_point->user_id === Auth::id())
        {
            $data = $request->except("_token");
            $data['end_point'] = $this->addSlash($data['end_point']);

            $end_point->update($data);
            $request->session()->flash('success', "End Point {$end_point->name} edited with success");
        }
        else
            $request->session()->flash('error', "ERROR: Not allowed to edit this End Point");

        return redirect('/home');
    }
}
