@extends('admin.layout')
@section('title', 'Enquiries')
@section('breadcrumb', 'Enquiries')

@section('content')
<div class="page-head">
    <div>
        <h1>Enquiries</h1>
        <div class="subtitle">{{ $enquiries->total() }} total messages</div>
    </div>
</div>

<div class="card">
    <div style="overflow-x:auto">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Status</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enquiries as $e)
            <tr>
                <td style="font-weight:500">{{ $e->first_name }} {{ $e->last_name }}</td>
                <td style="font-size:0.82rem;color:#8A7D6B">{{ $e->email }}</td>
                <td>
                    @if($e->subject)
                    <span class="badge badge-confirmed" style="text-transform:capitalize">{{ $e->subject }}</span>
                    @else
                    <span style="color:#8A7D6B">—</span>
                    @endif
                </td>
                <td style="max-width:280px;font-size:0.82rem">{{ Str::limit($e->message, 80) }}</td>
                <td style="font-size:0.78rem;color:#8A7D6B">{{ $e->created_at->format('M d, Y') }}</td>
                <td>
                    <span class="badge {{ $e->status === 'new' ? 'badge-pending' : ($e->status === 'read' ? 'badge-confirmed' : 'badge-completed') }}">
                        {{ ucfirst($e->status) }}
                    </span>
                </td>
                <td style="text-align:center">
                    <div style="display:inline-flex;gap:0.5rem">
                        @php
                            $statuses = ['new','read','replied'];
                            $current  = array_search($e->status, $statuses);
                            $next     = $statuses[($current + 1) % count($statuses)];
                        @endphp
                        <form action="{{ route('admin.enquiries.status', $e) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="{{ $next }}">
                            <button type="submit" class="action-btn btn-primary">{{ ucfirst($next) }}</button>
                        </form>
                        <form action="{{ route('admin.enquiries.destroy', $e) }}" method="POST" onsubmit="return confirm('Delete this enquiry?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:3rem;color:#8A7D6B">No enquiries yet</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div style="margin-top:1.5rem">{{ $enquiries->links() }}</div>
@endsection