@if (count($errors) >0)
    <ul>
        @foreach($errors->all() as $error)
            <li class="text-danger"> {{ $error }}</li>
        @endforeach
    </ul>
@endif
<form method="post" action="login">
    @csrf
    Account: <input name="email"><br>
    Password: <input type="password" name="password">
    <button type="submit">Login</button>
</form>
