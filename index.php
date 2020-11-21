<?php 
    session_start();
    include "header.php";
    include "navbar.php";
    include "templates.php";
    $version = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FICG Sermon Audio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css?v=<?php echo $version ?>" />
    <script src="js/index.js?v=<?php echo $version ?>"></script>
</head>
<body>
    <div class="container-fluid">
        <form id="formSearch">
            <div class="input-group d-flex align-items-center my-3">
                <label for="inputSearch" class="col-4 col-sm-3 col-md-2 col-lg-1 m-0 pl-0"><h5>Search</h5></label>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputSearchButton"><span class="fa fa-search p-1"></span></span>
                </div>
                <input type="text" class="form-control col-8 col-sm-9 col-md-10 col-lg-11" id="inputSearch" placeholder="Search">
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <div id="sermonContainer"></div>
            </div>
        </div>
    </div>

    <?php if(isset($_SESSION["user"])) { ?>
    <!-- Modal -->
    <div class="modal fade" id="sermonDataModal" tabindex="-1" role="dialog" aria-labelledby="sermonDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="modalForm">
                            <div id="modalIDForm">
                                <div class="form-group row d-flex align-items-center">
                                <label for="modalID" class="col-sm-3 m-0">ID</label>
                                <input type="text" class="form-control col-sm-9" id="modalID" name="modalID" placeholder="ID" disabled>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="modalAudioTitle" class="col-sm-3 m-0">Title</label>
                                <input type="text" class="form-control col-sm-9" id="modalAudioTitle" name="modalAudioTitle" placeholder="Audio Title">
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="modalSpeaker" class="col-sm-3 m-0">Speaker</label>
                                <select class="form-control col-sm-9" id="modalSpeaker" name="modalSpeaker">
                                </select>
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="modalDate" class="col-sm-3 m-0">Date</label>
                                <input type="text" class="form-control col-sm-9" id="modalDate" name="modalDate">
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="modalAlbum" class="col-sm-3 m-0">Album</label>
                                <input type="text" class="form-control col-sm-9" id="modalAlbum" name="modalAlbum" placeholder="Album">
                            </div>
                            <div class="form-group row d-flex align-items-center">
                                <label for="modalAudioFile" class="col-sm-3 m-0">Audio File</label>
                                <input type="text" class="form-control col-sm-9" id="modalAudioFile" name="modalAudioFile" placeholder="AudioFile">
                            </div>  
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="modalButton" data-dismiss="modal">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
</body>
</html>