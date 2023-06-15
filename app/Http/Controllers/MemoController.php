<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Memo;
use App\Http\Requests\MemoRequest;
use DateTime;

class MemoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $memos = Memo::where('user_id',$userId)->get();
        $formattedMemos = $memos->map(function ($memo) {
            $memo->formated_created_at = (new DateTime($memo->created_at))->format('Y-m-d');
            $memo->formated_updated_at = (new DateTime($memo->updated_at))->format('Y-m-d');
        return $memo;
        });

        
        return view('index',[
            'memos' => $formattedMemos
        ]);
    }

    public function store(MemoRequest $request)
    {
        $userId = Auth::id();
        $text = $request->text;

        Memo::create([
            'user_id' => $userId,
            'text' => $text,
        ]);
        return redirect('/top');
    }

    public function edit($id)
    {
        if($id) {
            $memo = Memo::select('id','text')->find($id);
            return view('edit',compact('memo'));
        } else {
            return redirect('/top');
        }
    }
    
    public function update(MemoRequest $request)
    {
            Memo::find($request->id)->update([
                'text' => $request->text
            ]);
            return redirect('/top');
    }

    public function delete($id)
    {
        if($id) {
            Memo::find($id)->delete();
            return back();
        } else {
            return back();
        }
    }
}
