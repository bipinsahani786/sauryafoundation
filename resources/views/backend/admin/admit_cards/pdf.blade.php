<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admit Card - {{ $admitCard->roll_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            color: #1e293b;
        }
        .admit-card {
            border: 4px solid #4f46e5;
            padding: 25px;
            max-width: 750px;
            margin: 0 auto;
            position: relative;
            background-color: #fff;
        }
        .header {
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        .logo-img {
            height: 55px;
            width: auto;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
            color: #4f46e5;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 10px;
            text-transform: uppercase;
            font-weight: bold;
            color: #64748b;
            letter-spacing: 2px;
        }
        .exam-title {
            text-align: center;
            margin-bottom: 25px;
        }
        .exam-title span {
            background-color: #e0e7ff;
            color: #4338ca;
            padding: 6px 18px;
            border: 1px solid #c7d2fe;
            border-radius: 6px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }
        .content-table {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        .content-table td {
            padding: 10px 0;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .label {
            font-weight: bold;
            width: 160px;
            color: #64748b;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
        }
        .value {
            font-weight: bold;
            font-size: 12px;
            color: #0f172a;
            text-transform: uppercase;
        }
        .photo-box {
            width: 100px;
            height: 120px;
            border: 2px dashed #cbd5e1;
            border-radius: 6px;
            text-align: center;
            line-height: 120px;
            font-size: 10px;
            color: #94a3b8;
            text-transform: uppercase;
            float: right;
            background-color: #f8fafc;
        }
        .student-photo {
            width: 100px;
            height: 120px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            object-fit: cover;
            float: right;
        }
        .instructions {
            border-top: 2px solid #e2e8f0;
            padding-top: 15px;
            margin-top: 20px;
        }
        .instructions h3 {
            margin-top: 0;
            font-size: 12px;
            text-transform: uppercase;
            color: #4f46e5;
            letter-spacing: 1px;
        }
        .instructions p {
            font-size: 10px;
            line-height: 1.5;
            color: #475569;
            white-space: pre-line;
        }
        .signatures {
            margin-top: 45px;
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
            border-bottom: 1px solid #cbd5e1;
            width: 80%;
            margin: 0 auto 5px;
            height: 25px;
        }
        .sig-text {
            font-size: 9px;
            text-transform: uppercase;
            font-weight: bold;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="admit-card">
        <div class="header">
            @if(isset($siteSettings['site_logo']) && file_exists(public_path('storage/' . $siteSettings['site_logo'])))
                <img src="{{ public_path('storage/' . $siteSettings['site_logo']) }}" class="logo-img">
            @endif
            <h1>{{ $siteSettings['site_name'] ?? 'Shaurya Narayan Foundation' }}</h1>
            <p>Official Examination Admit Card</p>
        </div>

        <div class="exam-title">
            <span>{{ $admitCard->exam_name }}</span>
        </div>

        <table class="content-table">
            <tr>
                <td style="width: 75%; border-bottom: none;">
                    <table style="width: 100%; border-collapse: collapse;">
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
                            <td class="value" style="color: #4f46e5; font-size: 13px;">{{ $admitCard->roll_no }}</td>
                        </tr>
                        <tr>
                            <td class="label">Exam Date & Time:</td>
                            <td class="value">{{ $admitCard->exam_date->format('d F Y, h:i A') }}</td>
                        </tr>
                        <tr>
                            <td class="label" style="border-bottom: none;">Examination Center:</td>
                            <td class="value" style="border-bottom: none;">{{ $admitCard->exam_center }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 25%; text-align: right; vertical-align: top; border-bottom: none;">
                    @if($admitCard->user && $admitCard->user->profile_photo_path && file_exists(public_path('storage/' . $admitCard->user->profile_photo_path)))
                        <img src="{{ public_path('storage/' . $admitCard->user->profile_photo_path) }}" class="student-photo">
                    @else
                        <div class="photo-box">
                            Photo
                        </div>
                    @endif
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
