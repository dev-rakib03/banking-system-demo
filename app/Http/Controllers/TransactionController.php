<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function showAllTransactionsAndBalance()
    {
        $transactions = transactions::where('user_id',Auth::user()->id)->paginate(10);
        return view('user.transaction.all_transaction',compact('transactions'));
    }

    public function showAllDeposits()
    {
        $deposits = transactions::where('user_id',Auth::user()->id)->where('transaction_type', 'deposit')->paginate(10);
        return view('user.transaction.deposits', compact('deposits'));
    }

    public function deposit(Request $request)
    {
        // Validate input
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
        ]);

        // Create deposit transaction
        transactions::create([
            'user_id' => Auth::user()->id,
            'transaction_type' => 'deposit',
            'amount' => $request->amount,
            'fee' => 0,
            'date' => Carbon::now(),
        ]);

        // Update user's balance
        $user = User::find(Auth::user()->id);
        $user->balance += $request->amount;
        $user->save();

        return redirect('/deposit')->with('success', 'Deposit successful.');
    }

    public function showAllWithdrawals()
    {
        $withdrawals = transactions::where('user_id',Auth::user()->id)->where('transaction_type', 'withdrawal')->paginate(10);
        return view('user.transaction.withdrawals', compact('withdrawals'));
    }

    public function withdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $withdrawalAmount = $request->amount;

        // Apply withdrawal fee based on account type
        $withdrawalFee = $this->calculateWithdrawalFee($user->account_type, $withdrawalAmount);
        $withdrawalAmount += $withdrawalFee;
        // Update user's balance
        if ($user->balance >= $withdrawalAmount) {
            $user->balance -= $withdrawalAmount;
            $user->save();

            // Create withdrawal transaction
            transactions::create([
                'user_id' => $user->id,
                'transaction_type' => 'withdrawal',
                'amount' => $request->amount,
                'fee' => $withdrawalFee,
                'date' => now(),
            ]);

            return redirect('/withdrawal')->with('success', 'Withdrawal successful.');
        } else {
            return redirect('/withdrawal')->with('error', 'Insufficient balance for withdrawal.');
        }
    }

    private function calculateWithdrawalFee($accountType, $amount)
    {
        // Check if free withdrawal conditions are met
        $isFreeWithdrawal = $this->checkFreeWithdrawalConditions($accountType, $amount);

        if ($isFreeWithdrawal) {
            $fee =0;
        }
        else{

            if($accountType === 'Individual'){
                $feeRate = 0.015;
            }
            else{
                $totalWithdrawal = transactions::where('user_id', Auth::user()->id)
                ->where('transaction_type', 'withdrawal')
                ->sum('amount');

                if ($totalWithdrawal <= 50000) {
                    $feeRate = 0.025;
                }
                else{
                    $feeRate = 0.015;
                }
            }
            // Calculate the fee based on the fee rate and withdrawal amount
            $fee = $amount * $feeRate;
        }

        return $fee;
    }

    private function checkFreeWithdrawalConditions($accountType, $amount)
    {
        // Check if it's a Friday (day number 5) for free withdrawal
        $isFreeWithdrawal = (date('N') === 5);
        if ($isFreeWithdrawal) {
            return true;
        }

        // Check if the withdrawal amount is less than or equal to 5000 for free withdrawal
        $firstamount = transactions::where('user_id', Auth::user()->id)
            ->where('transaction_type', 'withdrawal')
            ->sum('amount');

        // Check if the withdrawal amount is less than or equal to 1000 for free withdrawal
        if ($firstamount <= 1000) {
            return true;
        }

        // Check if the withdrawal amount is less than or equal to 5000 for free withdrawal
        $monthlyWithdrawals = transactions::where('user_id', Auth::user()->id)
            ->where('transaction_type', 'withdrawal')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        if ($monthlyWithdrawals+$amount <= 5000) {
            return true;
        }

        return false; // Default case, no free withdrawal conditions
    }


}
