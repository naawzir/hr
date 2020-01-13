@if(session()->has('errors'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="alert-danger text-center">
                        @foreach ($errors->all() as $error)
                             <p>{{ $error }}</p>
                         @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

