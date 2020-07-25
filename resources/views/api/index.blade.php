@extends('layout')

@section('header')
    APIs Control
@endsection

@section('content')
    @include('message', ['success' => $success, 'error' => $error])
    <a href="/CreateEnd" class="btn btn-primary mb-3">New End Point</a>

    <ul class="list-group">
        @foreach ($end_points as $end_point)
        <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #d8d8d8">
            <span><b>{{$end_point->name}}</b> ({{$end_point->end_point}})</span>
            <span class="d-flex">
                <a href="/EditEnd/{{$end_point->id}}" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                
                <form method="post" action="/deleteEnd/{{$end_point->id}}" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    <button class="btn btn-danger mr-1">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                <button class="btn" type="button" data-toggle="collapse" data-target="#collapse-{{$end_point->id}}" aria-expanded="false" aria-controls="collapse-{{$end_point->id}}">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </span>
        </li>

        <div class="collapse" id="collapse-{{$end_point->id}}">
            <div class="card rounded-0" style="background-color: #1f2022; color: #000000">
                <div class="ml-3">
                    <a href='/CreateAPI/{{$end_point->id}}' class="btn btn-dark mt-3 mb-3" style="color: #f0f0f0">New API</a>
                </div>

                <div class="ml-3 mr-3">
                    <ul class="list-group">

                        @foreach ($end_point->apis as $api)
                        <span class="border border-danger" style="border-width: 3px !important; border-color: #2c4b9e !important">
                            <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #2c4b9e">
                                <span style="color: #f0f0f0"><b>{{$api->name}}</b> ({{$api->api}}) [{{strtoupper($api->type)}}]</span>
                                <span class="d-flex">
                                    <a href="/EditAPI/{{$api->id}}" class="btn btn-info mr-1"><i class="fas fa-edit"></i></a>
                                    
                                    <form method="post" action="/deleteAPI/{{$api->id}}" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        <button class="btn btn-danger mr-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#collapseAPI-{{$api->id}}" aria-expanded="false" aria-controls="collapseAPI-{{$api->id}}">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </span>
                            </li>

                            <div class="collapse" id="collapseAPI-{{$api->id}}">
                                <div class="card rounded-0" style="background-color: #1f2022; color: #f0f0f0">
                                    <div class="ml-3 mt-3">
                                        <p>
                                            <span>Base URL: </span><span id="baseURL-{{$api->id}}">{{$end_point->end_point . $api->api}}</span>
                                        </p>
                                        <div class="ml-3">
                                            <form action="">
                                                <div class="form-group row">
                                                    <label for="FinalURL-{{$api->id}}" class="col-form-label">Final URL:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="FinalURL-{{$api->id}}" value="{{$end_point->end_point . $api->api}}">
                                                    </div>
                                                    <button id="button-{{$api->id}}" class="btn btn-primary" request-button>{{strtoupper($api->type)}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                            
                                    <div class="ml-4 mr-5">
                                        <table class="table table-striped table-dark table-bordered table-sm" id="api-table-{{$api->id}}" api-table>
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Use</th>
                                                    <th scope="col">Parameters</th>
                                                    <th scope="col">Values</th>
                                                    <th scope="col">Descriptions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="height: 30px; text-align: center; vertical-align: middle"><input id="checkbox-{{$api->id}}-0" type="checkbox" style="height: 17px; width: 17px;" checked></td>
                                                    <td style="height: 30px"><input id="param-{{$api->id}}-0" type="text" class="form-control" style="background: #3e444a; height: 30px !important; color: #f0f0f0"></td>
                                                    <td style="height: 30px"><input id="value-{{$api->id}}-0" type="text" class="form-control" style="background: #3e444a; height: 30px !important; color: #f0f0f0"></td>
                                                    <td style="height: 30px"><input type="text" class="form-control" style="background: #3e444a; height: 30px !important; color: #f0f0f0"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    
                                    <div class="ml-4" >
                                        <div class="ml-1">
                                            <input body-checkbox id="checkbox-body-{{$api->id}}" type="checkbox" style="width: 17px; height: 17px; position: relative; top: 3px"><span> Body</span>
                                        </div>
                                        <div hidden class="mb-3 mt-1" id="div-body-{{$api->id}}">
                                            <textarea style="width: 60%" class="form-control" id="body-textarea-{{$api->id}}" rows="10"></textarea>
                                        </div>

                                        <p></p>

                                        <span><button type="button" class="btn btn-outline-light btn-sm" id="collapse-{{$api->id}}" collapse-button><i class="fas fa-minus-square"></i></button> Response</span>
                                        <div hidden class="mb-3 mt-1" id="div-textarea-{{$api->id}}">
                                            <textarea style="width: 50%" class="form-control" id="response-textarea-{{$api->id}}" rows="10" readonly></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </span>

                        <div class="mb-2"></div>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </div>

        <div class="mb-2"></div>
        @endforeach
    </ul>
    <div class="mb-5"></div>

    <script src="js/input.js"></script>
    <script src="js/request.js"></script>
    <script src="js/collapse.js"></script>
    <script src="js/body.js"></script>
@endsection
