$(document).ready(function() {      
    var myHelpers = {
        formatDate: function(date) {
            var tmp = date.split("-");
            date = tmp[2] + "." + tmp[1] + "." + tmp[0];
            return date;
        },
        stringify: function(data) {
            if(data) {
                return JSON.stringify(data);
            }
            return false;
        }
    };
    
    $.views.helpers(myHelpers);
    
    getSermon();
    getSpeaker();
    setDate();

    $("#sermonContainer").on("click", ".edit-sermon", function() {
        $("#sermonDataModal").modal();
        var id = $(this).closest(".card").data("id");
        var data = window.sermonData.find(function(data) {
            return data.id == id;
        });

        $("#modalTitle").text("Edit Sermon");
        $("#modalButton").text("Save changes");

        $("#modalIDForm").prop("hidden", false);
        $("#modalID").val(data.id);
        $("#modalAudioTitle").val(data.title);
        $("#modalSpeaker").val(data.speaker_id);
        $("#modalDate").datepicker("setDate", data.date);
        $("#modalAlbum").val(data.album);
        $("#modalAudioFile").val(data.audio_file);
    })
    $("#sermonContainer").on("dragover", ".input-file-box", function(e) {
        e.preventDefault();
    })
    $("#sermonContainer").on("dragleave", ".input-file-box", function(e) {
        e.preventDefault();
    })
    $("#sermonContainer").on("drop", ".input-file-box", function(e) {
        e.preventDefault();
        var dataTransfer = e.originalEvent.dataTransfer;
        console.log(dataTransfer.files);
        if (dataTransfer.files) {
            $("#inputFile")[0].files = dataTransfer.files;
            uploadFile();
            // console.log($("#inputFile")[0].files);
            // var reader = new FileReader();
            
            // reader.onload = function(e) {
            //     console.log(e);
            //     console.log(e.target);
            //     console.log(e.target.result);
            // };
            // reader.readAsArrayBuffer($("#inputFile")[0].files[0]);
            // console.log(reader);
        }
    })
    $("#sermonContainer").on("change", ".input-file-box", function(e) {
        e.preventDefault();
        uploadFile();
    })
});

function getSermon() {
    $.ajax({
        type: 'GET',
        url: "model/getSermon.php",
        success: function(response) {
            if(response.success) {
                window.sermonData = response.data;
                var template = $.templates("#sermon-template");
                var htmlOutput = template.render(response);
                $("#sermonContainer").html(htmlOutput);

                setCurrentTime();
                saveCurrentTime();
            
            }else{
                alertify.error(response.error_message);
            }     
        },
        error: function() {
            alertify.error("AJAX call is failed!");
        }
    });
}

function getSpeaker() {
    $.ajax({
        type: 'GET',
        url: "model/getSpeaker.php",
        success: function(response) {
            if(response.success) {
                var template = $.templates("#speaker-template");
                var htmlOutput = template.render(response);
                $("#modalSpeaker").html(htmlOutput);
            }else{
                alertify.error(response.error_message);
            }     
        },
        error: function() {
            alertify.error("AJAX call is failed!");
        }
    });
}

function setDate() {
    $("#modalDate").datepicker({ dateFormat: 'dd.mm.yy' });
    var today = new Date();
    var interval = 30;
    var endDate;
  
    $("#modalDate").datepicker("setDate", today);
}

function uploadFile() {
    var form = $(".input-file-box")[0];
    var formData = new FormData(form);

    $.ajax({
        type: "POST",
        url: "model/uploadFile.php",
        data: formData,    
        contentType: false,
        processData: false,
        success: function(response) {
            if(response.success) {
                alertify.success(response.message);
                getSermon();
            }else{
                alertify.error(response.message);
            }
        },
        error: function() {
            alertify.error("AJAX call is failed!");
        }
    })
}

function setCurrentTime() {
    var storageData = localStorage.getItem("audioCurrentTime");
    
    if(!storageData) {
        return false;
    }

    storageData = JSON.parse(storageData);

    $(".audio-file").on("loadeddata", function(e) {
        var id = $(this).closest(".card").data("id");

        storageData.forEach(function(data) {
            if(data.id == id) {
                console.log(id);
                var audio = $(".card[data-id='"+ data.id +"'] .audio-file")[0];
                audio.currentTime = data.currentTime;
            }
        });
    })

}

function saveCurrentTime() {
    $(".audio-file").on("timeupdate", function(e) {
        var currentTime = this.currentTime;
        var id = $(this).closest(".card").data("id");
        var data = {
            id: id,
            currentTime: currentTime,
        }

        var storageData = localStorage.getItem("audioCurrentTime");
        if(storageData) {
            storageData = JSON.parse(storageData);
        }else{
            storageData = [];
        }

        var index = storageData.findIndex(function(audio) {
            return audio.id == id;
        })

        if(index == -1) {
            storageData.push(data);
        }else{
            storageData[index].currentTime = currentTime;
        }

        storageData = JSON.stringify(storageData);
        localStorage.setItem("audioCurrentTime", storageData);
    })
}
