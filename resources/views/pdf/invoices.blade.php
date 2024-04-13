{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>

</head>
<body dir="rtl">
    <div>
        <h1>Commerce Request</h1>
        @if ($note)
            <h2>Your Note</h2>
            <p>{{ $note }}</p>
        @endif
        <h2>List of Invoices</h2>
        <table>
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Added By</th>
                    <th>Total Amount</th>
                    <th>Discount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->addedBy }}</td>
                        <td>{{ $invoice->totalAmount }}</td>
                        <td>{{ $invoice->discount }}</td>
                        <td>{{ $invoice->date }}</td>
                        <td>
                            @if ($invoice->status === 'cash')
                                Cash
                            @elseif ($invoice->status === 'togo')
                                Togo
                            @elseif ($invoice->status === 'delivery')
                                Delivery
                            @endif
                        </td>
                    </tr>
                    @if ($isShowItem)
                        <tr>
                            <td colspan="6">
                                <h3>Invoice Items</h3>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice->invoiceItems as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>This is a sample PDF document generated using Laravel Blade and DomPDF.</p>
</body>
</html>
