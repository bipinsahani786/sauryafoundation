<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admit Card - {{ $admitCard->roll_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .admit-card {
            border: 2px solid #000;
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            color: #666;
        }
        .exam-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .exam-title span {
            background-color: #f3f4f6;
            padding: 8px 16px;
            border: 1px solid #ccc;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16px;
        }
        .content-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        .content-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            width: 150px;
            color: #555;
            text-transform: uppercase;
            font-size: 12px;
        }
        .value {
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }
        .photo-box {
            width: 100px;
            height: 120px;
            border: 1px dashed #999;
            text-align: center;
            line-height: 120px;
            font-size: 10px;
            color: #999;
            text-transform: uppercase;
            float: right;
            background-color: #f9f9f9;
        }
        .instructions {
            border-top: 2px solid #000;
            padding-top: 20px;
            margin-top: 20px;
        }
        .instructions h3 {
            margin-top: 0;
            font-size: 14px;
            text-transform: uppercase;
        }
        .instructions p {
            font-size: 12px;
            line-height: 1.5;
            white-space: pre-line;
        }
        .signatures {
            margin-top: 60px;
            width: 100%;
        }
        .sig-box {
            width: 45%;
            display: inline-block;
            text-align: center;
        }
        .sig-box.right {
            float: right;
        }
        .sig-line {
            border-bottom: 1px solid #000;
            width: 80%;
            margin: 0 auto 5px;
            height: 30px;
        }
        .sig-text {
            font-size: 10px;
            text-transform: uppercase;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="admit-card">
        <div class="header">
            {{-- Note: For DOMPDF to load local images reliably, often absolute path or public_path() is needed. --}}
            {{-- If an image exists, we could use <img src="{{ public_path('storage/'.($siteSettings['site_logo'] ?? '')) }}"> --}}
            <h1>{{ $siteSettings['site_name'] ?? 'Shaurya Narayan Foundation' }}</h1>
            <p>Official Examination Admit Card</p>
        </div>

        <div class="exam-title">
            <span>{{ $admitCard->exam_name }}</span>
        </div>

        <table class="content-table">
            <tr>
                <td style="width: 70%;">
                    <table style="width: 100%;">
                        <tr>
                            <td class="label">Candidate Name:</td>
                            <td class="value">{{ $admitCard->user->name }}</td>
                        </tr>
                        @if($admitCard->student_class)
                        <tr>
                            <td class="label">Class:</td>
                            <td class="value">{{ $admitCard->student_class }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="label">Roll Number:</td>
                            <td class="value">{{ $admitCard->roll_no }}</td>
                        </tr>
                        <tr>
                            <td class="label">Exam Date & Time:</td>
                            <td class="value">{{ $admitCard->exam_date->format('d F Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Examination Center:</td>
                            <td class="value">{{ $admitCard->exam_center }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 30%; text-align: right;">
                    <div class="photo-box">
                        Photo
                    </div>
                </td>
            </tr>
        </table>

        @if($admitCard->instructions)
        <div class="instructions">
            <h3>Important Instructions</h3>
            <p>{{ $admitCard->instructions }}</p>
        </div>
        @endif

        <div class="signatures">
            <div class="sig-box">
                <div class="sig-line"></div>
                <div class="sig-text">Candidate Signature</div>
            </div>
            <div class="sig-box right">
                <div class="sig-line"></div>
                <div class="sig-text">Authorized Signatory</div>
            </div>
        </div>
    </div>
</body>
</html>
