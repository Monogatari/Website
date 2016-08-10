<?php

	/**
	 * ==============================
	 * Open SSL
	 * ==============================
	 */

	class OpenSSL {

		public function generateKeyPair($saveTo){
			$privateKey = openssl_pkey_new(array(
			    'private_key_bits' => 2048,      // Size of Key.
			    'private_key_type' => OPENSSL_KEYTYPE_RSA
			));

			if(!file_exists($saveTo.'private.key') || !file_exists($saveTo.'public.key')){
				// Save the private key to private.key file. Never share this file with anyone.
				openssl_pkey_export_to_file($privateKey, $saveTo.'private.key');

				// Generate the public key for the private key
				$a_key = openssl_pkey_get_details($privateKey);
				// Save the public key in public.key file. Send this file to anyone who want to send you the encrypted data.
				file_put_contents($saveTo.'public.key', $a_key['key']);

				// Free the private Key.
				openssl_free_key($privateKey);
			}
		}


		public function encrypt($data, $pathToPublicKey){

			// Get the public Key of the recipient
			$publicKey = openssl_pkey_get_public(file_get_contents($pathToPublicKey));

			openssl_public_encrypt($data, $encrypted, $publicKey);

			openssl_free_key($publicKey);

			// This is the final encrypted data to be sent to the recipient
			return $encrypted;
		}

		public function decrypt($data, $pathToPrivateKey){
			$privateKey = openssl_pkey_get_private(file_get_contents($pathToPrivateKey));

			$a_key = openssl_pkey_get_details($privateKey);
			//$data = base64_decode($data);
			openssl_private_decrypt($data, $decrypted, $privateKey);

			openssl_free_key($privateKey);

			// Uncompress the unencrypted data.
			return $decrypted;

		}

	}

?>