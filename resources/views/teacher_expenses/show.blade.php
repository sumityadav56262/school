@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}">

    <div class="invoice-print-page" id="invoice-content">
        <div class="invoice-container">
            <div class="invoice-header">
                <div class="d-flex align-items-center justify-content-center position-relative">
                    <div class="logo"><img src="{{ asset('images/logo.jpg') }}" alt="" srcset=""></div>
                    <div class="z-1 text-center">
                        <h1 style="margin: 0 !important;">SAPIENCE ACADEMY</h1>
                        <p>Lalbandi Municipality-7, Sarlahi</p>
                        <p>EST: 2075</p>
                        <p style="font-size: 18px;">TAX INVOICE
                        <p>
                    </div>
                </div>
                <div class="invoice-line"></div>
            </div>
            <style>

            </style>
            <div class="invoice-meta d-flex justify-content-between">
                <div><strong>Inv. No:</strong> {{ $teacherExpense->invoice_no }}</div>
                <div class="text-end"><strong>Date:</strong>
                    {{ $createdAt }}</div>
            </div>

            <div class="student-info d-flex flex-column margin: 0;">
                <p><strong>Teacher Name:</strong> {{ optional($teacherExpense->teacher)->teacher_name ?? 'N/A' }}</p>
            </div>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Particular</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sr = 1;
                    @endphp
                    @if ($teacherExpense->salary_amt)
                        <tr>
                            <td style="text-align: center;">{{ $sr++ }}</td>
                            <td>{{ $teacherExpense->remark }}</td>
                            <td style="text-align: left;">{{ number_format($teacherExpense->paid_amt, 0) }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <table class="summary-table">
                <tbody>
                    <tr>
                        <td>Total:</td>
                        <td></td>
                        <td>{{ number_format($teacherExpense->salary_amt ?? 0, 0) }}</td>
                    </tr>
                    <tr>
                        <td>Dues:</td>
                        <td></td>
                        <td>{{ number_format($teacherExpense->due_amt ?? 0, 0) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="signature-section">
                <div class="signature-block">
                    <p>{{ $teacherExpense->teacher->teacher_name ?? 'Received By' }}</p>
                    <div class="signature-line"></div>
                    <p>Received By</p>
                </div>
                <div class="signature-block">
                    <p>{{ $teacherExpense->paid_by ?? 'Payment By' }}</p>
                    <div class="signature-line"></div>
                    <p>Payment By</p>
                </div>
            </div>
        </div>
    </div>

    <div class="no-print">
        <button onclick="window.print()" class="btn btn-success"> <i class="fas fa-print"></i>Print</button>
    </div>
@endsection
