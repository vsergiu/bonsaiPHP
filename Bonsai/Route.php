<?php

class Route
{
	public $isMatched = false;

	public $params;

	public $url;

	public $conditions;

	public $callback;

	public function __construct($url, $requestUri, $callback, $conditions)
	{
		$this->url = $url;
		$this->params = array();
		$this->conditions = $conditions;
		$this->callback = $callback;

		$paramsNames = array();
		$paramsValues = array();

		preg_match_all('@:([\w]+)@', $url, $paramsNames, PREG_PATTERN_ORDER);
		$paramsNames = $paramsNames[0];

		$url_regex = preg_replace_callback('@:[\w]+@', array($this, 'regexUrl'), $url);
    	$url_regex .= '/?';

    	if (preg_match('@^' . $url_regex . '$@', $requestUri, $paramsValues)) {
      		array_shift($paramsValues);
      		foreach($paramsNames as $index => $value) $this->params[substr($value,1)] = urldecode($paramsValues[$index]);
      		$this->isMatched = true;
    	}
 
    	unset($paramsNames); unset($paramsValues);
	}

	public function regexUrl($matches)
	{
		$key = str_replace(':', '', $matches[0]);
   	 	if (array_key_exists($key, $this->conditions)) {
      		return '('.$this->conditions[$key].')';
    	} 
   		else {
      		return '([a-zA-Z0-9_\+\-%]+)';
    	}
	}
}