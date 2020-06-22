@extends('admin.layouts.app')

@section('content')
    
<h1>mostrando o teste</h1>   
<hr>
<h3>{{ $produto->description }}</h3>

<hr>

<table class="table table-striped">
    <tbody>
      <tr>
        <th scope="row">Codigo:</th>
        <td>{{$produto->id}}</td>
      </tr>
      <tr>
        <th scope="row">Nome:</th>
        <td>{{$produto->name}}</td>
      </tr>
      <tr>
        <th scope="row">Preço:</th>
        <td>{{$produto->price}}</td>
      </tr>      
      <tr>
        <th scope="row">Descição:</th>
        <td>{{$produto->description}}</td>
      </tr>
      <tr>
        <th scope="row">Data Cadastro:</th>
        <td>{{$produto->created_at}}</td>
      </tr>
      <tr>
        <th scope="row">Imagem:</th>
        <td >
          @if ($produto->image)
            <img src=" {{ url("storage/{$produto->image}") }} " class="img-fluid img-thumbnail">                  
          @else
            <svg class="img-fluid img-thumbnail" focusable="false"><rect width="100%" height="100%" fill="#868e96"></rect><text x="38%" y="50%" fill="#dee2e6">Sem Imagem</text></svg>            
          @endif
        </td>
      </tr>     
    </tbody>
  </table> 

  <form action="{{ route('produtos.destroy', [$produto->id]) }}" method="POST" class="form">
    @csrf
    @method('DELETE')

    <div class="form-group">
      <a href="{{ route('produtos.index') }}" class="btn btn-primary btn-sm">Voltar</a>      
      <button class="btn btn-danger btn-sm" type="submit" >Deletar</button>
    </div>   
  </form>  
@endsection