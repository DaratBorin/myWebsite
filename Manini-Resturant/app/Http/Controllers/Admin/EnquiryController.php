<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::latest()->paginate(20);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function updateStatus(Request $request, Enquiry $enquiry)
    {
        $enquiry->update(['status' => $request->status]);
        return back()->with('success', 'Status updated.');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return back()->with('success', 'Enquiry deleted.');
    }
}