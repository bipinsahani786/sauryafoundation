<!DOCTYPE html>
<html>
<head>
    <title>Charity Donation Receipt</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; padding: 30px; color: #333; }
        .header { text-align: center; margin-bottom: 40px; border-bottom: 2px solid #ddd; padding-bottom: 20px; }
        .header h1 { margin: 0; color: #0284c7; }
        .details { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .details th, .details td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        .details th { background-color: #f8f9fa; width: 40%; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <h3>Official Donation Receipt</h3>
    </div>
    
    <table class="details">
        <tr>
            <th>Donation ID</th>
            <td>{{ $donation->donation_id }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $donation->created_at->format('d M, Y h:i A') }}</td>
        </tr>
        <tr>
            <th>Donor Name</th>
            <td>{{ $donation->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $donation->email }}</td>
        </tr>
        <tr>
            <th>Donation Amount</th>
            <td>₹{{ number_format($donation->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td>{{ strtoupper(str_replace('_', ' ', $donation->payment_method)) }}</td>
        </tr>
        <tr>
            <th>Transaction ID</th>
            <td>{{ $donation->transaction_id }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($donation->status) }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for your generous contribution.</p>
        <p>This is a computer-generated receipt and does not require a physical signature.</p>
    </div>
</body>
</html>
