<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pais as Pais;
use App\Models\Grupo as Grupo;
use App\Models\Proceso as Proceso;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pais=Pais::orderBy('id','DESC')
            ->select('paises.*')
            ->get();
        return view('Paises/listPais', compact('Pais'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Paises/NewPais');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pais = Pais::orderBy('created_at', 'DESC')
            ->select('paises.*')
            ->where('paises.nombre', '=', $request->nombre)
            ->get();

        if ($pais == "[]") {
            $Pais = new Pais();
            $Pais->nombre = $request->nombre;
            $Pais->estado = "Activo";
            $Pais->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Pais = Pais::find($id);
        return view('Paises/UpdatePais', compact('Pais'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = \Auth::user()->user_red;

        $pais = Pais::orderBy('created_at', 'DESC')
            ->select('paises.*')
            ->where('paises.nombre', '=', $request->nombre)
            ->get();


            $Pais = Pais::find($request->id);
            if($pais=="[]") {
                $Pais->nombre = $request->nombre;
            }
            $Pais ->estado = $request ->estado;
            $Pais ->justificacion = $request ->justificacion;
            $Pais ->registro = $user;
            $Pais -> save();

            if($request ->estado=="Inactivo"){

                $grupos=Grupo::orderBy('id','ASC')
                    ->select('grupos.*')
                    ->where('grupos.FK_Pais', '=', $request->id)
                    ->get();

                foreach ($grupos as $Grupo){
                    $gruposU= Grupo::find($Grupo->id);
                    $gruposU ->estado = $request ->estado;
                    $gruposU ->justificacion = "El pais asociado ha sido inactivado por ".$request->justificacion;
                    $gruposU ->registro = $user;
                    $gruposU->save();

                    $procesos=Proceso::orderBy('id','ASC')
                        ->select('procesos.*')
                        ->where('procesos.FK_Grupo', '=', $Grupo->id)
                        ->get();

                    foreach ($procesos as $Proceso){
                        $procesoT = Proceso::find($Proceso->id);
                        $procesoT ->estado = $request ->estado;
                        $procesoT ->justificacion = "El país asociado al grupo ha sido inactivado por ".$request->justificacion;
                        $procesoT->save();
                    }
                }
            }else{
                $grupos=Grupo::orderBy('id','ASC')
                    ->select('grupos.*')
                    ->where('grupos.FK_Pais', '=', $request->id)
                    ->get();

                foreach ($grupos as $Grupo){
                    $gruposU= Grupo::find($Grupo->id);
                    $gruposU ->estado = $request ->estado;
                    $gruposU ->justificacion = "";
                    $gruposU ->registro = $user;
                    $gruposU->save();

                    $procesos=Proceso::orderBy('id','ASC')
                        ->select('procesos.*')
                        ->where('procesos.FK_Grupo', '=', $Grupo->id)
                        ->get();

                    foreach ($procesos as $Proceso){
                        $procesoT = Proceso::find($Proceso->id);
                        $procesoT ->estado = $request ->estado;
                        $procesoT ->justificacion = "";
                        $procesoT->save();
                    }
                }
            }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Pais=Pais::find($id);
        $Pais->delete();
        return redirect()->back();
    }
    public function search(Request $request)
    {
        $Pais = Pais::where('nombre','like','%'.$request->nombre.'%')->paginate(5);
        return \View::make('Paises/listPais', compact('Pais'));
    }

}
