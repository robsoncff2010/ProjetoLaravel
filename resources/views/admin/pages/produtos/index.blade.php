@extends('admin.layouts.app')

@section('content')   

  {{-- <h1>mostrando o teste</h1>   

  <hr>

  <a href="{{ route('produtos.create') }}">Cadastrar</a>

  <hr>
  
  @if (isset($produtos))

    @foreach ($produtos as $item)
      <p>{{ $item }}</p>    
    @endforeach 
      
  @endif  

  <hr>

  @forelse ($produtos as $item)    
    <p>{{ $item }}</p>
  @empty
    <p>Não existe produtos cadastrados</p>
  @endforelse

  <hr>
  
  exemplo colorindo o ultimo elemento

  @forelse ($produtos as $item)    
    <p class="@if($loop->last)
                ultimo
              @endif">{{ $item }}</p>
  @empty
    <p>Não existe produtos cadastrados</p>
  @endforelse

  <hr>

  incluindo aviso de alerta   
    @include('admin.includes.alerts', ['content' => 'Valor de novos Produtos'])

  <hr>

  utilizando um componente
  
  @component('admin.components.card')
    
    @slot('title')
        <p>Meu titulo do componente</p>
    @endslot
    <p>exemplo de card</p>      

  @endcomponent

  <hr>

  @if ($teste === 123)
    <p>resposta correta</p>       

  @endif

  @unless ($teste === '123')
    <p>retornou unless</p> 

  @endunless

  @auth
    <p>Autenticado</p> 
  
  @else
    <p>Nao Autenticado</p>  
  
  @endauth

  @switch($teste)
      @case(1)
          
          @break
      @case(123)
        <p>Entrou na segunda considição do switch</p>  
        
          @break
      @default 
        //quando nao entrar em nenhuma condição acima         
  @endswitch --}}

  {{-- MOstrando produtos cadastrados --}}
  <hr>
  <div class="form-inline">
    <form action="{{ route('produtos.create') }}" class="form">
      <button type="submit" class="btn btn-success btn-sm" style="margin-right: 10px">Cadastrar</button>
    </form> 
  </div>          
  <hr>
  <form action="{{ route('produtos.search') }}" method="POST" class="form form-inline" style="margin-bottom: 1rem; margin-right: 1rem">  
    @csrf
    <input type="text" name="filter" placeholder="Pesquisar" class="form-control form-control-sm" style="margin-right: 10px;" value="{{ $filters['filter'] ?? '' }}">
    <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
  </form>
  <table class="table table-striped">
    <thead>
        <tr>
          <th>Nome:          </th>
          <th>Preço:         </th>
          <th>Data Cadastro: </th>
          <th>Imagem:        </th>
          <th>Descição:      </th>          
          <th>Opções:        </th>          
        </tr>
      </thead>
      <tbody>
          @foreach ($produtos as $produto)
              <tr>
                <td>{{$produto->name}}</td>
                <td>{{$produto->price}}</td>
                <td>{{$produto->created_at}}</td>
                <td>
                  @if ($produto->image)
                    <img src=" {{ url("storage/{$produto->image}") }} " class="img-fluid img-thumbnail" alt="" style="max-width: 50px; max-height: 30px;">    
                  @else                      
                  @endif
                </td>
                <td>
                  <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-info btn-sm">Detalhes</a>                    
                </td>
                <td class="form-inline">   
                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary btn-sm" style="margin-right: 10px;">Editar</a>
                  <form action="{{ route('produtos.destroy', $produto->id) }}" class="form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>                    
                  </form>
                </td>                
              </tr>
          @endforeach
      </tbody>
  </table>

  {{--para verificar se exite algo na variavel filters, appends mantem a ordem nas proximas paginas--}}
  @if (isset($filters))
    {!! $produtos->appends($filters)->links() !!}  
  @else
    {!! $produtos->links() !!}    
  @endif
  
@endsection

@push('styles')

    {{-- <style>
      .ultimo {color: brown;}
    </style> --}}
@endpush

@push('scripts')
    
    {{-- <script>
      document.body.style.background = '#a2e5ff'
    </script> --}}
@endpush
