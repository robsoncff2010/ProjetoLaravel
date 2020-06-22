@if ($errors->any())
    @foreach ($errors->all() as $error)                                    
        @component('admin.components.card')    
            @slot('title')                            
                <p>{{ $error }}</p> 
            @endslot                            
        @endcomponent                                                
    @endforeach                                                     
@endif