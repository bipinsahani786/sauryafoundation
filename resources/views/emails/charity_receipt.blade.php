<!DOCTYPE html>
<html>
<head>
    <title>Charity Donation Receipt</title>
</head>
<body>
    <h2>Thank You for Your Donation!</h2>
    <p>Dear {{ $donation->name }},</p>
    <p>We have received your generous donation of <strong>₹{{ number_format($donation->amount, 2) }}</strong>.</p>
    <p>Your Donation ID is: <strong>{{ $donation->donation_id }}</strong></p>
    <p>Please find attached your official donation receipt in PDF format.</p>
    <p>Thank you for supporting our cause.</p>
    <br>
    <p>Best Regards,</p>
    <p>{{ config('app.name') }} Team</p>
</body>
</html>
