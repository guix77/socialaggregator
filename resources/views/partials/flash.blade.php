@if (session('success'))
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>
@endif
