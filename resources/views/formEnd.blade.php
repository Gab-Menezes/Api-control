<form method="post">
    @csrf
    <div class="row">
        <div class="col col-3">
            <label for="name" style="color: #CCCCCC">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$name}}">
        </div>

        <div class="col col-8">
            <label for="end_point" style="color: #CCCCCC">End point</label>
            <input type="url" class="form-control" name="end_point" id="end_point" value="{{$end}}">
        </div>
    </div>
    <button class="btn btn-primary mt-3">{{$action}}</button>
</form>
