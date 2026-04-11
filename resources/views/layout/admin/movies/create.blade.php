<h1>➕ Add Movie</h1>

<form method="POST" action="{{ route('admin.movies.store') }}">
    @csrf

    <input type="text" name="title" placeholder="Title"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="duration" placeholder="Duration"><br><br>

    <button type="submit">Save</button>
</form>