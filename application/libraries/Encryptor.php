<?php

class Encryptor
{
    private $CI;

    function __construct()
    {
        $this->CI = get_instance();
    }
    /**
     * simple method to encrypt or decrypt a plain text string
     * initialization vector(IV) has to be the same when encrypting and decrypting
     *
     * @param string $action: can be 'encrypt','decrypt' or 'encode',''decode'
     * @param string $string: string to 'encrypt' or 'decrypt',or 'encode',''decode'
     *  
     *
     * @return string
     */
    function enkrip($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = '86jBkpti4n1FSoKbmSr19SdHIL4Cnbpw';
        $secret_iv = $secret_key;
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'enkrip') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'dekrip') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    function enkrip_service($action, $string, $secret_key)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = base64_decode($secret_key);
        $secret_iv = $secret_key;
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'enkrip') {
            $output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $iv);
            // $output = base64_encode($output);
        } else if ($action == 'dekrip') {
            $output = openssl_decrypt($string, $encrypt_method, $secret_key, 0, $iv);
            $output = base64_encode($output);
        }
        return $output;
    }

    function encrypt_decrypt2($action, $string)
    {
        $output = false;
        $encrypt_method = MCRYPT_BLOWFISH;
        $encrypt_method2 = "AES-256-CBC";
        $mode = MCRYPT_MODE_ECB;
        $secret_key = 'o0EX6ExHGu1GIjfErmU0W19aVplnExUS';
        $secret_iv = $secret_key;
        // hash
        $key = hash('sha256', $secret_key);
        $key_size_blow = mcrypt_get_key_size($encrypt_method, $mode);
        $key_blow = hash("sha256", $key, true);
        $key_blow = substr($key_blow, 0, $key_size_blow);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output_blow = mcrypt_encrypt($encrypt_method, $key_blow, $string, $mode, $iv);
            $output_blow = base64_encode($output_blow);
            $output_aes = openssl_encrypt($output_blow, $encrypt_method2, $key, 0, $iv);
            $output = base64_encode($output_aes);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method2, $key, 0, $iv);
            $output = mcrypt_decrypt($encrypt_method, $key_blow, base64_decode($output), $mode, $iv);
        }
        return $output;
    }
    function encrypt_decrypt3($action, $string)
    {
        $output = false;
        $encrypt_method = MCRYPT_BLOWFISH;
        $encrypt_method2 = "AES-256-CBC";
        $mode = MCRYPT_MODE_ECB;
        $secret_key = 'o0EX6ExHGu1GIjfErmU0W19aVplnExUS';
        $secret_iv = $secret_key;
        // hash
        $key = hash('sha256', $secret_key);
        $key_size_blow = mcrypt_get_key_size($encrypt_method, $mode);
        $key_blow = hash("sha256", $key, true);
        $key_blow = substr($key_blow, 0, $key_size_blow);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method2, $key, 0, $iv);
            $output = base64_encode($output);
            $output = mcrypt_encrypt($encrypt_method, $key_blow, $output, $mode, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = mcrypt_decrypt($encrypt_method, $key_blow, base64_decode($string), $mode, $iv);
            $output = openssl_decrypt(base64_decode($output), $encrypt_method2, $key, 0, $iv);
        }
        return $output;
    }
    function encrypt_decrypt_blow($action, $string)
    {
        $output = false;
        $encrypt_method = MCRYPT_BLOWFISH;
        $mode = MCRYPT_MODE_ECB;
        $secret_key = 'o0EX6ExHGu1GIjfErmU0W19aVplnExUS';
        $secret_iv = $secret_key;
        // hash
        $key = hash('sha256', $secret_key);
        $key_size_blow = mcrypt_get_key_size($encrypt_method, $mode);
        $key = hash("sha256", $key, true);
        $key = substr($key, 0, $key_size_blow);

        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = mcrypt_encrypt($encrypt_method, $key, $string, $mode, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = mcrypt_decrypt($encrypt_method, $key, base64_decode($string), $mode, $iv);
        }
        return $output;
    }
    // function encode( $data ){
    //     $input= rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
    //     return $input;
    //   }
    //   function decode( $data ){
    //         $output= base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
    //         return $output;
    //   }

}