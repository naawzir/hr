@if(session()->has('message'))
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="alert-success">
                <p>{{ session()->get('message') }}</p>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endif
