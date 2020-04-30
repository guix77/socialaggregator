<div class="card mb-3">
    <h4 class="card-header">
        {{ $title }}
    </h4>
    <div class="card-body">
        {{ $slot }}
    </div>
    @isset ($footer)
    <div class="card-footer">
        {{ $footer }}
    </div>
    @endisset
</div>
