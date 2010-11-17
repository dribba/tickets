<?php

App::import('helper', 'html');

class MyHtmlHelper extends HtmlHelper {



/**
 * Creates an HTML link.
 *
 * If $url starts with "http://" this is treated as an external link. Else,
 * it is treated as a path to controller/action and parsed with the
 * HtmlHelper::url() method.
 *
 * If the $url is empty, $title is used instead.
 *
 * ### Options
 *
 * - `escape` Set to false to disable escaping of title and attributes.
 *
 * @param string $title The content to be wrapped by <a> tags.
 * @param mixed $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
 * @param array $options Array of HTML attributes.
 * @param string $confirmMessage JavaScript confirmation message.
 * @return string An `<a />` element.
 * @access public
 * @link http://book.cakephp.org/view/1442/link
 */
	function link($title, $url = null, $options = array(), $confirmMessage = false) {
	
		if ($url == null) {
			$url = 'javascript:void(0)';
		}
		
		return parent::link($title, $url, $options, $confirmMessage);
	}


/**
 * Creates a formatted IMG element. If `$options['url']` is provided, an image link will be
 * generated with the link pointed at `$options['url']`.  This method will set an empty
 * alt attribute if one is not supplied.
 *
 * ### Usage
 *
 * Create a regular image:
 *
 * `echo $html->image('cake_icon.png', array('alt' => 'CakePHP'));`
 *
 * Create an image link:
 *
 * `echo $html->image('cake_icon.png', array('alt' => 'CakePHP', 'url' => 'http://cakephp.org'));`
 *
 * Create an image link with a confirm:
 *
 * `echo $html->image('cake_icon.png', array('alt' => 'CakePHP', 'url' => 'http://cakephp.org', 'confirm' => 'Are you sure?'));`
 *
 * @param string $path Path to the image file, relative to the app/webroot/img/ directory.
 * @param array $options Array of HTML attributes.
 * @return string completed img tag
 * @access public
 * @link http://book.cakephp.org/view/1441/image
 */
	function image($path, $options = array()) {

		if (!empty($options['confirm'])) {

			$confirm = $options['confirm'];
			$url = $options['url'];
			unset($options['confirm']);
			unset($options['url']);
			$options['escape'] = false;

			return $this->link(parent::image($path, $options), $url, $options, $confirm);

		} else {
			return parent::image($path, $options);
		}

	}


/**
 * Returns a formatted block tag, i.e DIV, SPAN, P.
 *
 * ### Options
 *
 * - `escape` Whether or not the contents should be html_entity escaped.
 *
 * @param string $name Tag name.
 * @param mixed $text String or Array (that will be imploded by \n) content that will appear inside the div element.
 *   If null, only a start tag will be printed
 * @param mixed $options Array of Additional HTML attributes of the tag. If String, class attribute will be assumed.
 * @return string The formatted tag element
 * @access public
 */
	function tag($name, $text = null, $options = array()) {

		if (is_array($text)) {
			$toOutput = implode("\n", $text);
		} else {
			$toOutput = $text;
		}

		if ($toOutput == null) {
			$toOutput = '';
		}

		if (!is_array($options)) {
			$options = array('class' => $options);
		}
		if ($name == 'dd' && empty($toOutput)) {
			$toOutput = '&nbsp;';
		}

		return parent::tag($name, $toOutput, $options);
	}


	function out($data, $separator = "\n") {
		if (is_array($data)) {
			return implode($separator, $data);
		} else {
			return $data;
		}
	}


/**
 * Returns a formatted and translation ready title h2 element.
 *
 * @param string $title Title text.
 * @return string The formatted h2 element
 * @access public
 */
	function title ($title) {
		return $this->tag('h2', __($title, true), array('class' => 'title'));
	}


/**
 * Returns a formatted table tag.
 *
 * @param array $body Array of table data
 * @param array $headers Array of tablenames.
 * @param array $footers Array of table data
 * @return string The formatted table element
 * @access public
 */
	function table ($body = null, $header = null, $footer = null) {

		if (!empty($header)) {
			$header = '<thead>' . $this->tableHeaders($header) . '</thead>';
		}

		if (!empty($body)) {
			$body = '<tbody>' . $this->tableCells($body) . '</tbody>';
		}

		return $this->tag(
			'table',
			sprintf("%s\n%s\n%s", $header, $body, $footer)
		);

	}

}