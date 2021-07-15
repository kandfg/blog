@extends('layouts.app')
@section('content')
<form method="POST" action="login">
    @csrf
    <input type="email" name="email"><br>
    <input type="password" name="password"><br>
    <input type="submit">
</form>
@endsection