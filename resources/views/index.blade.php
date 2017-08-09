<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>ch test</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div class='container' id='app'>
		<header>
				<div class='header'>
					<ul>
						<li><a href="#people">СОТРУДНИКИ</a></li>
						<li><a href="#departments">ОТДЕЛЫ</a></li>
						<li><a href="#grid">СЕТКА</a></li>
					</ul>
				</div>
		</header>
		<grid  :departments='departments' :people='people'></grid>
		<departments  :departments='departments' :people='people' :showadd.sync='showAddDepartment' :showedit.sync='showEditDepartment' :error.sync='showErrorModal'>
		</departments>
		<people :departments='departments' :people='people' :showadd.sync='showAddPerson' :showedit.sync='showEditPerson'></people>
		<addDepartment :show.sync='showAddDepartment' v-show='showAddDepartment'></addDepartment>
        <editDepartment :departments='departments' :show.sync='showEditDepartment' v-show='showEditDepartment'></editDepartment>
        <addPerson :departments='departments' :show.sync='showAddPerson' v-show='showAddPerson'></addPerson>   
        <editPerson :departments='departments' :people='people' :show.sync='showEditPerson' v-show='showEditPerson'></editPerson> 
        <errorModal :show.sync='showErrorModal' v-show='showErrorModal'></errorModal>  
	</div>
	<script src="{{asset('js/app.js')}}"></script>
</body>
</html>