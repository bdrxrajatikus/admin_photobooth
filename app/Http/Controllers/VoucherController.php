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
        return view('vouchers.index', compact('vouchers'));
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
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('vouchers/create')
                ->withErrors($validator)
                ->withInput();
        }

        Voucher::create($request->all());

        return redirect('vouchers')->with('success', 'Voucher berhasil dibuat!');
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
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('vouchers/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $voucher = Voucher::findOrFail($id);
        $voucher->update($request->all());

        return redirect('vouchers')->with('success', 'Voucher berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect('vouchers')->with('success', 'Voucher berhasil dihapus!');
    }
}
