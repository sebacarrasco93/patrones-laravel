<h1>Users:</h1>

@foreach ($users as $user)
    <p>{{ $user->name }}</p>
@endforeach
