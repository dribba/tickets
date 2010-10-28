<?php 
	
$out = null;

if (empty($wizard)) {
	$out[] = $this->MyForm->submit(__('Save', true), array('class' => 'action', 'id' => 'save', 'div' => false));
	$out[] = $this->MyForm->submit(__('Cancel', true), array('type' => 'reset', 'class' => 'action close_modal', 'id' => 'cancel', 'div' => false));
} else {
	
	$out[] = $this->MyForm->submit(__('Next', true), array('name' => 'next', 'class' => 'wizard action', 'id' => 'next', 'onclick' => '$("#direction:first").val("next");', 'div' => false));

	if (!empty($prev)) {
		$out[] = $this->MyForm->submit(__('Prev', true), array('name' => 'prev', 'class' => 'wizard action', 'id' => 'prev', 'onclick' => '$("#direction:first").val("prev");', 'div' => false));
	}
}

echo $this->MyHtml->tag('div', $out, array('id' => 'footer'));	