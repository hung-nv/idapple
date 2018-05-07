<?php

namespace App\Http\Controllers\Backend;

use App\Models\Youtube;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class YoutubeController extends Controller
{
    public function create() {
        return view('backend.youtube.create');
    }

    public function store(Request $request) {
        $messsages = [
            'channel_id.required'=>'Channel url not valid or it seem not be a channel url',
            'channel_id.unique'=>'This channel has already taken'
        ];

        $validator = Validator::make($request->all(), [
            'channel_url' => 'required|url',
            'channel_name' => 'required',
            'channel_id' => 'required|unique:youtube,channel_id'
        ], $messsages);

        if ($validator->fails()) {
            return redirect('/admin/youtube/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $channel = new Youtube();
            $channel->channel_id = $request['channel_id'];
            $channel->channel_name = $request['channel_name'];
            $channel->channel_description = $request['channel_description'];
            $channel->channel_logo = $request['channel_logo'];
            $channel->user_id = Auth::user()->id;

            if ($channel->save())
                return redirect()->route('youtube.index')->with(['success_message' => 'Your channel has been add!']);
        }
    }

    public function index() {
        $data = Youtube::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('backend.youtube.index', [
            'data' => $data
        ]);
    }

    public function edit($id) {
        $youtube = Youtube::findOrFail($id);
        return view('backend.youtube.update', [
            'youtube' => $youtube
        ]);
    }

    public function update(Request $request, $id) {
        $channel = Youtube::findOrFail($id);

        $messsages = [
            'channel_id.required'=>'Channel url not valid or it seem not be a channel url',
            'channel_id.unique'=>'This channel has already taken'
        ];

        Validator::make($request->all(), [
            'channel_url' => 'required|url',
            'channel_name' => 'required',
            'channel_id' => 'required|unique:youtube,channel_id,' . $request->segment(3)
        ], $messsages)->validate();

        $channel->channel_id = $request['channel_id'];
        $channel->channel_name = $request['channel_name'];
        $channel->channel_description = $request['channel_description'];
        $channel->channel_logo = $request['channel_logo'];

        if ($channel->save())
            return redirect()->route('youtube.index')->with(['success_message' => 'Your channel has been updated!']);
    }

    public function destroy($id) {
        $channel = Youtube::findOrFail($id);

        if ($channel->delete()) {
            Session::flash('success_message', 'Your channel has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete channel');
        }
        return redirect('/admin/youtube');
    }

    public function show($id) {
        $channel = Youtube::findOrFail($id);
        return view('backend.youtube.show', [
            'channel' => $channel
        ]);
    }
}
