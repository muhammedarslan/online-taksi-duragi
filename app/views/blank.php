<?php

include('durak.header.php');

new_session();

$UID = $_SESSION['Durak']->id;

?>


<!-- start page content -->
<input type="text" value="blank" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" >Sayfa</div>
				</div>
				<ol class="breadcrumb page-breadcrumb pull-right">
					<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li class="active">Rehber</li>
				</ol>
			</div>
		</div>
		<!-- add content here -->
	</div>
</div>
<!-- end page content -->



<?php

include('durak.footer.php');

echo '  </body>
</html>';

?>