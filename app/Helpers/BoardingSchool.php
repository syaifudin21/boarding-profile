<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class BoardingSchool extends Model
{
    private $key;
    private $secret;
    private $base;
    private $code;

    public function __construct()
    {
        $this->key = env('BOARDING_SCHOOL_KEY');
        $this->secret = env('BOARDING_SCHOOL_SECRET');
        $this->base = env('BOARDING_SCHOOL_BASE');
        $this->code = env('BOARDING_SCHOOL_CODE');
    }

    public function signature($body, $method)
    {
        $secret = $this->secret;
        $key = $this->key;
        $method = $method;
        $timestamps = date('Y-m-d H:i:s');

        $bodyEncrypt = hash('sha256', json_encode($body));
        $stringtosign = strtoupper($method) . ":" . $key . ":" . $bodyEncrypt . ":" . $timestamps;
        $signature = hash_hmac('sha256', $stringtosign, $secret);

        return [
            'signature' => $signature,
            'timestime' => $timestamps
        ];
    }

    public function send($method, $endpoint, $body, $attach = [])
    {
        $head = $this->signature($body, $method);
        $header = [
            'X-KEY' => $this->key,
            'X-SIGNATURE' => $head['signature'],
            'X-TIMESTAMP' => $head['timestime'],
            'X-CODE' => $this->code,
        ];

        $response = Http::withHeaders($header);

        if ($attach) {
            try {
                $filenamewithextension = $attach['photo']->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $response = $response->attach($attach['param'], file_get_contents($attach['photo']), $filename, ['Content-Type' => $attach['contentType']]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        try {
            return $response->$method($this->base . $endpoint, $body)->object();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function profile()
    {
        $body = [];
        $endpoint = '/api/profile';

        $response = $this->send('get', $endpoint, $body);
        return $response;
    }

    public function inbox()
    {
        $body = [
            "name" => "udin222",
            "email" => "udin@mail.com",
            "message" => "abcnas"
        ];
        $endpoint = '/api/inbox';

        $response = $this->send('post', $endpoint, $body);
        return $response;
    }

    public function album()
    {
        $body = [];
        $endpoint = '/api/album';

        $response = $this->send('get', $endpoint, $body);
        return $response;
    }

    public function albumShow($uuid)
    {
        $body = [];
        $endpoint = '/api/album/' . $uuid;

        $response = $this->send('get', $endpoint, $body);
        return $response;
    }

    public function alumni()
    {
        $body = [];
        $endpoint = '/api/alumni';

        $response = $this->send('get', $endpoint, $body);
        return $response;
    }

    public function employee()
    {
        $body = [];
        $endpoint = '/api/employee';

        $response = $this->send('get', $endpoint, $body);
        return $response;
    }

    public function alumniStore($name, $position, $description, $photo)
    {
        $body = [
            'name' => $name,
            'position' => $position,
            'description' => $description,
        ];

        $endpoint = '/api/alumni';

        $attach = [
            'photo' => $photo,
            'param' => 'photo',
            'contentType' => 'image/jpeg'
        ];

        $response = $this->send('post', $endpoint, $body, $attach);
        return $response;
    }

    public function inboxStore($name, $email, $message)
    {
        $body = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ];

        $endpoint = '/api/inbox';

        $response = $this->send('post', $endpoint, $body);
        return $response;
    }
}
