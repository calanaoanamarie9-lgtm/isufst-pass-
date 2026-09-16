@extends('emails.layouts.app')

@section('content')

    <p style="margin:0 0 16px;font-size:15px;font-weight:bold;color:#111827;">
        Hello {{ $documentRequest->user->name }},
    </p>

    <p style="margin:0 0 18px;font-size:14px;line-height:1.8;color:#374151;">
        Your document request <strong>{{ $documentRequest->request_number }}</strong>
        (<strong>{{ $documentRequest->documentsSummary() }}</strong>) was successfully claimed on
        <strong>{{ $documentRequest->completed_at?->format('F j, Y') ?? now()->format('F j, Y') }}</strong>.
    </p>

    @include('emails.partials.badge', ['slot' => 'Transaction Completed', 'bg' => '#dcfce7', 'text' => '#166534'])

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:24px;border-collapse:collapse;">
        @include('emails.partials.row', ['label' => 'Request Number', 'value' => $documentRequest->request_number])
        @include('emails.partials.row', ['label' => 'Document(s)', 'value' => $documentRequest->documentsSummary()])
        @include('emails.partials.row', ['label' => 'Date Claimed', 'value' => $documentRequest->completed_at?->format('F j, Y g:i A')])
    </table>

    @component('emails.partials.notice', [
        'titleText' => 'SECURITY NOTICE',
        'bg' => '#fef2f2',
        'border' => '#dc2626',
        'title' => '#b91c1c',
    ])
        If you did <strong>not</strong> authorize this transaction, please contact the Registrar's Office immediately.
    @endcomponent

@endsection
