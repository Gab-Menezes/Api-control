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

class ApisController extends Controller
{

    public function __construct()
    {
        $this->middleware('authenticator');
    }

    public function createAPI(Request $request)
    {
        $action = "Add";
        $name = "";
        $api = "";
        $option = "get";
        return view('api.createAPI', compact('action', 'api', 'option', 'name'));
    }

    public function storeAPI(int $EndPointId, ApiFormRequest $request)
    {
        $end_point = EndPoint::find($EndPointId);
        if ($end_point !== NULL && (int)$end_point->user_id === Auth::id())
        {
            $data = $request->except("_token");
            $api = $end_point->apis()->create($data);
            $request->session()->flash('success', "API {$api->name} added with success for {$end_point->name}");
        }
        else
        {
            $request->session()->flash('error', "ERROR: API creation failed.");
        }
        return redirect('/home');
    }

    public function GetEditAPI(int $ApiId, Request $request)
    {
        $api = Api::find($ApiId);
        if ($api !== NULL)
        {
            $EndPointId = $api->end_point_id;
            $end_point = EndPoint::find($EndPointId);
            if ($end_point !== NULL && (int)$end_point->user_id === Auth::id())
            {
                $option = $api->type;
                $name = $api->name;
                $action = "Edit";
                $api = $api->api;
                return view('api.editAPI', compact('name', 'action', 'api', 'option'));
            }
            else
            {
                $request->session()->flash('error', "ERROR: Not allowed to edit this API");
                return redirect('/home');
            }
        }
        else
        {
            $request->session()->flash('error', "ERROR: Not allowed to edit this API");
            return redirect('/home');
        }
    }

    public function PostEditAPI(int $ApiId, ApiFormRequest $request)
    {
        $api = Api::find($ApiId);
        if ($api !== NULL)
        {
            $EndPointId = $api->end_point_id;
            $end_point = EndPoint::find($EndPointId);
            if ($end_point !== NULL && (int)$end_point->user_id === Auth::id())
            {
                $name = $api->name;
                $data = $request->except("_token");
                $api->update($data);

                $request->session()->flash('success', "API {$name} edit with success");
            }
            else
            {
                $request->session()->flash('error', "ERROR: Not allowed to edit this API");
            }
        }
        else
        {
            $request->session()->flash('error', "ERROR: Not allowed to edit this API");
        }

        return redirect('/home');
    }

    public function deleteAPI(int $ApiId, Request $request)
    {
        $api = Api::find($ApiId);
        if ($api !== NULL)
        {
            $EndPointId = $api->end_point_id;
            $end_point = EndPoint::find($EndPointId);
            if ($end_point !== NULL && (int)$end_point->user_id === Auth::id())
            {
                $name = $api->name;
                $api->delete();
                $request->session()->flash('success', "API {$name} deleted with success");
            }
            else
            {
                $request->session()->flash('error', "ERROR: Not allowed to delete this API");
            }
        }

        return redirect('/home');
    }
}
