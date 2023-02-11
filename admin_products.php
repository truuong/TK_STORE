<?php
require_once('./admin_header.php');
if(!empty($_POST)) {
	insertData('customers',$_POST['name'],$_POST['username'],$_POST['password'], $_POST['email'],$_POST['phone'],0);
	header('location:'. $_SERVER['PHP_SELF']);

}

?>
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
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</html>
<div class="section-top-border">
				<h3 class="mb-30 title_color">Products Management <button class="btn btn-info float-right mr-5" data-toggle="modal" data-target="#myModal">Add customer</button></h3>
				<div class="progress-table-wrap">
					<div class="progress-table">
						<div class="table-head ">
							<div class="serial">#</div>
							<div class="country">Name</div>
							<div class="visit">Email</div>
							<div class="percentage">Phone Number</div>
							<div class="percentage">Is vip</div>
							<div class="serial">More</div>
						</div>

						<div class="table-row">
							<div class="serial">01</div>
							<div class="country">Stella Gregory</div>
							<div class="visit">ozi@biv.mx</div>
							<div class="percentage">
                               97771446391
							</div>
							<div class="percentage">
							<div class="primary-radio ml-5">
									<input type="checkbox"  id="primary-radio" checked>
									<label for="primary-radio"></label>
								</div>
							</div>
                            <div class="visit"><a href="#"><span class="lnr lnr-arrow-right float-right"></span></a></div>

						</div>
						
						
				</div>
			</div>
				<a href="#" class="genric-btn btn-info float-right mr-4" style="border-radius: 15px;">Next  <span class="lnr ml-2 lnr-arrow-right"></span></a>
				<a href="#" class="genric-btn btn-info float-right mr-4" style="border-radius: 15px;"><span class="lnr mr-2 lnr-arrow-left"></span> Previous</a>

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
				</script>
