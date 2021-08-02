@auth
    🔑 Te has logueado como {{ auth()->user()->name }}
@endauth

@if ($errors->any())
    <div class="errores">Se encontraron estos errores:</div>
    @foreach ($errors->all() as $error)
        <ul>
            <li>❌ {{ $error }}</li>
        </ul>
    @endforeach
@endif
