<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProdutos;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcuctsController extends Controller
{

    protected $request;
    private $repository;

    public function __construct(Request $request, Produto $product)
    {
        $this->request = $request;     
        $this->repository = $product;
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::paginate();
        return view('admin.pages.produtos.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProdutos  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProdutos $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) 
        {            
            $nomeArquivo = $request->name . '.' . $request->image->extension();            
            $imagePath   = $request->image->storeAs('produtos',$nomeArquivo);

            $data['image'] = $imagePath;                
        }

        Produto::create($data);

        return redirect()->route('produtos.index');

    //    $request->validate([

    //         'name'=>'required|min:3|max:10',
    //         'description'=>'required|min:3|max:10',
    //         'arquivo'=>'required|image'            
    //    ]);

       //dd($request->all()); // -- para ver tudo que esta sendo enviado para a pagina
       //dd($request->all(['name'])); // -- para ver dados de campo especifico
       //dd($request->file(['arquivo'])); //-- para pegar os dados do arquivo
       //dd("cadastrando....");

    //    if ($request->file(['image'])->isValid()) {
           
            //dd($request->arquivo->getClientOriginalName()); pegar o nome original do arquivo
            //dd($request->arquivo->store()); -- gravar o arquivo na pasta definida no arquivo env

            // $nomeArquivo = $request->name . '.' . $request->image->extension(); //-- montando o nome do arquivo
            // dd($request->image->storeAs('produtos',$nomeArquivo)); 

            //dd($request->arquivo->store('produtos')); 
    //    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()->back();
            
        }else{

            return  view('admin.pages.produtos.show',['produto' => $produto]);
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {                   
        $produto = Produto::find($id);        
        return view('admin.pages.produtos.edit',['produto' => $produto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProdutos  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProdutos $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()->back();
        }

        $data = $request->all();
        
        if ($request->hasFile('image') && $request->image->isValid()) 
        {

            if ($produto->image && Storage::exists($produto->image))
            {
                storage::delete($produto->image);
            }
            
            $nomeArquivo = $request->name . '.' . $request->image->extension();            
            $imagePath   = $request->image->storeAs('produtos',$nomeArquivo);

            $data['image'] = $imagePath;                
        }
        
        $produto->update($data);

        return redirect()->route('produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()->back();
        }

        if ($produto->image && Storage::exists($produto->image))
        {
            storage::delete($produto->image);
        }

        Produto::destroy($id);
        return redirect()->route('produtos.index');
    }

    public function search(Request $request)
    {       
        $filters  = $request->except(['_token']);
        $produtos = $this->repository->search($request->filter);
        //dd($request->all());

        return view('admin.pages.produtos.index', ['produtos' => $produtos, 'filters' => $filters]);        
    }
}


