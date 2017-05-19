<!DOCTYPE>
<html>
	<title> Test data </title>
	<head>
	</head>

	<body>
			<h1> all quiery </h1>
			@foreach ($inquirys as $query)
				<h2> {{$query->inquirySource}}</h2>
			@endforeach
	</body>

</html>