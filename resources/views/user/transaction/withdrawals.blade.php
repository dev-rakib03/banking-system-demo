@extends('user.layout')
@section('title','All Withdrawal')
@section('content')
<div class="p-6 bg-white">
    <h1 class="text-2xl font-semibold mb-4">All Withdrawal Transactions</h1>

    <div class="mb-4 p-4 border rounded bg-gray-100">
        <h2 class="text-lg font-semibold mb-2">Withdrawal Form</h2>
        <form action="{{ route('withdrawal.create') }}" method="POST" class="space-y-2">
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
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Withdraw</button>
            </div>
        </form>
    </div>

    <h2 class="text-lg font-semibold mb-2">All Withdrawal Transactions:</h2>
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
            @foreach ($withdrawals as $withdrawal)
                <tr>
                    <td class="px-4 py-2">{{ $withdrawal->user->name }}</td>
                    <td class="px-4 py-2">{{ $withdrawal->user->email }}</td>
                    <td class="px-4 py-2">{{ $withdrawal->transaction_type }}</td>
                    <td class="px-4 py-2">BDT {{ $withdrawal->amount }}</td>
                    <td class="px-4 py-2">BDT {{ $withdrawal->fee }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $withdrawals->links() }}
    </div>
</div>
@endsection
