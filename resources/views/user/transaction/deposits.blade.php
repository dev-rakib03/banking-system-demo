@extends('user.layout')
@section('title','All Deposit Transactions')
@section('content')
<div class="p-6 bg-white">
    <h1 class="text-2xl font-semibold mb-4">All Deposit Transactions</h1>

    <div class="mb-4 p-4 border rounded bg-gray-100">
        <h2 class="text-lg font-semibold mb-2">Deposit Form</h2>
        <form action="{{ route('deposit.add') }}" method="POST" class="space-y-2">
            @csrf
            {{-- <div>
                <label for="user_id" class="block font-semibold">User ID:</label>
                <input type="text" name="user_id" id="user_id" class="w-full border rounded p-2">
            </div> --}}
            <div>
                <label for="amount" class="block font-semibold">Amount:</label>
                <input type="text" name="amount" id="amount" class="w-full border rounded p-2">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Deposit</button>
            </div>
        </form>
    </div>

    <h2 class="text-lg font-semibold mb-2">All Deposit Transactions:</h2>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Transaction Type</th>
                <th class="px-4 py-2 text-left">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deposits as $deposit)
                <tr class="bg-gray-100">
                    <td class="px-4 py-2">{{ ucfirst($deposit->transaction_type) }}</td>
                    <td class="px-4 py-2">BDT {{ $deposit->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $deposits->links() }}
    </div>
</div>
@endsection
