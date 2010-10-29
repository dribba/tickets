<?php

App::import('helper', 'paginator');

class MyPaginatorHelper extends PaginatorHelper {


	var $helpers = array('MyHtml', 'Html');


/**
 * Everwrite cakephp sort method to remove order option.
 *
 * @return string The title of the "link".
 * @access public
 */
	function sort($title, $key = null, $options = array()) {
		return $title;
	}


/**
 * Returns a formatted div tag with the navigation over paginated data.
 *
 * @param boolean $counter Specify where to return or no the counter.
 * @return string The formatted div tag element.
 * @access public
 */
	function getNavigator($counter = false, $options = array()) {

		if (!empty($options)) {
			$this->options($options);
		}

		if ($counter === true) {
			$counterHtml = $this->counter(
				array('format' => '<div id="results">' . __('Showing', true) . ' <span class="current">%start% - %end%</span> ' . __('of', true) . ' <span class="total">%count%</span> ' . __('Results', true) . '</div>')
			);
		} else {
			$counterHtml = '';
		}


		$navigator[] = $this->MyHtml->tag('li',
			$this->prev(__('Anterior', true),
				null
			),
			array('class' => 'button small pagePrev')
		);

		$numbers = explode('|', $this->numbers(array('before' => '', 'after' => '', 'separator' => '|')));
		
		foreach ($numbers as $number) { 
			$navigator[] = $this->MyHtml->tag('li',
				$number
			);
		}

		$navigator[] = $this->MyHtml->tag('li',
			$this->next(__('Siguiente', true),
				null
			),
			array('class' => 'button small pageNext')
		);

		/*$navigatorHtml = $this->MyHtml->tag('li',
			implode('', $navigator)
		);*/
		
		if (!empty($numbers[1])) {
			return $this->MyHtml->tag('ul', $navigator, array('class' => 'pagination'));
		}
		
	}

}