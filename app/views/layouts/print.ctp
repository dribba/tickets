<html xmlns="http://www.w3.org/1999/xhtml" lang="en" dir="ltr">
  <head>
	<script type="text/javascript">
		var base_url = "<?php echo Router::url('/'); ?>";
	</script>
    <title>
      <?php echo $title_for_layout; ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="" />
    <?php
		echo $this->Html->css('skin/g');
		//echo $this->Html->css('skin/l');
		//echo $this->Html->css('skin/_sk/bk');
		//echo $this->Html->css('skin/r');

		//echo $this->Html->css('app.generic');

		$jsFiles[] = 'jquery/jquery-1.4.3.min';
		$jsFiles[] = 'jquery/jquery-ui-1.8.1.custom';
		$jsFiles[] = 'jquery/jquery.maphilight';
		$jsFiles[] = 'default';
		echo $this->Html->script($jsFiles);

		echo $scripts_for_layout;

		$info = json_encode(
			array(
				'base_url'				=> Router::url('/') . $this->params['prefix'] . '/',
				'current_controller' 	=> $this->params['controller'],
				'current_action' 		=> $this->params['action']
			)
		);

	?>
    <meta charset="UTF-8" />
  </head>
  <body>
      <div id="content" class="clear">
        <?php echo $content_for_layout; ?>
      </div>
  </body>
</html>
