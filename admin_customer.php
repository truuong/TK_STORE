<?php
require_once('./admin_header.php');
require_once('./execute/global.php');
// Haven't check form name and the other
$new_customer = 0;
session_start();
if(isset($_SESSION['success_del']))
 {
	echo '<div id="al_sc" class="alert alert-success">You have removed your selected customers</div>';
	unset($_SESSION['success_del']);
}
else if(isset($_SESSION['success_insert'])) {
	echo '<div id="al_sc" class="alert alert-success">Added a new customer</div>';
	$new_customer= getCustomData('SELECT * FROM customers WHERE ctm_username = "'. $_SESSION['success_insert'] .'"');
 }
 
else if(isset($_SESSION['success_edit'])) {
	echo '<div id="al_sc" class="alert alert-success">The customer: <strong>'. $_SESSION['success_edit'] .'</strong> has been edited </div>';
 }

if(!empty($_POST) && !empty($_POST['name'])&& !empty($_POST['username'])&& !empty($_POST['password'])&& !empty($_POST['email'])&& !empty($_POST['phone'])) {
	insertData('customers',$_POST['name'],$_POST['username'],$_POST['password'], $_POST['email'],$_POST['phone'],0);
	$_SESSION['success_insert'] = $_POST['username'];
	header_page();
}
else if(isset($_POST['name_edit']))
 {
  $ctm_field = explode(',',getField('customers'));
  $ctm_edit = ['name_edit','password_edit','email_edit','phone_edit'];
  for ($i=0; $i < count($ctm_edit); $i++) { 
	if($i >= 1) {
		if($ctm_field[$i+1] == 'ctm_phone') {
			customData('UPDATE customers SET ctm_phone = "'. $_POST[$ctm_edit[$i]] .'" WHERE ctm_username = "'. $_POST['username_edit'] .'"');
		}
		else {
			editData('customers',$ctm_field[$i+1],$_POST[$ctm_edit[$i]],'ctm_username',$_POST['username_edit']);
		}
	}
	else {
		editData('customers',$ctm_field[$i],$_POST[$ctm_edit[$i]],'ctm_username',$_POST['username_edit']);
	}
}
	$_SESSION['success_edit'] = $_POST['username_edit'];
	echo $_SESSION['success_edit'];
	header_page();
	die();
 }
if(isset($_GET['del']))
 {
		for ($i=0; $i < count(explode(';',$_GET['del'])); $i++) { 
			deleteData('customers','ctm_username',explode(';',$_GET['del'])[$i]);
		}
		$_SESSION['success_del'] = '1';
		header_page();
 }
 if(isset($_GET['vip']))
  {
	editData('customers','ctm_isvip',getCustomData('SELECT * FROM customers WHERE ctm_username = "'. $_GET['vip'] .'"')[0][5] == '1' ? '0' : '1','ctm_username',$_GET['vip']);
  }


?>
<style>
	.table-row {
		transition-duration: 0.2s;
	}
</style>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create a customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<button class="btn btn-secondary d-block ml-auto" onclick="random()">Random account</button>
      		<form method="post" id="create_customer">
				  <div>
					  <label>Full name</label>
					  <input type='text' name='name'  placeholder="Enter your fullname" class="form-control" />
					</div>
					<div>
						<label>Username</label>
						<input type='text' name='username' placeholder="Enter your username" class="form-control" />
					</div>
					<div>
						<label>Password</label>
						<input type='password' name='password' placeholder="Enter your password" class="form-control" />
					</div>
					<div>
						<label>Email</label>
						<input type='email' name='email' placeholder="Enter your email" class="form-control" />
					</div>
					<div>
						<label>Phone number</label>
						<input type='text' name='phone' placeholder="Enter your phone number" class="form-control" />
					</div>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="create_customer" class="btn btn-info">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">More info customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<form method="post" id="edit_customer" onsubmit="return save_edit()">
				  <div>
					  <label>Full name</label>
					  <input type='text' name='name_edit'  placeholder="Enter your fullname" class="form-control" />
					</div>
					
					<div>
						<label>Username</label>
						<input type='text' name='username_edit' class="form-control" readonly  />
					</div>
					<div>
						<label>Password</label>
						<input type='password' name='password_edit' placeholder="Enter your password" class="form-control" />
					</div>
					<div>
						<label>Email</label>
						<input type='email' name='email_edit' placeholder="Enter your email" class="form-control" />
					</div>
					<div>
						<label>Phone number</label>
						<input type='text' name='phone_edit' placeholder="Enter your phone number" class="form-control" />
					</div>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="edit_customer" class="btn btn-success">Save changes</button>
        <button type="submit" form="edit_customer" class="btn btn-info">More</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</html>
