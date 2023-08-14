@extends('user.layout')
@section('title','All Transactions and Balances')
@section('content')
<div class="p-6 bg-white">
    <div class="text-center">
        <h2 class="text-lg font-semibold">{{ Auth::user()->name }}</h2>
        <p>User Id: {{ Auth::user()->id }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
        <p>Balance: BDT{{ Auth::user()->balance }}</p>
    </div>


    <h1 class="text-2xl font-semibold mb-4">All Transactions</h1>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">User</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Transaction Type</th>
                <th class="px-4 py-2 text-left">Amount</th>
                <th class="px-4 py-2 text-left">Fee</th>
            </tr>
        </thead>
        <tbody>

                @foreach ($transactions as $transaction)
                    <tr>
                        <td class="px-4 py-2">{{ $transaction->user->name }}</td>
                        <td class="px-4 py-2">{{ $transaction->user->email }}</td>
                        <td class="px-4 py-2">{{ $transaction->transaction_type }}</td>
                        <td class="px-4 py-2">BDT {{ $transaction->amount }}</td>
                        <td class="px-4 py-2">{{ $transaction->fee }}</td>
                    </tr>
                @endforeach

        </tbody>
    </table>
</div>

@endsection
