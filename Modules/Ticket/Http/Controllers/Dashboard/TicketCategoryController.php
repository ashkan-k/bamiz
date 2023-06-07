<?php

namespace Modules\Ticket\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticket\Entities\TicketCategory;
use Modules\Ticket\Http\Requests\TicketCategoryRequest;

class TicketCategoryController extends Controller
{
    use Responses;

    public function index()
    {
        return view('ticket::dashboard.ticket-category.list');
    }

    public function create()
    {
        return view('ticket::dashboard.ticket-category.form');
    }

    public function store(TicketCategoryRequest $request)
    {
        TicketCategory::create($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'ticket-categories.index');
    }

    public function edit(TicketCategory $ticket_category)
    {
        return view('ticket::dashboard.ticket-category.form', compact('ticket_category'));
    }

    public function update(TicketCategoryRequest $request, TicketCategory $ticket_category)
    {
        $ticket_category->update($request->all());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'ticket-categories.index');
    }
}
