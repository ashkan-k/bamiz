@if($errors->any())
    @foreach($errors->all() as $e)
        <div class="error-alert-bar p-15 m-b-20 red white-text center" style="display: block;">
            {{ $e }}
        </div>
    @endforeach
@endif
