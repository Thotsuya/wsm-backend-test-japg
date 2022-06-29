<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <main>
        <div class="py-5">
            <h1>Hello ReportsController! ✅</h1>
            <p class="lead">
                Please enter the accountId you'd like to display:
            </p>
            <form action="{{ route('home') }}">
                <div class="form-group col-3">
                    <label for="accountId">Account ID</label>
                    <input type="text" class="form-control my-2" id="accountId" name="accountId"
                           placeholder="Enter Account ID" value="{{ request()->has('accountId') ? request()->accountId : '' }}">
                </div>
                <button type="submit" class="btn btn-primary">Get Data</button>
                <a href="{{ route('home') }}" class="btn btn-primary">Show all</a>
            </form>
        </div>
        <div class="pb-5">
            <p class="text-muted">Aggregated performance for all <strong>ACTIVE</strong> accounts is listed below</p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Account Name</th>
                        <th>Account ID</th>
                        <th>Spend</th>
                        <th>Clicks</th>
                        <th>Impressions</th>
                        <th>Cost per Click</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td>{{ $report['accountName'] }}</td>
                            <td>{{ $report['accountId'] }}</td>
                            <td>{{ $report['spend'] }}</td>
                            <td>{{ $report['clicks'] }}</td>
                            <td>{{ $report['impressions'] }}</td>
                            <td>{{ $report['costPerClick'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center table-danger">No data available for the supplied Account Id.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
