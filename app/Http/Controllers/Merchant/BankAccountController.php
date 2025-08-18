<?php
// 1. Buat Controller baru: app/Http/Controllers/Merchant/BankAccountController.php
// Jalankan: php artisan make:controller Merchant/BankAccountController --resource

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = Auth::user()->bankAccounts()->latest()->get();
        return view('merchants.bank_accounts.index', compact('bankAccounts'));
    }

    public function create()
    {
        return view('merchants.bank_accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'bank_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Uncomment if you want to handle bank logo
        ]);

        $logoPath = null;
        if ($request->hasFile('bank_logo')) {
            $logoPath = $request->file('bank_logo')->store('bank_logos', 'public');
        }

        Auth::user()->bankAccounts()->create([
            'bank_name' => $request->bank_name,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
            'bank_logo' => $logoPath,
        ]);

        return redirect()->route('merchant.bank-accounts.index')->with('success', 'Rekening bank berhasil ditambahkan.');
    }

    public function edit(BankAccount $bankAccount)
    {
        // Pastikan merchant hanya bisa mengedit rekening miliknya
        if ($bankAccount->user_id !== Auth::id()) {
            abort(403);
        }
        return view('merchants.bank_accounts.edit', compact('bankAccount'));
    }

    public function update(Request $request, BankAccount $bankAccount)
    {
        if ($bankAccount->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'bank_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',

        ]);

        $logoPath = $bankAccount->bank_logo;
        if ($request->hasFile('bank_logo')) {
            if ($bankAccount->bank_logo) {
                Storage::disk('public')->delete($bankAccount->bank_logo);
            }
            $logoPath = $request->file('bank_logo')->store('bank_logos', 'public');
        }

        $bankAccount->update([
            'bank_name' => $request->bank_name,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
            'bank_logo' => $logoPath,
        ]);

        return redirect()->route('merchant.bank-accounts.index')->with('success', 'Rekening bank berhasil diperbarui.');
    }

    public function destroy(BankAccount $bankAccount)
    {
        if ($bankAccount->user_id !== Auth::id()) { abort(403); }

        if ($bankAccount->bank_logo) {
            Storage::disk('public')->delete($bankAccount->bank_logo);
        }
        $bankAccount->delete();

        return redirect()->route('merchant.bank-accounts.index')->with('success', 'Rekening bank berhasil dihapus.');
    }
}
