<!DOCTYPE html>
<html>
<head>
    <title></title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="image_upload/ImgUploader/croppie.css">


</head>
<body>

<form action="user-profile.php" method="POST">
<div id="status"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="card">
                    <form>
                        <div class="img-fluid">
                         <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="rounded-circle mg-thumbnail" alt="avatar" id="image"/></div>
                        <h6>Upload a different photo...</h6>
                        <input type=file class="img-upload-input-bs" editor="#img-upload-panel" target="#image" status="#status" passurl="" pshape="square" w=300 h=300 size="{150,150}"/></form>
 
                        <hr class="bg-white">

                    <label> <strong>Mrs Rebecca Sanders</strong></label>
                    <label class="email">Rebecca.S@website.com</label>
                    <div><h5>Profile <span class="badge badge-danger">Admin</span></h5></div>  
            </div>
        </div>
            <div class="col-md-9">
                <div class="row">
                <div class="col-md-12">

                    <h4>Personal Info</h4>

                <hr class="bg-white">

                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="colFormLabel" value="John">
                        </div>
                    </div>

                      <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="colFormLabel" Value="Doe">
                        </div>
                      </div>

                        <div class="form-group row">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Preferred Title</label>
                            <div class="col-sm-10">
                            <select class="form-control" id="title" name="title" >
                                <option value="Mr">Mr</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Gender</label>
                             <div class="col-sm-10">
                              <select class="form-control form-control" id="gender" name="gender">
                                <option Value="Male"> Male</option>
                              </select>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="colFormLabel" class="col-sm-2 col-form-label">Date of Birth</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="date" id="date" data-select="datepicker" value="2020-04-1996">
                      </div>
                    </div>

                <h4 class="pt-5">Contact Info</h4>

                <hr class="bg-white">

                <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="colFormLabel" value="john@mail.com">
                        </div>
                    </div>
                

                <div class="form-group row">
                          <label for="colFormLabel" class="col-sm-2 col-form-label">Cellphone</label>
                          <div class="col-sm-10">
                          <input type="tel" class="form-control" id="cellphone" placeholder="eg. 999-999-9999" name="cellphone" value="1-758-456-3456">
                    </div>
                </div>


                <h4 class="pt-5">Address</h4>

                <hr class="bg-white">

  
                  <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address 1</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" value="1234 Main St" name="address">
                  </div>
                  </div>

                  <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address 2</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="address2" value="Apartment, studio, or floor" name="address2">
                  </div>
              </div>

                    <div class="form-group row">
                      <label for="colFormLabel" class="col-sm-2 col-form-label">City</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" id="city" name="city" value="Arima">
                    </div>
                </div>

                    <div class="form-group row">
                      <label for="colFormLabel" class="col-sm-2 col-form-label">Country</label>
                      <div class="col-sm-10">
                      <select class="form-control" id="country" name="country" required>
                        <option value="Jamaica">Jamaica</option>
                      </select>
                    </div> 
                    </div>

                    <hr class="bg-white">

                    <div class="row">
                        <div class="col-md-6 offset-md-6 pb-5">
                            <input type="submit" class="btn btn-danger" value="Update Profile" name="update_profile">
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</form>
                

 <!-------------------------- Upload image Bootstrap Modal ----------------------->
                          <div class="modal fade" id="img-upload-panel">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Upload Profile Photo</h4>
                                <button type="button" class="img-remove-btn-bs close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row container">
                                <div class="col">
                                    <div class="img-edit-container"></div>
                                </div>
                                </div>
                                <div class="row container text-center">
                                <div class="col">
                                    <button type="button" class="btn btn-secondary img-rotate-left"><i class="fas fa-undo"></i></button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-secondary img-rotate-right"><i class="fas fa-redo"></i></button>
                                </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary img-remove-btn-bs">Close</button>
                                <button type="button" class="btn btn-primary img-upload-btn-bs" name="upload_image">Upload</button>
                            </div>
                            </div>
                        </div>
                    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="image_upload/ImgUploader/croppie.min.js"></script>
<script src="image_upload/ImgUploader/imguploader.bs.minify.js"></script>

</body>
</html>
