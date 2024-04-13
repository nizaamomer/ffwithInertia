<!DOCTYPE html>
<html>

<head>
    <title>Expenses Report</title>
</head>

<body>
    <h1>Expenses Report</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
