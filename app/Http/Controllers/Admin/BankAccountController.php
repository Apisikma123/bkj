<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Subsidiary;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::with('subsidiary')->latest()->paginate(10);
        return view('admin.bank-accounts.index', compact('bankAccounts'));
    }

    public function create()
    {
        $subsidiaries = Subsidiary::all();
        return view('admin.bank-accounts.create', compact('subsidiaries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'subsidiary_id' => 'required|exists:subsidiaries,id',
        ]);
        
        BankAccount::create($data);
        return redirect()->route('admin.bank-accounts.index')->with('success', 'Bank Account added.');
    }

    public function edit(BankAccount $bankAccount)
    {
        $subsidiaries = Subsidiary::all();
        return view('admin.bank-accounts.edit', compact('bankAccount', 'subsidiaries'));
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        $data = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'subsidiary_id' => 'required|exists:subsidiaries,id',
        ]);

        $bankAccount->update($data);
        return redirect()->route('admin.bank-accounts.index')->with('success', 'Bank Account updated.');
    }

    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();
        return redirect()->route('admin.bank-accounts.index')->with('success', 'Bank Account deleted.');
    }
}