<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      <?php echo $title_for_layout; ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="robots" content="all" />
    <?php
		echo $this->Html->css('skin/g');
		echo $this->Html->css('skin/l');
		echo $this->Html->css('skin/_sk/bk');
		echo $this->Html->css('skin/r');

		echo $scripts_for_layout;
	?>
    <meta charset="UTF-8" />
  </head>
  <body id="pageLogin">
    <div id="login" class="centerbox">
      <h1>
        Talleres <span>| Administracion</span>
      </h1>
      <h2>
        <?php echo __('User login', true); ?>
      </h2>
      <div class="boxInside">
        <div id="msgInfo" class="message clear">
          <?php echo __('Ingrese su usuario y contrasena', true); ?>
        </div>
		<?php
			$message = explode('|', $this->Session->flash());
			if (!empty($message[0])) {
				echo $this->MyHtml->tag('div', $message[1], array('class' => 'message clear', 'id' => 'msg' . ucwords($message[0])));
			}
			echo $content_for_layout;
		?>
		
        
      </div>
    </div>
  </body>
</html>
