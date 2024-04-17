<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function expenses(Request $request)
    {
        $expensesQuery =  Expense::OfSearch($request->search)->OfDateRange($request->dateRange, $request->customStartDate, $request->customEndDate)->latest();
        $expenses = $expensesQuery->paginate(10);

        return response()->json($expenses, 200);
    }
    public function downloadExpenses(Request $request)
    {
        $expenses = Expense::OfSearch($request->search)
            ->OfDateRange($request->dateRange, $request->customStartDate, $request->customEndDate)
            ->latest()
            ->get();
        $data = ['expenses' => $expenses];
        $pdf = Pdf::loadView('pdf.expenses', $data);
        return $pdf->download('expenses.pdf');
    }

    public function invoices(Request $request)
    {
        $invoices = Invoice::OfUser($request->user_id)
            ->OfSearch($request->search)
            ->OfStatus($request->status)
            ->OfDateRange($request->dateRange, $request->customStartDate, $request->customEndDate)
            ->withCount('invoiceItems')
            ->latest()
            ->paginate(10);
        $totalSumInvoice = $invoices->sum('totalAmount');
        $totalitems = $invoices->sum(function ($invoice) {
            return $invoice->invoiceItems->sum('quantity');
        });
        $totalSumDiscount = $invoices->sum('discount');
        return response()->json([
            'invoices' => $invoices,
            'users' => User::all('id', 'name'),
            'totalSumInvoice' => $totalSumInvoice,
            'totalitems' => $totalitems,
            'totalSumDiscount' => $totalSumDiscount
        ], 200);
    }


    public function downloadInvoices(Request $request)
    {
        $note = $request->note;
        $isShowItem = $request->isShowItem;
        $invoices = Invoice::OfUser($request->user_id)
            ->OfSearch($request->search)
            ->OfStatus($request->status)
            ->OfDateRange($request->dateRange, $request->customStartDate, $request->customEndDate)
            ->with(['invoiceItems'])
            ->latest()
            ->get();

        $totalSumInvoice = $invoices->sum('totalAmount');
        $totalitems = $invoices->sum(function ($invoice) {
            return $invoice->invoiceItems->sum('quantity');
        });
        $totalSumDiscount = $invoices->sum('discount');
        $data = [
            'note' => $note,
            'isShowItem' => $isShowItem,
            'invoices' => $invoices,
            'totalSumInvoice' => $totalSumInvoice,
            'totalitems' => $totalitems,
            'totalSumDiscount' => $totalSumDiscount
        ];
        $pdf = Pdf::loadView('pdf.invoices', $data);
        return $pdf->download('invoices.pdf');
    }
}
