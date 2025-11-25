<?php

namespace App\Http\Middleware;

use Exception;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DecryptRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $raw = $request->getContent();

        // If empty or not hex → skip decryption
        if (empty($raw) || !ctype_xdigit($raw) || $request->header('X-Skip-Decrypt')) {
            return $next($request);
        }

        try {

            $secretKey = base64_decode(config('app.encryption_key'));
            $iv = base64_decode(config('app.encryption_iv'));
            $algorithm = env('ALGORITHM', 'aes-256-cbc');

            $raw = hex2bin($raw);

            $decrypted = openssl_decrypt(
                $raw,
                $algorithm,
                $secretKey,
                OPENSSL_RAW_DATA,
                $iv
            );

            $data = json_decode($decrypted, true);

            $request->replace($data);

        } catch (\Exception $e) {
            Log::error('Decrypt error: ' . $e->getMessage());

            // Do NOT modify request body — just continue
            return $next($request);
        }

        return $next($request);
    }



}
