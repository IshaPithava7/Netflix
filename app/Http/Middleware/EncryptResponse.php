<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EncryptResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Process the request
            $response = $next($request);
            $secretKey = base64_decode(config('app.encryption_key'));
            $iv = base64_decode(config('app.encryption_iv'));
            $algorithm = env('ALGORITHM', 'aes-256-cbc');

            $responseData = $response->getContent();

            // Encrypt only JSON responses
            if ($response->headers->get('Content-Type') === 'application/json') {
                $encryptedData = openssl_encrypt($responseData, $algorithm, $secretKey, OPENSSL_RAW_DATA, $iv);

                if ($encryptedData === false) {
                    return response(bin2hex('Encryption failed.'), $response->status(), ['Content-Type' => 'text/plain']);
                }

                // Convert binary to hex
                $encryptedHex = bin2hex($encryptedData);

                return response($encryptedHex, $response->status(), ['Content-Type' => 'text/plain']);
            }
        } catch (Exception $e) {
            return response(bin2hex('Error during response encryption: ' . $e->getMessage()), $response->status(), ['Content-Type' => 'text/plain']);
        }

        return $response;
    }
}
