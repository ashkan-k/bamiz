<?php

namespace Modules\Ticket\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticket\Http\Requests\TicketRequest;

class TicketController extends Controller
{
    use Responses, Uploader;

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

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ticket::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
