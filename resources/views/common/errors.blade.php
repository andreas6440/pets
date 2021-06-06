@if (count($errors))
<div class="row">
    <div class="col">
        <div class="invalid-feedback" style="display: block">
            <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    </div>
</div>

@endif
