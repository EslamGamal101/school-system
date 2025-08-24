<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZoomService
{
public function getAccessToken()
{
// نعمل Base64 من Client ID + Client Secret
$basicAuth = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));

// نطلب من Zoom التوكن
$response = Http::withHeaders([
'Authorization' => 'Basic ' . $basicAuth,
])->asForm()->post('https://zoom.us/oauth/token', [
'grant_type' => 'account_credentials',
'account_id' => env('ZOOM_ACCOUNT_ID'),
]);

// لو في خطأ نعرضه
if ($response->failed()) {
throw new \Exception('Zoom Auth Error: ' . $response->body());
}

// نرجع التوكن
return $response->json()['access_token'];
}
public function createMeeting($topic, $startTime, $duration)
{
$accessToken = $this->getAccessToken();

$response = Http::withToken($accessToken)
->post(env('ZOOM_BASE_URL') . '/users/me/meetings', [
'topic' => $topic,
'type' => 2, // Scheduled meeting
'start_time' => $startTime, // Example: "2025-08-24T15:00:00Z"
'duration' => $duration, // in minutes
'timezone' => 'Africa/Cairo',
'password' => rand(100000, 999999),
]);

return $response->json();
}
    public function getMeeting($meetingId)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->get(env('ZOOM_BASE_URL') . "/meetings/{$meetingId}");

        if ($response->failed()) {
            throw new \Exception('Zoom Get Meeting Error: ' . $response->body());
        }

        return $response->json();
    }

}