<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Http\Requests\AddHistoryRequest;
use Faker\Provider\Lorem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HistoryController extends Controller
{
    public function showLayout(Request $request){
        // $token = $request->session()->token();
        // // dd($token);
        // $token = csrf_token();
        // dd($token);
        // if(isset($_REQUEST['id'])){
        //     dd(444);
        //     redirect()->back();
        // }
        return view('components.layout');
    }

    public function showHistories(){
        $data = History::all();
        // dump($data);
        return view('myProject.history.allHistory',[
            'histories' => $data,
        ]);
    }

    public function showHistory($id){

        $history = History::find($id);

        return view('myProject.history.oneHistory',[
            'history' => $history,
        ]);
    }

    public function showAddHistory(){
        return view('myProject.history.addHistory');
    }

    public function addValidation(AddHistoryRequest $request){
        $validated = $request -> validated();
        if(!empty($validated)){
            DB::table('histories') -> insert([
                'title' => $validated['title'],
                'text' => $validated['text'],
                'author' => Auth::user() -> email,
                'date_of_made' => date("Y-m-d"),
            ]);

            $request->session()->flash('success', 'Ваша история будет добавлена после рассмотрения модератором');

            return redirect('add_history');
        }else {
            return redirect('showAddHistory') -> withInput();
        }

    }

    public function showUpdate($id){
        session() -> put('id', $id);
        return view('myProject.history.update');
    }

    public function makeUpdate(AddHistoryRequest $request){

         $validated = $request -> validated();

        if(!empty($validated)){
            DB::table('histories')-> where('id',session('id')) -> update([
                'title' => $validated['title'],
                'text' => $validated['text'],
                'author' => Auth::user() -> email,
                'date_of_update' => date("Y-m-d"),
            ]);

            $story = DB::table('histories')-> where('id',session('id')) -> first();
            // dd($story -> id );
            session()-> put('histori',[
                'title'=> $story -> id,
                'title'=> $story -> title,
                'text'=> $story -> text,
            ]);

            $request->session()->flash('success', 'Ваша история успешно обновлена');

            return redirect(url() -> previous());
        }else {
            return redirect('showAddHistory') -> withInput();
        }

    }

    public function deleteStory($id){
        DB::table('histories') -> where('id', $id) -> delete();
        return redirect(url()->previous());

    }

    public function historiesModeratorShow(){
        $histories = History::all();
        // dd($histories);
        return view('myProject.history.moderatorHistories', [
            'histories' => $histories,
        ]);
    }

    public function historyPublication($id){
        $histories = History::where('id',$id) -> update([
            'active' => 1,
        ]);
        return redirect() -> route('historiesModeratorShow');
    }

    public function historyCheck($id){
        $histories = History::where('id',$id) -> update([
            'active' => 0,
        ]);
        return redirect() -> route('historiesModeratorShow');
    }

    public function test(Request $request){
        // $token = $request->session()->token();

        // $token = csrf_token();
    //    return redirect() -> route('historiesModeratorShow');
        // return view('myProject.history.update');
        // dump('hello');
        // session() -> flush();
        // return view('product');
        // dd($request);
        // dd($_POST['firstName']);

        // $data = json_decode(file_get_contents("php://input"), TRUE);
        // $id = $data['id'];
        // dump($data);
        // $data = json_decode(file_get_contents("php://input"), TRUE);
        // $id = $data['id'];
        // dd($data);

        DB::table('cars') -> insert([
            'model' => $request -> text,
            'mechanic_id' => 1
        ]);
        return $request -> text;

    }
}
