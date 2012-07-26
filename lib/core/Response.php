<?php

/*
 * almost copy from CakePHP 2.0
 */
class Response{
	
	protected $_headers = array();
	protected $_cookies = array();
	protected $_charset = 'UTF-8';
	protected $_status = 200;
	protected $_contentType = 'text/html';
	protected $_protocol = 'HTTP/1.1';
	protected $_statusCodes = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Time-out',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Large',
		415 => 'Unsupported Media Type',
		416 => 'Requested range not satisfiable',
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Time-out'
	);
	
	public $view;
	
	public function __construct($view) {
		$this->view = $view;
	}
	
	public function send() {
		if (isset($this->_headers['Location']) && $this->_status === 200) {
			$this->statusCode(302);
		}

		$codeMessage = $this->_statusCodes[$this->_status];
		$this->_setCookies();
		$this->_sendHeader("{$this->_protocol} {$this->_status} {$codeMessage}");
//		$this->_setContentLength();
		$this->_setContentType();
		foreach ($this->_headers as $header => $value) {
			$this->_sendHeader($header, $value);
		}
	}
	
	public function statusCode($code = null) {
		if (is_null($code)) {
			return $this->_status;
		}
		return $this->_status = $code;
	}
	
	protected function _sendHeader($name, $value = null) {
		if (!headers_sent()) {
			if (is_null($value)) {
				header($name);
			} else {
				header("{$name}: {$value}");
			}
		}
	}
	
	protected function _setCookies() {
		foreach ($this->_cookies as $name => $c) {
			setcookie(
				$name, $c['value'], $c['expire'], $c['path'],
				$c['domain'], $c['secure'], $c['httpOnly']
			);
		}
	}
	
	protected function _setContentLength() {
		unset($this->_headers['Content-Length']);
//		$shouldSetLength = !isset($this->_headers['Content-Length']) && !in_array($this->_status, range(301, 307));
//		if (isset($this->_headers['Content-Length']) && $this->_headers['Content-Length'] === false) {
//			unset($this->_headers['Content-Length']);
//			return;
//		}
//		if ($shouldSetLength && !$this->outputCompressed()) {
//			$offset = ob_get_level() ? ob_get_length() : 0;
//			if (ini_get('mbstring.func_overload') & 2 && function_exists('mb_strlen')) {
//				$this->length($offset + mb_strlen($this->_body, '8bit'));
//			} else {
//				$this->length($this->_headers['Content-Length'] = $offset + strlen($this->_body));
//			}
//		}
	}
	
	public function outputCompressed() {
		return strpos(env('HTTP_ACCEPT_ENCODING'), 'gzip') !== false
			&& (ini_get("zlib.output_compression") === '1' || in_array('ob_gzhandler', ob_list_handlers()));
	}
	
	protected function _setContentType() {
		if (in_array($this->_status, array(304, 204))) {
			return;
		}
		if (strpos($this->_contentType, 'text/') === 0) {
			$this->header('Content-Type', "{$this->_contentType}; charset={$this->_charset}");
		} else {
			$this->header('Content-Type', "{$this->_contentType}");
		}
	}
	
	public function cookie($options = null) {
		if ($options === null) {
			return $this->_cookies;
		}

		if (is_string($options)) {
			if (!isset($this->_cookies[$options])) {
				return null;
			}
			return $this->_cookies[$options];
		}

		$defaults = array(
			'name' => '',
			'value' => '',
			'expire' => 0,
			'path' => '/',
			'domain' => '',
			'secure' => false,
			'httpOnly' => false
		);
		$options += $defaults;

		$this->_cookies[$options['name']] = $options;
	}
	
	public function redirect_404(){
		$_404_file = VIEW_DIR.'/error/404.php';
		$this->view->set_template_direct($_404_file);
	}
	
	public function redirect_500(){
		$_500_file = VIEW_DIR.'/error/500.php';
		$this->view->set_template_direct($_500_file);
	}
	
	public function redirect($url){
		header('location:'.$url);
		exit;
	}
	
	public function download($filename) {
		$this->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
	}
	
	public function header($header = null, $value = null) {
		if (is_null($header)) {
			return $this->_headers;
		}
		if (is_array($header)) {
			foreach ($header as $h => $v) {
				if (is_numeric($h)) {
					$this->header($v);
					continue;
				}
				$this->_headers[$h] = trim($v);
			}
			return $this->_headers;
		}

		if (!is_null($value)) {
			$this->_headers[$header] = $value;
			return $this->_headers;
		}

		list($header, $value) = explode(':', $header, 2);
		$this->_headers[$header] = trim($value);
		return $this->_headers;
	}
	
	public function disableCache() {
		$this->header(array(
			'Expires' => 'Mon, 26 Jul 1997 05:00:00 GMT',
			'Last-Modified' => gmdate("D, d M Y H:i:s") . " GMT",
			'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0'
		));
	}
	
	public function length($bytes = null) {
		if ($bytes !== null ) {
			$this->_headers['Content-Length'] = $bytes;
		}
		if (isset($this->_headers['Content-Length'])) {
			return $this->_headers['Content-Length'];
		}
		return null;
	}
	
}