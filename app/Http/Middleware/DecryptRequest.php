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
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getContent()) {
            $encryptedData = $request->getContent();

            try {
                $secretKey = base64_decode(config('app.encryption_key'));
                $iv = base64_decode(config('app.encryption_iv'));
                $algorithm = env('ALGORITHM', 'aes-256-cbc');


                if (strlen($secretKey) !== 32) {
                    throw new Exception('Secret key must be 32 bytes, got ' . strlen($secretKey));
                }
                if (strlen($iv) !== 16) {
                    throw new Exception('IV must be 16 bytes, got ' . strlen($iv));
                }


                // Convert encrypted hex to binary
                $encryptedData = hex2bin($encryptedData);

                // Decrypt
                $decrypted = openssl_decrypt($encryptedData, $algorithm, $secretKey, OPENSSL_RAW_DATA, $iv);

                if ($decrypted === false) {
                    Log::error('Decryption failed.');
                }

                $decryptedData = json_decode($decrypted, true);

                $request->replace($decryptedData);
            } catch (Exception $error) {
                Log::error('Error during decryption: ' . $error->getMessage());
            }
        }

        return $next($request);
    }
}
