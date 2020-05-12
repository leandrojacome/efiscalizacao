<div class="card-body card-block">
    <div class="form-group">
        <label for="slug" class="form-control-label">Slug</label>
        <input id="slug" name="slug" type="text" class="form-control input-upper" style="text-transform: uppercase;" value="@if(isset($papel->slug)){{$papel->slug}}@else{{old('slug')}}@endif">
    </div>
    <div class="form-group">
        <label for="name" class="form-control-label">Nome</label>
        <input id="name" name="name" type="text" class="form-control" value="@if(isset($papel->name)){{$papel->name}}@else{{old('name')}}@endif">
    </div>
</div>

