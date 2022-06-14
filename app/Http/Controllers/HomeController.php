<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\EventGenerated;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function events(Request $request)
    {
        $data = [
            'events' => Event::orderBy('createdAt', 'DESC')->paginate(10),
        ];

        return view('events.list', $data);
    }

    public function newEvent(Request  $request) {
        if(!$request->input())
            return view('events.create');
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:events',
        ]);
        $uuid = Str::uuid()->toString();
        $isAdded = Event::insert([
            'id' => $uuid,
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'createdAt' => Carbon::now(),
            'updatedAt' => Carbon::now(),
        ]);
        if($isAdded) {
            $event = Event::where('id',$uuid)->first();
            Mail::to("shafeena.official@gmail.com")->send(new EventGenerated($event));
            return  redirect()->back()->with('success','Event Saved');
        }

        return  redirect()->back()->with('error','Something went wrong');
    }

    function editEvent($id) {
        if(!$id) return redirect()->back()->with('error','Something went wrong');
        $event = Event::where('id',$id)->first();

        return view('events.create',[
            'id' => $id,
            'event' => $event
        ]);
    }

    function updateEvent(Request $request) {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $exists = Event::where('id','<>',$request->input('id'))->where('slug',$request->input('slug'))->exists();
        if($exists) redirect()->back()->with('error','Slug already exists');
        $isUpdated = Event::where('id',$request->input('id'))->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'updatedAt' => Carbon::now(),
        ]);
        if($isUpdated)
            return  redirect()->back()->with('success','Event Saved');

        return  redirect()->back()->with('error','Something went wrong');
    }

    function deleteEvent(Request $request) {
        $id = $request->input('id');
        $isDeleted = Event::where('id',$request->input('id'))->delete();

        if($isDeleted)
            return json_encode([ 'status' => 1]);

        return json_encode([ 'status' => 0]);
    }

    public function logout()
    {
        \Auth::logout();
        session_unset();
        return redirect()->route('index');
    }

}
