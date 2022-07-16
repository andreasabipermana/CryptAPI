<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cryptapi
{

    protected $_endpoint = 'http://localhost/CryptAPI/Service/api/absensi';
    protected $_api_key = 'NfqRXaC8vwwxB0gt1CKPXtPJrO3fx1OG';


    function __construct()
    {
        $_this = get_instance();
    }
    /**
     * Pustaka (Library) sederhana CodeIgniter 3 untuk melakukan Enkripsi dan Dekripsi
     * Menggunakan Sistem Kriptografi CryptAPI.
     *
     * Dibuat oleh Andreas Abi Permana
     */
    function enkrip($plaintext = NULL, $objek = NULL)
    {
        /* Inisisasi cURL */
        $agent = 'Curl - CryptAPI Library 1.0';
        $ch = curl_init($this->_endpoint);
        /* Array Parameter Data */
        $data = [
            'api-key' => $this->_api_key,
            'objek' => $objek,
            'aksi' => 'enkrip',
            'plaintext' => $plaintext
        ];
        $data = json_encode($data);
        /* pass JSON ke post body */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        /* set useragent */
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        /* set return */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /* jalankan permintaan cURL */
        $result = curl_exec($ch);
        /* Tutup cURL  */
        curl_close($ch);
        $result = json_decode($result, TRUE);
        return $result['ciphertext'];
    }
    function dekrip($ciphertext = NULL, $objek = NULL)
    {
        /* Init cURL resource */
        $agent = 'Curl - CryptAPI Library 1.0';
        $ch = curl_init($this->_endpoint);
        /* Array Parameter Data */
        $data = [
            'api-key' => $this->_api_key,
            'objek' => $objek,
            'aksi' => 'dekrip',
            'ciphertext' => $ciphertext
        ];
        $data = json_encode($data);
        /* pass JSON ke post body */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        /* set useragent */
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        /* set return */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /* jalankan permintaan cURL */
        $result = curl_exec($ch);
        /* Tutup cURL  */
        curl_close($ch);
        // return $result;
        $result = json_decode($result, TRUE);
        return $result['plaintext'];
    }
}