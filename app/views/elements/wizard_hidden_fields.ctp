<?php 
	
if (!empty($wizard)) {
	$content[] = $this->MyForm->input('current_step', array('type' => 'hidden', 'value' => $current_step));
	$content[] = $this->MyForm->input('wizard_name', array('type' => 'hidden', 'value' => $wizard_name));
	$content[] = $this->MyForm->input('card', array('type' => 'hidden', 'value' => $card));
	$content[] = $this->MyForm->input('direction', array('type' => 'hidden', 'id' => 'direction'));
	if (!empty($prev_step)) {
		$content[] = $this->MyForm->input('prev_step', array('type' => 'hidden', 'value' => $prev_step));
	}
	//$content[] = $this->MyForm->input('next', array('type' => 'hidden', 'value' => $next));
	//$content[] = $this->MyForm->input('prev', array('type' => 'hidden', 'value' => $prev));
	//$content[] = $this->MyForm->input('parent_id', array('type' => 'hidden', 'value' => $parent_id));

	echo implode($content);
}