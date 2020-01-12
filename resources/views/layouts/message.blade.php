@if(session()->has('message'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="alert-success text-center">
                        <p>{{ session()->get('message') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
