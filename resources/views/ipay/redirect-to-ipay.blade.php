
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script type="text/javascript">
		function closethisasap() {
			document.forms["redirectpost"].submit();
		}
	</script>
</head>
<body onload="closethisasap();">
	<form name="redirectpost" method="post" action="{{$data['url']}}">
		<input type="hidden" name="TXN_UUID" value="{{$data['txn_uuid']}}"> 
	</form>
</body>
</html>