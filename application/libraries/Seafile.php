<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seafile
{

    private $base_url = 'http://192.168.11.105/api2/';
    private $token = '8dd151de06986afa6c249a9c8f5ea0dc9068d010'; // ganti dengan token milikmu

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     * Mengirim request cURL ke API Seafile.
     */
    private function request($method, $endpoint, $data = [], $is_post_json = false)
    {
        $url = $this->base_url . '/' . ltrim($endpoint, '/');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = ['Authorization: Token ' . $this->token];

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($is_post_json) {
                $headers[] = 'Content-Type: application/json';
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            }
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // ⛳ pindahkan sebelum curl_close
        curl_close($ch);

        // Logging
        log_message('error', "SEAFILE API [$method $url] => HTTP $http_code");
        log_message('error', "RESPONSE: $response");

        if ($error) {
            return ['error' => $error];
        }

        if ($http_code !== 200) {
            return ['error' => "HTTP $http_code", 'response' => $response];
        }

        return json_decode($response, true);
    }


    /**
     * Mendapatkan daftar repositori (libraries) di Seafile.
     */
    public function listLibraries()
    {
        $result = $this->request('GET', 'repos/');
        log_message('error', 'SEAFILE LIST LIBRARIES RESPONSE: ' . print_r($result, true));
        return $result;
    }

    /**
     * Mendapatkan daftar file dalam repositori tertentu.
     */
    public function listFiles($repo_id, $path = '/')
    {
        $result = $this->request('GET', "repos/{$repo_id}/dir/?p={$path}");

        // Inject full path manually kalau tidak ada
        if (is_array($result)) {
            foreach ($result as &$item) {
                if (!isset($item['path']) && isset($item['name'])) {
                    $item['path'] = rtrim($path, '/') . '/' . $item['name'];
                }
            }
        }

        log_message('error', 'SEAFILE - LIST FILES RESULT: ' . print_r($result, true));
        return $result;
    }


    /**
     * Meng-upload file ke repositori Seafile.
     */
    public function uploadFile($repo_id, $file_path, $file_name, $target_folder = '/')
    {
        $url = $this->base_url . "repos/{$repo_id}/file/";

        $post_fields = [
            'file' => new CURLFile($file_path, mime_content_type($file_path), $file_name),
            'parent_dir' => $target_folder
        ];

        $headers = [
            'Authorization: Token ' . $this->token
        ];

        return $this->request('POST', $url, $post_fields);
    }

    /**
     * Generate public shared link untuk file di Seafile.
     */
    public function generateSharedLink($repo_id, $file_path)
    {
        $file_path = '/' . ltrim($file_path, '/');

        $data = [
            'repo_id' => $repo_id,
            'path' => $file_path,
            'type' => 'f' // f = file
        ];

        $url = $this->base_url . 'share-links/';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Token ' . $this->token,
            'Content-Type: application/x-www-form-urlencoded'
        ]);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if ($info['http_code'] == 201 || $info['http_code'] == 200) {
            return json_decode($response, true);
        }

        return false;
    }


    /**
     * Mengunduh file dari Seafile.
     */
    public function downloadFile($repo_id, $file_path, $save_path)
    {
        $url = $this->base_url . "repos/{$repo_id}/file/" . urlencode($file_path);

        $headers = [
            'Authorization: Token ' . $this->token
        ];

        $response = $this->request('GET', $url, [], false);

        if (isset($response['error'])) {
            return $response;
        }

        // Menyimpan file yang diunduh
        file_put_contents($save_path, $response);
        return true;
    }
}
