<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<link rel='stylesheet' type='text/css' href='style.css'/>
		<script>
		function sendMessage(){
			var text = $("#text").val();
			var title = $("#title").val();
			var type = $("#type").val();
			var expire = $("#expire").val();
			var priv = $("#priv").val();
			$.ajax({
				type: "POST",
				url: "pastebin.php",
				data: "text="+text+"&user_key="+ +"&title="+title+"&type="+type+"&expire="+expire+"&priv="+priv,
				success:function (result){
					$('#link').html("Voici votre lien: ")
					$("#linkResult").html(result);
				}
			});	
		}
		function test(){
			var username = $("#username").val();
			var pass = $("#password").val();
			$.ajax({
				type: "POST",
				url: "pastebin_login.php",
				data: "username="+username+"&pass="+pass,
				success:function (result){
					//Send the text to the server with the user_key
					if(result === 'Bad API request, invalid login'){
						$("#idUtilResult").html("Votre login est invalide!");
						return 0;
					}
					username = result;
					$('#idUtil').html("Voici votre ID: ");
					$("#idUtilResult").html(user_key);
					sendMessage();
				}
			});
		}	
		function hacking(){
			$("#hack").html($("#in").val());
		}
		</script>
	</head>
	<body>
		<span id="mainBack">
			<h1>PastEdit</h1>
			<textarea id="text" rows="4" cols="50" value="This is a test, ignore it!"></textarea>
			<div>Title: </div><input id="title" value="Test"></input>
			<div>Type: </div><input id="type" value="lua"></input>
			<div>Expire: </div>
			<select id="expire">
			  <option value="N">Never</option>
			  <option value="10M">10 Minutes</option>
			  <option value="1H">1 Hour</option>
			  <option value="1D">1 Day</option>
			  <option value="1W">1 Week</option>
			  <option value="2W">2 Week</option>
			  <option value="1M">1 Month</option>
			</select>
			<div>Private: </div>
			<select id="priv">
			  <option value="0">Public</option>
			  <option value="1">Unlisted</option>
			  <option value="2">Private</option>
			</select>
			<div>Username: </div><input id="username" value="lepouletsuisse"></input>
			<div>Password: </div><input id="password" type="password"></input>
			</br></br><button onclick="test();">Send</button>
			<div id="error"></div>
			</br><div id="idUtil"></div><span id="idUtilResult"></span></br>
			</br><div id="link"></div><span id="linkResult"></span>
			</br><img src="uol.png"/>
			<input id="in">
			<div onclick="hacking();">Clique me!</div>
			<div id="hack">Hack me!</div>
		</span>
	</body>
</html>