<div class="section-top-border">
				<h3 class="mb-30 title_color">Products Management <button class="btn btn-info float-right mr-5" data-toggle="modal" data-target="#myModal">Add customer</button><button style="background-color: #f67590;" class="btn float-right mr-5 text-white btn-delete" disabled data-toggle="modal" data-target="#myModal" onclick="delete_customer()">Delete</button></h3>
				<div class="progress-table-wrap">
					<div class="progress-table">
						<div class="table-head">
							<div class="serial">#</div>
							<div class="serial">Name</div>
							<div class="serial">Username</div>
							<div class="serial">Password</div>
							<div class="serial">Email</div>
							<div class="serial">Phone number</div>
							<div class="serial">Vip</div>
							<div class="serial">More</div>
						</div>
	<?php
	$index_col = isset($_GET['index_col']) ? $_GET['index_col'] : 0;
	if($new_customer != 0 || isset($_SESSION['success_edit'])) {
		if(isset($_SESSION['success_edit'])) {
			$new_customer = getCustomData('SELECT * FROM customers WHERE ctm_username = "'. $_SESSION['success_edit'] .'"');
			$data = getCustomData('SELECT * FROM customers WHERE NOT ctm_username = "'. $_SESSION['success_edit'] .'"  LIMIT ' . $index_col . ',' . $index_col+11);
	unset($_SESSION['success_edit']);

		}
		else {
			$data = getCustomData('SELECT * FROM customers WHERE NOT ctm_username = "'. $_SESSION['success_insert'] .'"  LIMIT ' . $index_col . ',' . $index_col+11);
		}
		echo '	<div class="table-row text-success">
				<div class="serial d-flex flex-row-reverse justify-content-end align-items-center "><label for="chk"  >New</label><input class="d-none" type="checkbox" id="chk"  class="form-check" /></div>
				<div class="serial name">'. $new_customer[0][0] .'</div>
				<div class="serial username">'. $new_customer[0][1] .'</div>
				<div class="serial password">'. $new_customer[0][2] .'</div>
				<div class="serial email text-truncate" title="'. $new_customer[0][3] .'">'. $new_customer[0][3] .'</div>
				<div class="serial phone">'. $new_customer[0][4] .'</div>
				<div class="serial">
				<div class="primary-radio">
						<input type="checkbox" id="primary-radio">
						<label for="primary-radio"></label>
					</div>
				</div>
				<div class="serial"></div>
			</div>';
	unset($_SESSION['success_insert']);
			}
	
	else {
		$data = getCustomData('SELECT * FROM customers LIMIT ' . $index_col . ',' . $index_col+11);
	}
		if(!empty($data)) {
			for($i = 0 ; $i < count($data) ; $i++) {
				echo '	<div class="table-row">
				<div class="serial d-flex flex-row-reverse justify-content-end align-items-center "><label for="chk_'. $i .'"  >'. $i .'</label><input class="d-none" type="checkbox" id="chk_'. $i .'"  class="form-check" /></div>
				<div class="serial name">'.$data[$i][0].'</div>
				<div class="serial username">'. $data[$i][1].'</div>
				<div class="serial password">'. $data[$i][2].'</div>
				<div class="serial email text-truncate" title="'. $data[$i][3] .'">'. $data[$i][3].'</div>
				<div class="serial phone">'. $data[$i][4] .'</div>
				<div class="serial">
				<div class="primary-radio">
						<input type="checkbox" id="primary-radio'. $i .'" '. ($data[$i][5] == '0' ? '' : 'checked')  .'>
						<label for="primary-radio'. $i .'" onclick="change_vip('. $i .')"></label>
					</div>
				</div>
				<div class="serial"><a href="#"><span class="lnr lnr-arrow-right float-right" data-toggle="modal" data-target="#edit" onclick="edit_customer('. $i .')"></span></a></div>

			</div>';
			}
		}
		else {
			echo '<div class="text-center p-2">Nothing here</div>';
			die();
		}
	?>
						
						
				</div>
			</div>
				<a href="admin_customer.php?index_col=<?=isset($_GET['index_col']) ? $_GET['index_col']+11:11?>" class="genric-btn btn-info float-right mr-4" style="border-radius: 15px;">Next <span class="lnr ml-2 lnr-arrow-right"></span></a>
				<a href="admin_customer.php?index_col=<?=isset($_GET['index_col']) && $_GET['index_col'] >=11 ? $_GET['index_col']-11: 0 ?>" class="genric-btn btn-info float-right mr-4" style="border-radius: 15px;"><span class="lnr mr-2 lnr-arrow-left"></span> Previous</a>
				<script>      
