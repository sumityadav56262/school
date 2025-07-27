@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}">

    <div class="invoice-print-page" id="invoice-content">
        @for ($i = 0; $i < 2; $i++)
            <div class="invoice-container">
                <div class="invoice-header">
                    <h1 style="margin: 0 !important;">SAPIENCE ACADEMY</h1>
                    <p>Lalbandi Municipality-7, Sarlahi</p>
                    <p>EST: 2075</p>
                    <p style="font-size: 18px;">TAX INVOICE
                    <p>
                    <div class="invoice-line"></div>
                </div>

                <div class="invoice-meta d-flex justify-content-between">
                    <div><strong>Inv. No:</strong> {{ $studentFee->invoice_no }}</div>
                    <div class="text-end"><strong>Date:</strong>
                        {{ \Carbon\Carbon::parse($studentFee->created_at)->format('Y-m-d') }}</div>
                </div>

                <div class="student-info d-flex flex-column margin: 0;">
                    <p><strong>Name:</strong> {{ optional($studentFee->student)->stud_name ?? 'N/A' }}</p>
                    <div class="d-flex justify-content-between">
                        <p><strong>Class:</strong> {{ $studentFee->student->class->class_name ?? 'N/A' }}</p>
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
                                // 'Recurring Dues' => $studentFee->recurring_dues,
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
                        <tr>
                            <td>Total:</td>
                            <td>{{ number_format($studentFee->total_amt ?? 0, 0) }}</td>
                        </tr>
                        <tr>
                            <td>Paid:</td>
                            <td>{{ number_format($studentFee->payment_amt ?? 0, 0) }}</td>
                        </tr>
                        <tr>
                            <td>Discount:</td>
                            <td>{{ number_format($studentFee->discount_amt ?? 0, 0) }}</td>
                        </tr>
                        <tr>
                            <td>Dues:</td>
                            <td>{{ number_format($studentFee->dues_amt ?? 0, 0) }}</td>
                        </tr>
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
        <button onclick="window.print()" class="btn btn-success"> <i class="fas fa-print"></i>Print</button>
    </div>
@endsection
