@extends('admin.layouts.app')
@section('content')   
    @include('admin.includes.alerts')
    <h1>Editando cadastro "{{ $produto->name }}"</h1>   
    <form action="{{ route('produtos.update', [$produto->id]) }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        @include('admin.pages.produtos._partials.form')   
    </form>    
@endsection