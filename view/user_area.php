<!--Bilder hochladen-->
<ul class="thumbnails">
    <li class="col-sm-3">
        <div class="fff">
			<form action="/post/createPost" method="post" enctype="multipart/form-data">
				<div class=""><input type="file" name="fileToUpload" id="fileToUpload"></div>
				<input class="btn btn-primary uploadbutton" type="submit" value="Upload Image" name="submit" style="margin-left: 0px;">
			</form>
        </div>
    </li>
</ul>

<div class="row profile">
	<div class="col-md-3">
		<div class="profile-sidebar">
			<!-- SIDEBAR USERPIC -->
			<div class="profile-userpic">
				<img src="/images/dankLogo.png" class="img-responsive" alt="Bild Fehler">
			</div>
			<!-- END SIDEBAR USERPIC -->
			<!-- SIDEBAR USER TITLE -->
			<div class="profile-usertitle">

                <div class="profile-usertitle-name">
                <?php

                    $user = new UserRepository();
                    $x = 'Bob Marley';
                    foreach ($user->usernameById($_SESSION['userId'][0]) as $x)
                    {
                        echo $x;
                    }


                ?>
				</div>
				
			</div>
			<!-- END SIDEBAR USER TITLE -->

			<!-- SIDEBAR MENU -->
			<div class="profile-usermenu">
				<ul class="nav">
					<!--<li class="active">
						<a href="#">
						<i class="glyphicon glyphicon-home"></i>
						New Picture </a>
					</li>
					<li>
						<a href="#">
						<i class="glyphicon glyphicon-user"></i>
						Change E-Mail </a>
					</li>
					<li>
						<a href="#" target="_blank">
						<i class="glyphicon glyphicon-ok"></i>
						Change Password </a>
					</li>
					<li>
						<a href="#">
						<i class="glyphicon glyphicon-flag"></i>
						Delete Account </a>
					</li>-->
					<li>
						<a href="/user/logout">
						<i class="glyphicon glyphicon-log-out"></i>
						Log Out </a>
					</li>
				</ul>
			</div>
			<!-- END MENU -->
		</div>
	</div>
	<div class="col-md-9">
	</div>
</div>
































