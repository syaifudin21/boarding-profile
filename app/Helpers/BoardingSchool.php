<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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

        if (in_array($method, ['POST', 'PUT', 'DELETE', 'post', 'put', 'delete'])) {
            try {
                return $response->$method($this->base . $endpoint, $body)->object();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {

            $expired = env('BOARDING_SCHOOL_CACHE_EXPIRED', 60 * 60 * 24);
            $send = Cache::remember($endpoint, $expired, function () use ($method, $endpoint, $body, $response) {
                try {
                    return $response->$method($this->base . $endpoint, $body)->object();
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            });

            if (isset($send->data)) {
                return $send->data;
            } else {
                return $send;
            }
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

    public function album($limit = null, $orderByType = null)
    {
        $body = [
            'limit' => $limit,
            'order_by' => $orderByType
        ];

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


    public function blog($limit = null, $orderByType = null)
    {
        $body = [
            'limit' => $limit,
            'order_by' => $orderByType
        ];

        $endpoint = '/api/blog';

        $response = $this->send('get', $endpoint, $body);
        return $response;
    }

    public function blogShow($uuid)
    {
        $body = [];
        $endpoint = '/api/blog/' . $uuid;

        $response = $this->send('get', $endpoint, $body);
        return $response;
    }

    public function facility()
    {
        $body = [];
        $endpoint = '/api/facility';

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

    public function employee($body = [])
    {
        $endpoint = '/api/employee';
        $response = $this->send('get', $endpoint, $body);
        return $response;
    }

    public function banner()
    {
        $body = [];
        $endpoint = '/api/banner';

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
