<div>
@php
    use Illuminate\Support\Facades\Storage;
    $receiptType = $type === 'in' ? 'Receipt In' : ($type === 'out' ? 'Receipt Out' : 'Receipt Voucher');

    // Dynamic labels based on receipt type
    $label_en = $type === 'out' ? 'Paied to Mr./ Ms' : 'Received from Mr./ Ms';
    $label_ar = $type === 'out' ? 'سلمنا الى الساده/ السيد' : 'أستلمنا من الساده/ السيد';
@endphp

{{--    <!DOCTYPE html>--}}
{{--<html lang="en" dir="ltr">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Receipt Print</title>--}}
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            margin: 30px;
        }
        .show_print {
            display: inline-block !important;
        }
        table {
            width: 100% !important;
            border-collapse: collapse;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
        @page { size: auto;  margin: 5mm; }
    </style>
{{--</head>--}}
{{--<body  >--}}


<style>
    .watermark-text-top {
        position: absolute;
        top: 25%;
        left: 49%;
        transform: translate(-74%, -57%) rotate(-30deg);
        font-size: 100px;
        color: rgba(0, 0, 0, 0.03); /* Light gray transparent */
        pointer-events: none; /* Prevent interaction */
        white-space: nowrap;
        z-index: 0;
    }
    .watermark-text {
        position: absolute;
        top: 65%;
        left: 49%;
        transform: translate(-74%, -57%) rotate(-30deg);
        font-size: 100px;
        color: rgba(0, 0, 0, 0.03); /* Light gray transparent */
        pointer-events: none; /* Prevent interaction */
        white-space: nowrap;
        z-index: 0;
    }


</style>

@if($receipt->printed=='yes') <div class="watermark-text-top">صورة  Copy</div> @endif
<table>
    <thead>
    <tr>
        <th colspan="9" style="text-align:center;color:#000;padding-bottom:8px;">
            <div style="float:right;width:34%;text-align:right;font-size:12px" class="show_print">
                <br>
                <span style="font-weight:bold;color:#B8741A;font-size:15px">{{ $settings->name }}</span><br>
                {{ $settings->address }}<br>
                {{ $settings->phone }} | {{ $settings->fax }}<br>
                {{ $settings->email }}
            </div>

            <div style="float:right;width:33%;text-align:center;font-size:12px" class="show_print">
                @if($settings->logo)
                    <img style="width:70px" src="{{ asset($settings->logo) }}" alt="Logo"><br>
                @endif

                <b style="font-size:14px">{{ $receiptType }}</b>
            </div>

            <div style="float:right;width:33%;text-align:left;font-size:12px" class="show_print">
                <br>
                <span style="font-weight:bold;color:#B8741A;font-size:14px">{{ $settings->name_EN }}</span><br>
                {{ $settings->address_EN }}<br>
                {{ $settings->phone }} | {{ $settings->fax }}<br>
                {{ $settings->email }}
            </div>
        </th>
    </tr>

    <tr>
        <td style="text-align:left; font-size: 17px;">
            No. <span style="color:#cc0000;font-weight:bold">REC-{{ $receipt->Rid }}</span>
            <span style="float:right">Date: {{ \Carbon\Carbon::parse($receipt->Rcreated_date)->format('d-m-Y') }}</span>
        </td>
    </tr>

    <tr><td style="border-bottom:1px #ccc solid;"></td></tr>

    <tr>
        <td style="text-align:left;padding-top:15px;">
            <div style="width:100px;padding:3px;border:1px #ccc solid;text-align:center;float:left">
                {{ number_format($receipt->amount, 2) }}
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <br>
            <table style="width:100%;direction:ltr;" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width:25%;padding-left:20px;text-align: left; font-weight: 600;">{{ $label_en }}</td>
                    <td style="width:50%;text-align:center;border-bottom:1px #ccc dotted;" class="text-capitalize">
                        {{ $receipt->name ?? 'N/A' }}
                    </td>
                    <td style="width:25%;text-align:right;font-weight: 600;">{{ $label_ar }}</td>
                </tr>

                <tr>
                    <td style="width:25%;padding-left:20px;padding-top:20px;text-align: left;font-weight: 600;">
                        <span style="font-weight:bold;font-size:14px;">The Sum of EGP</span>
                    </td>

                    <td style="width:50%;text-align:center;border-bottom:1px #ccc dotted;padding-top:10px">
                        <span style="display: inline-block; text-align: center;">
                            جنيه {{ number_format($receipt->amount, 2) }}
                        </span><br>
                    </td>

                    <td style="width:25%; text-align:right; font-weight:bold; font-size:14px; direction:rtl;">
                        مبلغ وقدره <br>
                    </td>
                </tr>

                <tr>
                    <td style="width:25%;padding-left:20px;padding-top:20px;text-align: left;font-weight: 600;">Being</td>
                    <td style="width:50%;text-align:center;border-bottom:1px #ccc dotted;padding-top:10px">
                        {{-- Show notes if available --}}
                        {{ $receipt->notes ?? '' }}
                        <br>
                        @if($receipt->acc_detail_type === 'Flight Invoice')
                            ({{ $receipt->invoice?->client?->name ?? '' }} - {{ $receipt->invoice?->inv_code ?? '' }})
                        @else
                            ({{ $receipt->guestFile->Fcode ?? '' }} - {{ $receipt->guestFile->Fname ?? '' }})
                        @endif
                    </td>

                    <td style="width:25%;text-align:right;font-weight: 600;">وذلك عن</td>
                </tr>
                <tr>
                    <td style="width:25%;padding-left:20px;padding-top:20px;text-align: left;font-weight: 600;">Account</td>
                    <td style="width:50%;text-align:center;border-bottom:1px #ccc dotted;padding-top:10px">
                        {{ $receipt->accountant?->name ?? '' }}
                    </td>

                    <td style="width:25%;text-align:right;font-weight: 600;">الحساب</td>
                </tr>
                <tr>
                    <td style="width:25%;padding-left:20px;padding-top:20px;text-align: left;font-weight: 600;">File / Invoice  </td>
                    <td style="width:50%;text-align:center;border-bottom:1px #ccc dotted;padding-top:10px">
                        @if($receipt->acc_detail_type === 'Flight Invoice')
                            ({{ $receipt->invoice?->client?->name ?? '' }} - {{ $receipt->invoice?->inv_code ?? '' }})
                        @else
                            ({{ $receipt->guestFile->Fcode ?? '' }} - {{ $receipt->guestFile->Fname ?? '' }})
                        @endif
                    </td>
                    <td style="width:25%;text-align:right;font-weight: 600;">ملف / فاتورة</td>
                </tr>
            </table>
            <br>
        </td>
    </tr>

    <tr><td style="border-bottom:1px #ccc solid;"></td></tr>

    <tr>
        <td style="text-align:center;color:#000;padding-top:20px">
            <span style="font-size:14px;">Thank you for the payment you made.</span><br>
            <span style="color:#FF0000;">This is an electronically generated receipt, hence does not require a signature or stamp</span>
        </td>
    </tr>

    <tr><td style="text-align:left;border-bottom:1px #ccc solid;"></td></tr>
    </thead>
</table>













<br><br><br><br><br>








<div class="watermark-text">صورة  Copy</div>
<table>
    <thead>
    <tr>
        <th colspan="9" style="text-align:center;color:#000;padding-bottom:8px;">
            <div style="float:right;width:34%;text-align:right;font-size:12px" class="show_print">
                <br>
                <span style="font-weight:bold;color:#B8741A;font-size:15px">{{ $settings->name }}</span><br>
                {{ $settings->address }}<br>
                {{ $settings->phone }} | {{ $settings->fax }}<br>
                {{ $settings->email }}
            </div>

            <div style="float:right;width:33%;text-align:center;font-size:12px" class="show_print">
                @if($settings->logo)
                    <img style="width:70px" src="{{ asset($settings->logo) }}" alt="Logo"><br>
                @endif

                <b style="font-size:14px">{{ $receiptType }}</b>
            </div>

            <div style="float:right;width:33%;text-align:left;font-size:12px" class="show_print">
                <br>
                <span style="font-weight:bold;color:#B8741A;font-size:14px">{{ $settings->name_EN }}</span><br>
                {{ $settings->address_EN }}<br>
                {{ $settings->phone }} | {{ $settings->fax }}<br>
                {{ $settings->email }}
            </div>
        </th>
    </tr>

    <tr>
        <td style="text-align:left; font-size: 17px;">
            No. <span style="color:#cc0000;font-weight:bold">REC-{{ $receipt->Rid }}</span>
            <span style="float:right">Date: {{ \Carbon\Carbon::parse($receipt->Rcreated_date)->format('d-m-Y') }}</span>
        </td>
    </tr>

    <tr><td style="border-bottom:1px #ccc solid;"></td></tr>

    <tr>
        <td style="text-align:left;padding-top:15px;">
            <div style="width:100px;padding:3px;border:1px #ccc solid;text-align:center;float:left">
                {{ number_format($receipt->amount, 2) }}
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <br>
            <table style="width:100%;direction:ltr;" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width:25%;padding-left:20px;text-align: left; font-weight: 600;">{{ $label_en }}</td>
                    <td style="width:50%;text-align:center;border-bottom:1px #ccc dotted;" class="text-capitalize">
                        {{ $receipt->name ?? 'N/A' }}
                    </td>
                    <td style="width:25%;text-align:right;font-weight: 600;">{{ $label_ar }}</td>
                </tr>

                <tr>
                    <td style="width:25%;padding-left:20px;padding-top:20px;text-align: left;font-weight: 600;">
                        <span style="font-weight:bold;font-size:14px;">The Sum of EGP</span>
                    </td>

                    <td style="width:50%;text-align:center;border-bottom:1px #ccc dotted;padding-top:10px">
                        <span style="display: inline-block; text-align: center;">
                            جنيه {{ number_format($receipt->amount, 2) }}
                        </span><br>
                    </td>

                    <td style="width:25%; text-align:right; font-weight:bold; font-size:14px; direction:rtl;">
                        مبلغ وقدره <br>
                    </td>
                </tr>

                <tr>
                    <td style="width:25%;padding-left:20px;padding-top:20px;text-align: left;font-weight: 600;">Being</td>
                    <td style="width:50%;text-align:center;border-bottom:1px #ccc dotted;padding-top:10px">
                        {{-- Show notes if available --}}
                        {{ $receipt->notes ?? '' }}
                        <br>
                        @if($receipt->acc_detail_type === 'Flight Invoice')
                            ({{ $receipt->invoice?->client?->name ?? '' }} - {{ $receipt->invoice?->inv_code ?? '' }})
                        @else
                            ({{ $receipt->guestFile->Fcode ?? '' }} - {{ $receipt->guestFile->Fname ?? '' }})
                        @endif
                    </td>

                    <td style="width:25%;text-align:right;font-weight: 600;">وذلك عن</td>
                </tr>
            </table>
            <br>
        </td>
    </tr>

    <tr><td style="border-bottom:1px #ccc solid;"></td></tr>

    <tr>
        <td style="text-align:center;color:#000;padding-top:20px">
            <span style="font-size:14px;">Thank you for the payment you made.</span><br>
            <span style="color:#FF0000;">This is an electronically generated receipt, hence does not require a signature or stamp</span>
        </td>
    </tr>

    <tr><td style="text-align:left;border-bottom:1px #ccc solid;"></td></tr>
    </thead>
</table>

</div>
{{--</body>--}}
{{--</html>--}}
