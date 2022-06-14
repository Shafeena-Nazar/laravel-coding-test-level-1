<?php

namespace App\Http\Controllers;

use App\Event;
use App\Mail\EventGenerated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    function events()
    {
        $events = Event::select('id', 'name', 'slug', 'createdAt')->get();
        $resultArray = [];
        foreach ($events as $event) {
            $resultArray[] = $event;
        }

        return json_encode(['events' => $resultArray, 'status' => 200]);
    }

    function activeEvents()
    {
        $events = Event::select('id', 'name', 'slug', 'createdAt')->where('createdAt', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('updatedAt', '>=', Carbon::now()->format('Y-m-d H:i:s'))->get();
        $resultArray = [];
        foreach ($events as $event) {
            $resultArray[] = $event;
        }

        return json_encode(['events' => $resultArray, 'status' => 200]);
    }

    function getEvent($id)
    {
        $event = Event::where('id', $id)->first();
        $resultArray = [
            'id' => $id,
            'name' => $event['name'],
            'slug' => $event['slug'],
            'createdAt' => $event['createdAt'],
        ];
        return json_encode(['event' => $resultArray, 'status' => 200]);
    }

    function saveEvents()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'slug' => 'required|unique:events',
        ]);
        if ($validator->fails())
            return response(['error' => $validator->messages()], 400);

        $uuid = Str::uuid()->toString();
        $isAdded = Event::insert([
            'id' => Str::uuid(),
            'name' => request()->input('name'),
            'slug' => request()->input('slug'),
            'createdAt' => Carbon::now(),
            'updatedAt' => Carbon::now(),
        ]);
        if ($isAdded) {
            $event = Event::where('id',$uuid)->first();
            Mail::to("shafeena.official@gmail.com")->send(new EventGenerated($event));
            return response(['message' => 'Event Saved', 'status' => 200], 200);
        }

        return response(['message' => 'Something went wrong', 'status' => 501], 501);
    }

    function addOrUpdateEvent($id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($validator->fails())
            return response(['error' => $validator->messages()], 400);


        $exists = Event::where('id', '<>', $id)->where('slug', request()->input('slug'))->exists();
        if ($exists) return response(['message' => 'Slug already exists', 'status' => 501], 501);

        $isUpdated = Event::where('id', $id)->update([
            'name' => request()->input('name'),
            'slug' => request()->input('slug'),
            'updatedAt' => Carbon::now(),
        ]);
        if ($isUpdated) {
            $event = Event::where('id',$id)->first();
            Mail::to("shafeena.official@gmail.com")->send(new EventGenerated($event));
            return response(['message' => 'Event Saved', 'status' => 200], 200);
        }

        return response(['message' => 'Something went wrong', 'status' => 501], 501);
    }

    function updateEvent($id)
    {
        if (!$id)
            return response(['message' => 'Please provide the id', 'status' => 501], 501);
        if (!request()->input('name') && !request()->input('slug'))
            return response(['message' => 'Please provide details to update', 'status' => 501], 501);
        if (request()->input('name'))
            $isUpdated = Event::where('id',$id)->update([
                'name' => request()->input('name')
            ]);

        if (request()->input('slug'))
            $isUpdated = Event::where('id', $id)->update([
                'slug' => request()->input('slug')
            ]);

        if ($isUpdated)
            return response(['message' => 'Event Saved', 'status' => 200], 200);

        return response(['message' => 'Something went wrong', 'status' => 501], 501);
    }

    function deleteEvent($id) {
        $isDeleted = Event::where('id',$id)->delete();

        if($isDeleted)
            return response(['message' => 'Event deleted', 'status' => 200], 200);

        return response(['message' => 'Something went wrong', 'status' => 501], 501);
    }

    function showAllEvents() {
        $endpoint = route('api.events');
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $endpoint);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        return view('events.allEvents', [ 'events' => json_decode($content)->events ]);
    }
}