function random() {
$.ajax({
  url: 'https://randomuser.me/api/',
  dataType: 'json',
  success: function(data) {
	console.log(data);
	console.log(data.results[0].name);
	document.getElementsByName('name')[0].value = data.results[0].name.last+ ' ' + data.results[0].name.first
	document.getElementsByName('username')[0].value = data.results[0].login.username
	document.getElementsByName('password')[0].value = data.results[0].login.password
	document.getElementsByName('email')[0].value = data.results[0].email
	document.getElementsByName('phone')[0].value = data.results[0].phone
  }
});
			
					}
					var select_del = document.querySelectorAll('label[for^=chk]')
					var inp_del = document.querySelectorAll('input[id^=chk]')
					var data_del = []
					var count = 0;
					for (let i = 0; i < select_del.length; i++) {
						select_del[i].onclick = function() {
								if((inp_del[i].checked)) {
							document.getElementsByClassName('table-row')[i].style.backgroundColor = 'white'
							document.getElementsByClassName('table-row')[i].style.color = '#797979'
							count-- 
							if(count <= 0) {
								document.getElementsByClassName('btn-delete')[0].setAttribute('disabled','true')
							}
								}

									else {
										document.getElementsByClassName('table-row')[i].style.backgroundColor = '#17a2b8'
										count++
										if(count > 0) {

											document.getElementsByClassName('table-row')[i].style.color = 'white'	
											document.getElementsByClassName('btn-delete')[0].removeAttribute('disabled')
										}
									
									}
									
								}
								  
						}
	function delete_customer() {
		let text = ''
	for (let i = 0; i < inp_del.length; i++) {
			if(inp_del[i].checked) {
				text+= document.getElementsByClassName('username')[i].innerHTML + ';'
			}

	}
	if(confirm('Are you sure to continue delete?')) {
		location.href = 'admin_customer.php?del='+text.substring(0,text.length-1)
	}
	}					
	var fields = ['name','username','password','email','phone']
	var inp_edit = []
	function edit_customer(index) {
		inp_edit = document.querySelectorAll('input[name$=_edit]')
		for (let i = 0; i < inp_edit.length; i++) {
				inp_edit[i].value = document.getElementsByClassName(fields[i])[index].innerHTML
		}
	}
	   function save_edit() {
		if(confirm('Are you sure to continue?')) {
			return true		
		}
		else {
			return false
		}
	   }
	   function change_vip(index) {
		   let obj_vip = (document.getElementsByClassName('username')[index].innerHTML)
		 if(confirm('Are you sure to toggle '+ obj_vip + ' vip state? '))
		  {
			location.href = 'admin_customer.php?vip='+obj_vip;
		  }
			

	   }
				</script>
