<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        $title = 'Voucher';
        return view('vouchers.index', compact('vouchers', 'title'));
    }

    public function create()
    {
        return view('vouchers.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'promo_code' => 'required|unique:vouchers,promo_code',
            'promo_name' => 'required',
            'description' => 'nullable',
            'qty' => 'required|integer|min:1',
            'is_percentage' => 'required|boolean',
            'amount' => 'required|numeric|min:0.01',
            'expired_date' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('vouchers.create')
                ->withErrors($validator)
                ->withInput();
        }

        $voucherData = $request->except(['_token']);
        $voucherData['expired_date'] = $request->input('expired_date');

        Voucher::create($voucherData);

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil dibuat!');
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'promo_code' => 'required|unique:vouchers,promo_code,' . $id,
            'promo_name' => 'required',
            'description' => 'nullable',
            'qty' => 'required|integer|min:1',
            'is_percentage' => 'required|boolean',
            'amount' => 'required|numeric|min:0.01',
            'expired_date' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('vouchers.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $voucherData = $request->except(['_token', '_method']);
        $voucherData['expired_date'] = $request->input('expired_date');

        $voucher = Voucher::findOrFail($id);
        $voucher->update($voucherData);

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil dihapus!');
    }
}
