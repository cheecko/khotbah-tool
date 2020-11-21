<!-- <script id="table-template" type="text/x-jsrender"> -->
<script id="sermon-template" type="text/x-template">
    <div class="card-deck">
        <?php if(isset($_SESSION["user"])) { ?>
        <div class="col-xl-3 col-lg-4 col-md-6 d-flex mb-3 p-0">
            <div class="card border-info w-100 mb-0">
                <form class="input-file-box m-0 cursor-pointer">
                    <label for="inputFile" class="cursor-pointer d-flex flex-column justify-content-center align-items-center h-100">
                        <i class="fas fa-plus input-file-icon mb-2"></i>
                        <input class="d-none" type="file" name="files[]" id="inputFile" data-multiple-caption="{count} files selected" multiple />
                        <span><span class="font-weight-bold">Choose a file</span> or drag it here.</span>
                    </label>
                </form>
            </div>
        </div>
        <?php } ?>
        {{for data}}
            <div class="col-xl-3 col-lg-4 col-md-6 d-flex mb-3 p-0">
                <div class="card border-info w-100 mb-0" data-id="{{:id}}">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{:date}}
                        <?php if(isset($_SESSION["user"])) { ?>
                        <span class="edit-sermon p-1 cursor-pointer">
                            <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{:title}}</h4>
                        <h6 class="text-secondary">{{:speaker}}</h6>
                        <p class="text-info">{{:album}}</p>
                    </div>
                    <div class="card-footer p-0">
                        <audio class="w-100 audio-file" src="media/{{:audio_file}}" controls></audio>
                    </div>
                </div>
            </div>
        {{/for}}
    </div>
</script>

<script id="speaker-template" type="text/x-template">
    {{for data}}
        <option value="{{:id}}">{{:name}}</option>
    {{/for}}
</script>