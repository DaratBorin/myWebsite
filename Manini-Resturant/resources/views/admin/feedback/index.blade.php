@extends('admin.layout')
@section('title', 'Feedback')
@section('breadcrumb', 'Feedback')

@section('content')
<div class="page-head">
    <div>
        <h1>Customer Feedback</h1>
        <div class="subtitle">{{ $feedbacks->total() }} total submissions</div>
    </div>
</div>

<div class="card">
    <div style="overflow-x:auto">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Rating</th>
                <th>Category</th>
                <th>Message</th>
                <th>Status</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $f)
            <tr>
                <td>
                    <div style="font-weight:500">{{ $f->name }}</div>
                    @if($f->email)
                    <div style="font-size:0.75rem;color:#8A7D6B">{{ $f->email }}</div>
                    @endif
                    <div style="font-size:0.72rem;color:#8A7D6B">{{ $f->created_at->format('M d, Y') }}</div>
                </td>
                <td>
                    <span style="color:#C9A84C;font-size:1rem;letter-spacing:0.1em">
                        {{ str_repeat('★', $f->rating) }}<span style="color:#E8DDD0">{{ str_repeat('★', 5 - $f->rating) }}</span>
                    </span>
                </td>
                <td><span class="badge badge-confirmed" style="text-transform:capitalize">{{ $f->category }}</span></td>
                <td style="max-width:300px">
                    <div style="font-size:0.82rem;color:#2D2416">{{ Str::limit($f->message, 80) }}</div>
                </td>
                <td>
                    <span class="badge {{ $f->status === 'new' ? 'badge-pending' : ($f->status === 'reviewed' ? 'badge-confirmed' : 'badge-completed') }}">
                        {{ ucfirst($f->status) }}
                    </span>
                </td>
                <td style="text-align:center">
                    <div style="display:inline-flex;gap:0.5rem">
                        @php
                            $statuses = ['new','reviewed','resolved'];
                            $current  = array_search($f->status, $statuses);
                            $next     = $statuses[($current + 1) % count($statuses)];
                        @endphp
                        <form action="{{ route('admin.feedback.status', $f) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="{{ $next }}">
                            <button type="submit" class="action-btn btn-primary">{{ ucfirst($next) }}</button>
                        </form>
                        <form action="{{ route('admin.feedback.destroy', $f) }}" method="POST" onsubmit="return confirm('Delete this feedback?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:3rem;color:#8A7D6B">No feedback yet</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div style="margin-top:1.5rem">{{ $feedbacks->links() }}</div>
@endsection