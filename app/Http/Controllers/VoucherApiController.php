<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Voucher;
use Illuminate\Http\Response;

class VoucherApiController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return response()->json($vouchers, Response::HTTP_OK);
    }

    public function show($id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($voucher, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'settings_id' => 'nullable|integer',
            'promo_code' => 'required|unique:vouchers,promo_code',
            'promo_name' => 'required',
            'description' => 'nullable',
            'qty' => 'required|integer|min:1',
            'is_percentage' => 'required|boolean',
            'amount' => 'required|numeric|min:0.01',
            'expired_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Buat Voucher
        $voucher = Voucher::create($request->all());

        return response()->json(['message' => 'Voucher berhasil dibuat', 'voucher' => $voucher], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], Response::HTTP_NOT_FOUND);
        }

        // Validasi data
        $validator = Validator::make($request->all(), [
            'settings_id' => 'nullable|integer',
            'promo_code' => 'required|unique:vouchers,promo_code,' . $id,
            'promo_name' => 'required',
            'description' => 'nullable',
            'qty' => 'required|integer|min:1',
            'is_percentage' => 'required|boolean',
            'amount' => 'required|numeric|min:0.01',
            'expired_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Perbarui Voucher
        $voucher->update($request->all());

        return response()->json(['message' => 'Voucher berhasil diperbarui', 'voucher' => $voucher], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], Response::HTTP_NOT_FOUND);
        }

        $voucher->delete();

        return response()->json(['message' => 'Voucher berhasil dihapus'], Response::HTTP_NO_CONTENT);
    }
}
