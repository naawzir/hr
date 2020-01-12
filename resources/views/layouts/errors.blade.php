@if(session()->has('errors'))
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-7 alert-danger">
        @foreach ($errors->all() as $error)
             <p>{{ $error }}</p>
         @endforeach
    </div>
    <div class="col-md-4"></div>
</div>
@endif

