<form method="post">
    @csrf
    <div class="row">
        <div class="col col-3">
            <label for="name" style="color: #CCCCCC">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$apiName}}">
        </div>

        <div class="col col-7">
            <label for="api" style="color: #CCCCCC">API</label>
            <input type="text" class="form-control" name="api" id="api" value="{{$api}}">
        </div>

        <div class="col col-2">
            <label for="type" style="color: #CCCCCC">Type</label>
            <select id="type" class="form-control" name="type">
                <option value = "get" @if ($option === "get") selected @endif>Get</option>
                <option value = "post" @if ($option === "post") selected @endif>Post</option>
                <option value = "delete" @if ($option === "delete") selected @endif>Delete</option>
                <option value = "patch" @if ($option === "patch") selected @endif>Patch</option>
            </select>
        </div>
    </div>

    <button class="btn btn-primary mt-3">{{$action}}</button>
</form>
