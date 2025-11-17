<?php

namespace App\Http\Controllers;

use App\Models\PaymentHistory;
use App\Models\InstalledDomain;
use Illuminate\Http\Request;

class PurchaseValidationController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'purchase_code' => 'required|string',
            'domain' => 'required|string'
        ]);

        $clientIp = $request->ip();

        // Step 1: Check if purchase code exists in payment history
        $purchaseExists = PaymentHistory::where('purchase_code', $request->purchase_code)->exists();

        if (!$purchaseExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid purchase code.'
            ], 404);
        }

        // Step 2: Check if the purchase code is already used
        $existing = InstalledDomain::where('purchase_code', $request->purchase_code)->first();

        if ($existing) {
            if (
                $existing->domain === $request->domain &&
                $existing->ip_address === $clientIp
            ) {
                // Allow reinstallation on same domain & IP
                return response()->json([
                    'status' => 'success',
                    'message' => 'Reinstallation allowed on same domain and IP.',
                    'data' => [
                        'domain' => $existing->domain,
                        'ip' => $existing->ip_address,
                        'installed_at' => $existing->created_at->toDateTimeString()
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This purchase code is already used on another domain or IP.',
                    'used_domain' => $existing->domain,
                    'used_ip' => $existing->ip_address
                ], 403);
            }
        }

        // Step 3: Save new domain and IP
        InstalledDomain::create([
            'purchase_code' => $request->purchase_code,
            'domain' => $request->domain,
            'ip_address' => $clientIp
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Purchase code is valid and domain is now registered.',
            'data' => [
                'domain' => $request->domain,
                'ip' => $clientIp,
                'installed_at' => now()->toDateTimeString()
            ]
        ]);
    }

}
