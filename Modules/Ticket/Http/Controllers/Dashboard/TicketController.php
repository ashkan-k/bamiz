<?php

namespace Modules\Ticket\Http\Controllers\Dashboard;

use App\Http\Traits\Helpers;
use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Http\Requests\TicketRequest;

class TicketController extends Controller
{
    use Responses, Uploader, Helpers;

    public function index()
    {
        return view('ticket::dashboard.ticket.list');
    }

    public function create()
    {
        return view('ticket::dashboard.ticket.form');
    }

    public function store(TicketRequest $request)
    {
        $file = $this->UploadFile($request, 'file', 'ticket_files', auth()->id());

        auth()->user()->tickets()->create(array_merge($request->except(['status']), ['file' => $file]));
        return $this->SuccessRedirect('تیکت شما با موفقیت ثبت شد.', 'tickets.index');
    }

    public function edit(Ticket $ticket)
    {
        if (auth()->user()->level != 'admin') {
            $this->check_myself_queryset($ticket, 'web');
        }
        return view('ticket::dashboard.ticket.form', compact('ticket'));
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        if (auth()->user()->level != 'admin') {
            $this->check_myself_queryset($ticket, 'web');
        }
        $file = $this->UploadFile($request, 'file', 'ticket_files', auth()->id(), $ticket->file);

        $ticket->update(array_merge($request->except(['status', 'user_id']), ['file' => $file]));
        return $this->SuccessRedirect('تیکت شما با موفقیت ویرایش شد.', 'tickets.index');
    }
}
