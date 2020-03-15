<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<style type="text/css">
		body{
			margin:0px;
			padding:0px;
		}

		.container{
			position:absolute;
			top: 10%;
			float:left;
			padding-left:20px;
			float:left;
			overflow: hidden;
		}

		ul.thumb{
			margin:0 auto;
			padding: 0;
			float: left;
		}

		ul.thumb li{
			list-style: none;
			margin: 5px;
			padding:4px;
			width:auto;
			height:auto;
			border:1px solid rgba(0,0,0,.2);
			overflow: hidden;
		}

		ul.thumb li img {
			width:100%;
		}

		.imgBox{
			float:left;
			width:500px;
			height:500px;
			margin:6px;
			border:1px solid rgba(0,0,0,.2);
			overflow: hidden;
		}

		.imgBox img{
			width: 100%;
		}
	

	</style>

	<div class="container">
		<ul class="thumb">

			<li><a href="images/Apple/4/img1.jpg" target="imgBox"><img src="images/Apple/4/thumb1.jpg"></a></li>

			<li><a href="images/Apple/4/img2.jpg" target="imgBox"><img src="images/Apple/4/thumb2.jpg"></a></li>

			<li><a href="images/Apple/4/img3.jpg" target="imgBox"><img src="images/Apple/4/thumb3.jpg"></a></li>

		</ul>
		<div class="imgBox"><img src="images/Apple/4/Apple-iPhone-11-pro-max.jpg"></div>
	</div>
</body>
</html>