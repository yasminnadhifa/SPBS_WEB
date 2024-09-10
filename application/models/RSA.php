<?php

class RSA
{
    private $privateKey;
    private $publicKey;

    public function __construct()
    {
        $this->privateKey = openssl_pkey_get_private('file://' . FCPATH . 'application/third_party/rsa/private_key.pem');
        $this->publicKey = openssl_pkey_get_public('file://' . FCPATH . 'application/third_party/rsa/public_key.pem');
    }
 
    public function rsaEncrypt($data)
    {
        openssl_public_encrypt($data, $encryptedData, $this->publicKey,OPENSSL_PKCS1_PADDING);
        return base64_encode($encryptedData);
    }

    public function rsaDecrypt($data)
    {
        openssl_private_decrypt(base64_decode($data), $decryptedData, $this->privateKey,OPENSSL_PKCS1_PADDING);
        return $decryptedData;
    }

    public function bisa()
    {
        $mytext = "The quick brown fox jumps over the lazy dog";
        echo "Before encryption: ".$mytext."<br><br>";
        
        openssl_public_encrypt($mytext, $encrypted, $this->publicKey);
        echo "Encrypted data:<br>".$encrypted."<br><br>";
        
        openssl_private_decrypt($encrypted, $decrypted, $this->privateKey);
        echo "Decrypted data:<br>".$decrypted."<br><br>";
    }
}

?>