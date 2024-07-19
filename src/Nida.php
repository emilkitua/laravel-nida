<?php

namespace EmilKitua\Nida;

use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Log;

class Nida
{
    private $baseUrl;
    private $client;

    public function __construct()
    {
        $this->baseUrl = "https://ors.brela.go.tz/um/load/load_nida/";
        $this->client = new Client();
    }

    private function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Content-Length' => '0',
            'Connection' => 'keep-alive',
            'Accept-Encoding' => 'gzip, deflate, br',
        ];
    }

    private function bytesToImg($imageStr)
    {
        try {
            $decodedImg = base64_decode($imageStr);
            $image = imagecreatefromstring($decodedImg);
            if (!$image) {
                throw new Exception('Failed to decode image.');
            }
            return $image;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    private function pythonizeImages($userData)
    {
        $userData['PHOTO'] = $this->bytesToImg($userData['PHOTO']);
        $userData['SIGNATURE'] = $this->bytesToImg($userData['SIGNATURE']);
        return $userData;
    }

    private function capitalizeKeys($userData)
    {
        $newUserData = [];
        foreach ($userData as $key => $value) {
            $newUserData[ucfirst(strtolower($key))] = $value;
        }
        return $newUserData;
    }

    private function preprocessUserData($userData)
    {
        if (isset($userData['PHOTO']) && isset($userData['SIGNATURE'])) {
            $userData = $this->pythonizeImages($userData);
        }
        return $this->capitalizeKeys($userData);
    }

    public function loadUser($nationalId, $json = false)
    {
        try {
            $userData = $this->loadUserInformation($nationalId);
            if (!$json) {
                $userData = $this->preprocessUserData($userData);
            }
            return $userData;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    private function loadUserInformation($nationalId)
    {
        try {
            $response = $this->client->post($this->baseUrl . $nationalId, [
                'headers' => $this->getHeaders(),
            ]);
            $userInformation = json_decode($response->getBody(), true);

            if (isset($userInformation['obj']['result'])) {
                return $userInformation['obj']['result'];
            }
            if (isset($userInformation['obj']['error'])) {
                return null;
            }
        } catch (Exception $e) {
            throw new Exception("Can't load user information, probably connection issues");
        }
    }
}
