<?php
	/**
	 * Create by PhpStorm
	 * User: dovechen
	 * Date: 2020/3/25
	 * Time: 11:30
	 */

	namespace dovechen\yii2\aes;

	use yii\base\Component;

	/**
	 * Class Aes
	 * @package dovechen\yii2\aes
	 */
	class Aes extends Component
	{
		// The key.
		public $key;
		// A non-NULL Initialization Vector, default: 397e2eb61307109f.
		public $iv = '397e2eb61307109f';

		public function init ()
		{
			if (empty($this->key)) {
				$this->key = hash('sha256', $this->iv, true);
			} else {
				$this->key = hash('sha256', $this->key, true);
			}

			$this->iv = hash('sha256', $this->iv, true);
		}

		/**
		 * @param string $hex
		 *
		 * @return string
		 */
		public function hexToStr ($hex)
		{
			$string = '';
			for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
				$string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
			}

			return $string;
		}

		/**
		 * Encrypt content.
		 *
		 * @param string $content The plaintext message data to be encrypted.
		 * @param bool   $base64  use base64 or not.
		 *
		 * @return string   加密后的内容
		 */
		public function encrypt ($content, $base64 = true)
		{
			$contentEncrypted = openssl_encrypt($content, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->iv));

			return $base64 ? base64_encode($contentEncrypted) : $contentEncrypted;
		}

		/**
		 * Decrypt encrypt content.
		 *
		 * @param string $contentEncrypted The encrypted message to be decrypted.
		 * @param bool   $base64           use base64 or not.
		 *
		 * @return string
		 */
		public function decrypt ($contentEncrypted, $base64 = true)
		{
			$contentEncrypted = $base64 ? base64_decode($contentEncrypted) : $contentEncrypted;
			$content          = openssl_decrypt($contentEncrypted, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->iv));

			return $content;
		}
	}