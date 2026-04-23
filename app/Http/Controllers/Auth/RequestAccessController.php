<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestAccessRequest;
use App\Notifications\RequestAccessNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Inertia\Response;

class RequestAccessController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('auth/Register');
    }

    public function store(RequestAccessRequest $request): RedirectResponse
    {
        $adminEmail = config('mail.from.address');

        Notification::route('mail', $adminEmail)
            ->notify(new RequestAccessNotification(
                name: $request->validated('name'),
                email: $request->validated('email'),
                company: $request->validated('company'),
                message: $request->validated('message'),
            ));

        return back()->with('status', 'Sua solicitação foi enviada! Entraremos em contato em breve.');
    }
}
