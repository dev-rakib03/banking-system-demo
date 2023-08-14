@extends('user.layout')
@section('title','Dashboard')
@section('content')
<div class="flex justify-center items-center h-4/5">
    <div class="grid grid-cols-2 gap-4 max-w-md">
      <a href="{{ route('transactions') }}" class="bg-blue-500 text-white p-4 flex items-center justify-center space-x-2 hover:bg-blue-600">
        <i class="fas fa-list-alt text-xl"></i>
        <span>All Transactions</span>
      </a>
      <a href="{{ route('deposit.all') }}" class="bg-green-500 text-white p-4 flex items-center justify-center space-x-2 hover:bg-green-600">
        <i class="fas fa-money-bill-wave text-xl"></i>
        <span>Deposit</span>
      </a>
      <a href="{{ route('withdrawal.all') }}" class="bg-yellow-500 text-white p-4 flex items-center justify-center space-x-2 hover:bg-yellow-600">
        <i class="fas fa-hand-holding-usd text-xl"></i>
        <span>Withdraw</span>
      </a>
      <a class="bg-purple-500 text-white p-4 flex items-center justify-center space-x-2 hover:bg-purple-600">
        <i class="fas fa-exchange-alt text-xl"></i>
        <span>Transfer</span>
      </a>
    </div>
  </div>
@endsection
