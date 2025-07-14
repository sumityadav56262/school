@extends('layout')

@section('content')
<style>
    .invoice-print-page * {
        all: revert;
    }

    .invoice-print-page {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        max-width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }

    .invoice-container {
        font-family: 'Times New Roman', serif;
        background-color: #fff;
        border: 1px solid #000;
        padding: 20px 30px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        font-size: 13px;
    }

    .invoice-header {
        text-align: center;
        margin-bottom: 10px;
    }

    .invoice-header h1 {
        font-size: 20px;
        font-weight: bold;
    }

    .invoice-header p {
        font-size: 12px;
        margin: 2px 0;
    }
    .invoice-line {
        border-top: 2px solid #000;
        margin: 10px 0;
    }

    .invoice-meta, .student-info {
        font-size: 13px;
        margin-bottom: 5px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        margin-bottom: 10px;
    }

    .invoice-table th, .invoice-table td {
        border: 1px solid #000;
        padding: 4px 6px;
    }

    .summary-table {
        width: 100%;
        margin-top: 10px;
        font-size: 13px;
    }

    .summary-table td {
        padding: 3px;
    }

    .summary-table td:last-child {
        text-align: right;
        font-weight: bold;
    }

    .signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        font-size: 12px;
    }

    .signature-block {
        text-align: center;
        width: 45%;
    }

    .signature-line {
        border-bottom: 1px solid #000;
        width: 100px;
        margin: 8px auto 4px auto;
    }

    .no-print {
        margin: 20px auto;
        text-align: center;
    }
    p {
        margin: 0 !important;
    }
    @media print {
        .no-print {
            display: none !important;
        }

        body * {
            visibility: hidden;
        }

        .invoice-print-page, .invoice-print-page * {
            visibility: visible;
        }

        .invoice-print-page {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
            grid-template-columns: 1fr 1fr;
        }

        @page {
            size: A4 landscape;
            margin: 10mm;
        }
    }
</style>

<div class="invoice-print-page" id="invoice-content">
    @for ($i = 0; $i < 2; $i++)
        <div class="invoice-container">
            <div class="invoice-header">
                <h1 style="margin: 0 !important;">SAPIENCE ACADEMY</h1>
                <p>Lalbandi Municipality-7, Sarlahi</p>
                <p>EST: 2075</p>
                <p style="font-size: 18px;">TAX INVOICE<p>
                <div class="invoice-line"></div>
            </div>

            <div class="invoice-meta d-flex justify-content-between">
                <div><strong>Inv. No:</strong> {{ $studentFee->id }}</div>
                <div class="text-end"><strong>Date:</strong> {{ \Carbon\Carbon::parse($studentFee->created_at)->format('Y-m-d') }}</div>
            </div>

            <div class="student-info d-flex flex-column margin: 0;">
                <p><strong>Name:</strong> {{ optional($studentFee->student)->stud_name ?? 'N/A' }}</p>
                <div class="d-flex justify-content-between">
                    <p><strong>Class:</strong> {{ $studentFee->student->class_name ?? 'N/A' }}</p>
                    <p><strong>Roll No:</strong> {{ optional($studentFee->student)->roll_no ?? 'N/A' }}</p>
                </div>
            </div>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Particular</th>
                        <th>Amount</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $fees = [
                            'Yearly Fee' => $studentFee->yearly_fee,
                            'Monthly Fee' => $studentFee->monthly_fee,
                            'Exam Fee' => $studentFee->exam_fee,
                            'Tie/Belt Fee' => $studentFee->tie_belt_fee,
                            'School Vest' => $studentFee->vest_fee,
                            'Game Pant' => $studentFee->game_fee,
                            'Trouser' => $studentFee->trouser_fee,
                            'Computer Fee' => $studentFee->computer_fee,
                            'ECA Fee' => $studentFee->eca_fee,
                            'Misc. Fee' => $studentFee->misc_fee,
                            'Previous Dues' => $studentFee->recurring_dues,
                        ];
                        $sr = 1;
                    @endphp
                    @foreach ($fees as $name => $amount)
                        @if ($amount > 0)
                        <tr>
                            <td style="text-align: center;">{{ $sr++ }}</td>
                            <td>{{ $name }}</td>
                            <td style="text-align: right;">{{ number_format($amount, 0) }}</td>
                            <td></td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <table class="summary-table">
                <tbody>
                    <tr><td>Total:</td><td>{{ number_format($studentFee->total_amt ?? 0, 0) }}</td></tr>
                    <tr><td>Discount:</td><td>{{ number_format($studentFee->discount_amt ?? 0, 0) }}</td></tr>
                    <tr><td>Paid:</td><td>{{ number_format($studentFee->payment_amt ?? 0, 0) }}</td></tr>
                    <tr><td>Dues:</td><td>{{ number_format($studentFee->dues_amt ?? 0, 0) }}</td></tr>
                </tbody>
            </table>

            <div class="signature-section">
                <div class="signature-block">
                    <p>{{ $studentFee->received_by ?? 'Received By' }}</p>
                    <div class="signature-line"></div>
                    <p>Received By</p>
                </div>
                <div class="signature-block">
                    <p>{{ $studentFee->payment_by ?? 'Payment By' }}</p>
                    <div class="signature-line"></div>
                    <p>Payment By</p>
                </div>
            </div>
        </div>
    @endfor
</div>

<div class="no-print">
    <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
</div>
@endsection
