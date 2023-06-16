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

        
        return view('home',[
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
        return redirect('/home')->with('success_message', 'メモを作成しました');
    }

    public function edit(Request $request)
    {
        if($request->id) {
            if($request->input('back') == 'back') {
            return redirect('/home')->withInput();
            }

            $memo = Memo::select('id','text')->find($request->id);
            return view('edit',compact('memo'));
        } else {
            return redirect('/home');
        }
    }
    
    public function update(MemoRequest $request)
    {
            Memo::find($request->id)->update([
                'text' => $request->text
            ]);
            return redirect('/home')->with('success_message', 'メモを変更しました');
    }

    public function delete($id)
    {
        if($id) {
            Memo::find($id)->delete();
            return back()->with('success_message', 'メモを削除しました');
        } else {
            return back();
        }
    }
}
