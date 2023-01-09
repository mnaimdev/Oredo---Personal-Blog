<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    function message_list()
    {
        $message_lists = Contact::all();
        return view('admin.subscribe.message_list', [
            'message_lists' => $message_lists,
        ]);
    }

    function subscription_list()
    {
        $subsciption_lists = Subscribe::all();
        return view('admin.subscribe.subscription_list', [
            'subsciption_lists' => $subsciption_lists,
        ]);
    }
}
