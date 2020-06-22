{{-- quando for usar alguma coisa igual em varias forms --}}

<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Nome" value="{{ $produto->name ?? old('name') }}">
    {{-- value Old mantem o dado preenchido anteiormente --}}
</div>
<div class="form-group">
    <input type="text" class="form-control" name="description" placeholder="Descrição" value="{{ $produto->description ?? old('description') }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="price" placeholder="Valor" value="{{ $produto->price ?? old('price') }}">
</div>
<div class="form-group">
    <input type="file" class="form-control-file" name="image" id="image">    
</div>

@if (isset($produto->image))
    <div class="form-group">    
        <img src="{{ url("storage/{$produto->image}") }}" class="img-fluid img-thumbnail" alt="Sem Imagem" id="imageAlt">
    </div>    
@else
    <div class="form-group">    
        <img class="img-fluid img-thumbnail" alt="Sem Imagem" id="imageAlt" style="display: none;">
    </div>    
@endif

<div class="form-group">
    <a class="btn btn-primary btn-sm" href="{{ route('produtos.index') }}" role="button">Voltar</a>
    <button class="btn btn-success btn-sm" type="submit">Confirmar</button>
</div>   

@push('scripts')  
<script>
    $(function(){
        $('#image').change(function(){
            const file        = $(this)[0].files[0]
            const fileReader  = new FileReader()
            fileReader.onload = function(){
                $('#imageAlt').attr('src', fileReader.result)
                $('#imageAlt').css({display:"block"})
                console.log
            } 
            fileReader.readAsDataURL(file)
        })
    })
</script>            
@endpush


<div class="form-group">    
    <img id="testeimage">
</div>



