<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html lang="en">

    <head>
    
        <meta charset="utf-8">
        <title>Dashboard | Dooo - Movie & Web Series Portal App</title>

        <?php include("partials/header.php"); ?>
    
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php include("partials/topbar.php"); ?>

            
            <?php include("partials/sidebar.php"); ?>
            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

            	<div class="page-content">

            		<div class="container-fluid">



            			<!-- start page title -->

            			<div class="row align-items-center">

            				<div class="col-sm-6">

            					<div class="page-title-box">

            						<h4 class="font-size-18">Scrap</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Scrap</a></li>

            							<li class="breadcrumb-item active">Topcinema</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->

                        <div class="form" action="" method="post">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="card card-body">

                                        <h3 class="card-title mt-0">Add Contents (<a
                                                href="https://web3.topcinema.top/" target="_blank">Topcinema</a>)</h3>

                                        <hr>

                                        <div class="form-group">
                                            <div class="col-md-12 row">
                                                <div class="form-group col-md-2">
                        							<label>Content Type</label>
                        							<select class="form-control form-select mb-3" id="contentType">
                                                        <option>Movie</option>
                                                        <option>WebSeries</option>
                        							</select>
                        						</div>
                                                <div class="form-group col-md-2">
                                                    <label>Content TMDB ID</label>
                                                    <input required="" class="form-control col-md-12" id="contentTMDBID"
                                                        type="text" spellcheck="false" placeholder="012345"></input>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label>Content Topcinema URL</label>
                                                    <input required="" class="form-control col-md-12" id="contentTopCinemaURL"
                                                        type="text" spellcheck="false" placeholder="https://web3.topcinema.top/"></input>
                                                </div>
                                            </div>
                                            <br>
                                            <h3 class="card-title mt-0">Settings</h3>

                                            <hr>
                                            <div class="col-md-12 row">
                        						<div class="form-group col-md-2">
                        							<label>Free/Premium</label>
                        							<select class="form-control form-select mb-3" id="Free_Premium">
                                                        <option>Default</option>
                                                        <option>Free</option>
                                                        <option>Premium</option>
                        							</select>
                        						</div>

                                                <div class="form-group col-md-2">
                                                    <label>Stream Link Type</label>
                                                    <select id="streamLinkType" class="form-control" name="streamLinkType">
                                                        <option value="Free" selected="">Free</option>
                                                        <option value="Premium">Premium</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label>Download Link Type</label>
                                                    <select id="downloadLinkType" class="form-control" name="downloadLinkType">
                                                        <option value="Free" selected="">Free</option>
                                                        <option value="Premium">Premium</option>
                                                    </select>
                                                </div>
                                                
                        						<div class="form-group col-md-2">
                        							<label>Enable Download</label>
                        							<div>
                        								<input type="checkbox" id="Enable_Download" switch="bool" checked/>
                        								<label for="Enable_Download" data-on-label=""
                        									data-off-label=""></label>
                        							</div>
                        						</div>

                        						<div class="form-group col-md-4">
                        							<label>Publish</label>
                        							<div>
                        								<input type="checkbox" id="Publish_toggle" switch="bool"
                        									checked />
                        								<label for="Publish_toggle" data-on-label=""
                        									data-off-label=""></label>
                        							</div>
                        						</div>
                        					</div>
                                            <div class="form-group mb-3 row justify-content-end">
                        						<div class="col-md-1">
                        							<button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                        								onclick="FetchContentData()" id="create_btn" type="submit" aria-haspopup="true"
                        								aria-expanded="false">
                        								<i class="fas fa-plus mr-2"></i> fetch
                        							</button>
                        						</div>
                        					</div>
                                        </div>

                                    </div>

                                    <div class="card card-body" id="import_log" hidden>

                                        <h3 class="card-title mt-0">Import Log</h3>
                                        <br>
                                        <table id="datatable" class="table table-striped"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                            <thead>

                                                <tr>

                                                    <th>#</th>

                                                    <th>##</th>

                                                    <th>Thumbnail</th>

                                                    <th>Name</th>

                                                    <th>Description</th>

                                                    <th>Type</th>

                                                </tr>

                                            </thead>

                                        </table>
                                    </div>

                                </div>

                            </div>

                        </div>


            		</div> <!-- container-fluid -->

            	</div>


            	<?php include("partials/footer_rights.php"); ?>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include("partials/footer.php"); ?>

    <script>
        var code = "<?php echo $config->license_code ?>";
        if("<?php echo $config->tmdb_language; ?>" == "") {
            var tmdb_language = "en-US";
        } else {
            var tmdb_language = "<?php echo $config->tmdb_language; ?>";
        }
        
        var datatable = $('#datatable').dataTable({
            "order": [],
            "ordering": false,
            "paging": false,
            "info": false,
            "filter": false,
            "pageLength": 100,
            "destroy": true
        });

        var list_count = 1;

        function FetchContentData() {
            var contentType = document.getElementById("contentType").value;
            var contentTMDBID = document.getElementById("contentTMDBID").value;
            if (contentType == "Movie") {
                Swal.fire({
                    title: 'Please Wait',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onOpen: () => {
                        Swal.showLoading();
                        if (contentTMDBID != '') {
                            $.ajax({
                                type: 'GET',
                                url: "https://cloud.team-dooo.com/Dooo/TMDB/?code="+ "<?php echo $config->license_code; ?>" +"&filter=single&type=movie&id=" + contentTMDBID +"&id_type=TMDB&language=" + "<?php echo $config->tmdb_language; ?>",
                                dataType: 'json',
                                success: function (response) {
                                    Swal.close();
                                    if (response != false) {
                                        $('#datatable').DataTable().clear().draw();
                                        document.getElementById("import_log").hidden = false;
                                        $('#datatable').DataTable().row.add([
                                            list_count, getImportButton(1, contentTMDBID), getThumbnail(response.poster_path), response.title, response.overview, "<span class='badge bg-success'>Movie</span>"
                                        ]).draw();
                                        list_count++;
                                    } else {
                                        $('#datatable').DataTable().clear().draw();
                                        document.getElementById("import_log").hidden = true
                                        toastr.options = {
                                            "closeButton": false,
                                            "newestOnTop": true,
                                            "progressBar": false,
                                            "positionClass": "toast-top-right",
                                            "preventDuplicates": false,
                                            "onclick": null,
                                            "showDuration": "300",
                                            "hideDuration": "2000",
                                            "timeOut": "2000",
                                            "extendedTimeOut": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut"
                                        };
                                        toastr.error("No Data Found!");
                                    }
                                },
                                error: function (jq, status, message) {
                                
                                }
                            });

                        } else {
                            Swal.close();
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": true,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "2000",
                                "timeOut": "2000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };

                            toastr.warning("Please Add TMDB ID to Fetch Contents!");
                        }
                    },
                    onClose: () => {
                        
                    }
                });

            } else if (contentType == "WebSeries") {
                Swal.fire({
                    title: 'Please Wait',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onOpen: () => {
                        Swal.showLoading();
                        if (contentTMDBID != '') {
                            $.ajax({
                                type: 'GET',
                                url: "https://cloud.team-dooo.com/Dooo/TMDB/?code="+ code +"&filter=single&type=tv&id=" + contentTMDBID +"&id_type=TMDB&language=" + tmdb_language,
                                dataType: 'json',
                                success: function (response) {
                                    Swal.close();
                                    if (response != false) {
                                        $('#datatable').DataTable().clear().draw();
                                        document.getElementById("import_log").hidden = false;
                                        $('#datatable').DataTable().row.add([
                                            list_count, getImportButton(2, contentTMDBID), getThumbnail(response.poster_path), response.name, response.overview, "<span class='badge bg-success'>Web Series</span>"
                                        ]).draw();
                                        list_count++;
                                    } else {
                                        $('#datatable').DataTable().clear().draw();
                                        document.getElementById("import_log").hidden = true
                                        toastr.options = {
                                            "closeButton": false,
                                            "newestOnTop": true,
                                            "progressBar": false,
                                            "positionClass": "toast-top-right",
                                            "preventDuplicates": false,
                                            "onclick": null,
                                            "showDuration": "300",
                                            "hideDuration": "2000",
                                            "timeOut": "2000",
                                            "extendedTimeOut": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut"
                                        };
                                        toastr.error("No Data Found!");
                                    }
                                },
                                error: function (jq, status, message) {
                                    Swal.close();
                                    $('#datatable').DataTable().clear().draw();
                                    document.getElementById("import_log").hidden = true
                                    toastr.options = {
                                        "closeButton": false,
                                        "newestOnTop": true,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "2000",
                                        "timeOut": "2000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    };
                                    toastr.error("No Data Found!");
                                }
                            });

                        } else {
                            Swal.close();
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": true,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "2000",
                                "timeOut": "2000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };

                            toastr.warning("Please Add TMDB ID to Fetch Contents!");
                        }
                    },
                    onClose: () => {

                    }
                });

            }
            
        }

        function getImportButton(TYPE, ID) {
           return `<div id=` + ID + `><button id="importBtn" class='btn btn-primary dropdown-toggle waves-effect waves-light' onclick='addContent(`+TYPE+`, `+ID+`)' type='submit' aria-haspopup='true' aria-expanded='false'> <i class='fas fa-file-import'></i> &nbsp; Import </button></div>`;
        }

        function getThumbnail(data) {
            return '<img class="img-fluid" height="100" width="80" src="https://www.themoviedb.org/t/p/original'+ data +'" data-holder-rendered="true">';
        }

        function addContent(contentType, TMDBID) {
            if(contentType==1) {
                addMovie(TMDBID)
            } else if(contentType==2) {
                addWebSeries(TMDBID);
            }
        }

        function addMovie(TMDBID) {
            Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: () => {
                    Swal.showLoading();
                },
                onClose: () => {

                }
            });
            $.ajax({
                type: 'GET',
                url: "https://cloud.team-dooo.com/Dooo/TMDB/?code=" + "<?php echo $config->license_code; ?>" + "&filter=single&type=movie&id=" + TMDBID + "&id_type=TMDB&language=" + "<?php echo $config->tmdb_language; ?>",
                dataType: 'json',
                success: function (response) {
                    if (response != false) {
                        var TMDB_ID = response.id;
                        var NAME = response.title;
                        var DESCRIPTION = response.overview;
                        var GENRES = response.genres;
                        var RELEASE_DATE = response.release_date;
                        var RUNTIME = response.runtime;

                        var THUMBNAIL = "https://www.themoviedb.org/t/p/original"+response.poster_path;
                        var Poster = "https://www.themoviedb.org/t/p/original"+response.backdrop_path;

                        if (!TMDB_ID == "") {
                            var GENRES_json_obj = "";
                            for (var GENRE_Json_Content of GENRES) {
                                if (GENRES_json_obj == "") {
                                    GENRES_json_obj = GENRE_Json_Content.name + ", ";
                                } else {
                                    GENRES_json_obj = GENRES_json_obj + GENRE_Json_Content.name + ", ";
                                }
                            }
                            var GENRE_list = GENRES_json_obj.slice(0, -2);

                            var jsonObjects3 = {
                                "GenreList": GENRE_list
                            };
                            $.ajax({
                                type: 'POST',
                                url: '<?= site_url('Admin_api/initiateGenres') ?>',
                                data: jsonObjects3,
                                dataType: 'json',
                                success: function (response3) {

                                }
                            });

                            $.ajax({
                                type: 'GET',
                                url: "https://api.themoviedb.org/3/movie/" + TMDBID +
                                    "/videos?api_key=1bfdbff05c2698dc917dd28c08d41096",
                                dataType: 'json',
                                success: function (response2) {
                                    var Video_Data_Json = response2.results;
                                    for (var Video_Json_Content of Video_Data_Json) {
                                        if (Video_Json_Content.type == "Trailer") {
                                            if (Video_Json_Content.site == "YouTube") {
                                                var trailler_youtube_source =
                                                    "https://www.youtube.com/watch?v=" +
                                                    Video_Json_Content.key; 
                                            }
                                        }
                                    }

                                                    var Free_Premium = document.getElementById("Free_Premium").value;
                                                    if (Free_Premium == "Default") {
                                                        var Free_Premium_Count = 0;

                                                    } else if (Free_Premium == "Free") {
                                                        var Free_Premium_Count = 1;

                                                    } else if (Free_Premium == "Premium") {
                                                        var Free_Premium_Count = 2;
                                                    }

                                                    if ($('#Enable_Download').is(':checked')) {
                                                        var Enable_Download_Count = 1;
                                                    } else {
                                                        var Enable_Download_Count = 0;
                                                    }

                                                    if ($('#Publish_toggle').is(':checked')) {
                                                        var Publish_toggle_Count = 1;
                                                    } else {
                                                        var Publish_toggle_Count = 0;
                                                    }

                                                    var jsonObjects = {
                                                        "TMDB_ID": TMDB_ID,
                                                        "name": NAME,
                                                        "description": DESCRIPTION,
                                                        "genres": GENRES_json_obj,
                                                        "release_date": RELEASE_DATE,
                                                        "runtime": RUNTIME,
                                                        "poster": THUMBNAIL,
                                                        "banner": Poster,
                                                        "youtube_trailer": trailler_youtube_source,
                                                        "downloadable": Enable_Download_Count,
                                                        "type": Free_Premium_Count,
                                                        "status": Publish_toggle_Count,
                                                        "content_networks": "",
                                                        "custom_tag": 0,
                                                    };
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '<?= site_url('Admin_api/addMovie') ?>',
                                                        data: jsonObjects,
                                                        dataType: 'text',
                                                        success: function (addMovieResponse) {
                                                            Swal.close();
                                                            if (addMovieResponse != "") {
                                                                var contentTopCinemaURL = document.getElementById("contentTopCinemaURL").value;
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: "https://cloud.team-dooo.com/Dooo/api/topcinema/?code=" + "<?php echo $config->license_code; ?>" + "&type=movie&url="+contentTopCinemaURL,
                                                                    dataType: 'text',
                                                                    success: function (responseSources) {
                                                                        JSON.parse(responseSources).forEach((responseSource, index, array) => {
                                                                            
                                                                            var streamLinkType_Txt = document.getElementById("streamLinkType").value;
                                                                            if (streamLinkType_Txt == "Premium") {
                                                                                var streamLinkType = "1";
                                                                            } else if (streamLinkType_Txt == "Free") {
                                                                                var streamLinkType = "0";
                                                                            }
                                                                            var jsonObjects = {
                                                                                Movie_id: addMovieResponse,
                                                                                Label : "Multiquality",
                                                                                Order: 1,
                                                                                Quality: "",
                                                                                Size: "",
                                                                                Source: responseSource.source_type,
                                                                                Url: responseSource.source,
                                                                                Status: 1,
                                                                                skip_available_Count: 0,
                                                                                intro_start: "",
                                                                                intro_end: "",
                                                                                link_type: streamLinkType,
                                                                                end_credits_marker: '0',
                                                                                drm_uuid: "",
                                                                                drm_license_uri: ""
                                                                            };
                                                                            $.ajax({
                                                                                type: 'POST',
                                                                                url: '<?= site_url('Admin_api/add_movie_links') ?>',
                                                                                data: jsonObjects,
                                                                                dataType: 'text',
                                                                                success: function (add_movie_linksResponse) {
                                                                                    if (add_movie_linksResponse != "") {
                                                                                        
                                                                                    }
                                                                                }
                                                                            });

                                                                        
                                                                            var jsonObjects2 = {
                                                                                Movie_id: addMovieResponse,
                                                                                Label: "Multiquality",
                                                                                Order: 1,
                                                                                Quality: "",
                                                                                Size: "",
                                                                                Source: responseSource.source_type,
                                                                                Url: responseSource.source,
                                                                                download_type: "Internal",
                                                                                Status: 1
                                                                            };
                                                                            $.ajax({
                                                                                type: 'POST',
                                                                                url: '<?= site_url('Admin_api/add_movie_download_links') ?>',
                                                                                data: jsonObjects2,
                                                                                dataType: 'text',
                                                                                success: function (add_movie_download_linksResponse) {
                                                                                    if (add_movie_download_linksResponse != "") {
                                                                                        
                                                                                    }
                                                                                }
                                                                            });
                                                                        });

                                                                        Swal.close();
                                                                        if (response != "") {
                                                                            toastr.options = {
                                                                                "closeButton": false,
                                                                                "debug": false,
                                                                                "newestOnTop": true,
                                                                                "progressBar": false,
                                                                                "positionClass": "toast-top-right",
                                                                                "preventDuplicates": false,
                                                                                "onclick": null,
                                                                                "showDuration": "300",
                                                                                "hideDuration": "2000",
                                                                                "timeOut": "2000",
                                                                                "extendedTimeOut": "1000",
                                                                                "showEasing": "swing",
                                                                                "hideEasing": "linear",
                                                                                "showMethod": "fadeIn",
                                                                                "hideMethod": "fadeOut"
                                                                            };
                                                                            toastr.success("Movie Added Successfully!");
                                                                        }
                                                                    }
                                                                });
                                                                
                                                            }
                                                        }
                                                    });
                                }

                            });
                        }
                    } else {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "2000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.warning("No data found in database!");
                    }
                    Swal.close();
                },
                error: function (jq, status, message) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.warning("No data found in database!");
                    Swal.close();
                }
            });
        }

        function addWebSeries(TMDBID) {
            Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: ()=>{
                    Swal.showLoading();
                },
                onClose: ()=>{
                    
                }
            });
            $.ajax({
                type: 'GET',
                url: "https://cloud.team-dooo.com/Dooo/TMDB/?code=" + "<?php echo $config->license_code; ?>" + "&filter=single&type=tv&id=" + TMDBID +"&id_type=TMDB&language=" + "<?php echo $config->tmdb_language; ?>",
                dataType: 'json',
                success: function (response) {
                    if(response != false) {
                        var TMDB_ID = response.id;
                        var NAME = response.name;
                        var DESCRIPTION = response.overview;
                        var GENRES = response.genres;
                        var RELEASE_DATE = response.first_air_date;

                        var THUMBNAIL = "https://www.themoviedb.org/t/p/original"+response.poster_path;
                        var Poster = "https://www.themoviedb.org/t/p/original"+response.backdrop_path;

                        if (!TMDB_ID == "") {
                            var GENRES_json_obj = "";
                            for (var GENRE_Json_Content of GENRES) {
                                if (GENRES_json_obj == "") {
                                    GENRES_json_obj = GENRE_Json_Content.name + ", ";
                                } else {
                                    GENRES_json_obj = GENRES_json_obj + GENRE_Json_Content.name + ", ";
                                }
                            }
                            var GENRE_list = GENRES_json_obj.slice(0, -2);

                            var jsonObjects3 = {
                                "GenreList": GENRE_list
                            };
                            $.ajax({
                                type: 'POST',
                                url: '<?= site_url('Admin_api/initiateGenres') ?>',
                                data: jsonObjects3,
                                dataType: 'json',
                                success: function (response3) {
                                    if(response3 != "") {
                                        
                                    }
                                }
                            });

                            $.ajax({
                                type: 'GET',
                                url: "https://api.themoviedb.org/3/tv/" + TMDBID +
                                    "/videos?api_key=1bfdbff05c2698dc917dd28c08d41096",
                                dataType: 'json',
                                success: function (response2) {
                                    var Video_Data_Json = response2.results;
                                    for (var Video_Json_Content of Video_Data_Json) {
                                        if (Video_Json_Content.type == "Trailer") {
                                            if (Video_Json_Content.site == "YouTube") {
                                                var trailler_youtube_source =
                                                    "https://www.youtube.com/watch?v=" +
                                                    Video_Json_Content.key;
                                            }
                                        }
                                    }

                                    var Free_Premium = document.getElementById("Free_Premium").value;
                                            if (Free_Premium == "Default") {
                                                var Free_Premium_Count = 0;
        
                                            } else if (Free_Premium == "Free") {
                                                var Free_Premium_Count = 1;
        
                                            } else if (Free_Premium == "Premium") {
                                                var Free_Premium_Count = 2;
                                            }
        
                                            if ($('#Enable_Download').is(':checked')) {
                                                var Enable_Download_Count = 1;
                                            } else {
                                                var Enable_Download_Count = 0;
                                            }
        
                                            if ($('#Publish_toggle').is(':checked')) {
                                                var Publish_toggle_Count = 1;
                                            } else {
                                                var Publish_toggle_Count = 0;
                                            }
        
                                            var jsonObjects = {
                                                "TMDB_ID": TMDBID,
                                                "name": NAME,
                                                "description": DESCRIPTION,
                                                "genres": GENRES_json_obj,
                                                "release_date": RELEASE_DATE,
                                                "poster": THUMBNAIL,
                                                "banner": Poster,
                                                "youtube_trailer": trailler_youtube_source,
                                                "downloadable": Enable_Download_Count,
                                                "type": Free_Premium_Count,
                                                "status": Publish_toggle_Count,
                                                "content_networks": "",
                                                "custom_tag": 0,
                                            };
                                            $.ajax({
                                                type: 'POST',
                                                url: '<?= site_url('Admin_api/add_web_series') ?>',
                                                data: jsonObjects,
                                                dataType: 'text',
                                                timeout: 0,
                                                success: function (add_web_seriesResponse) {
                                                    if (add_web_seriesResponse != "") {
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: "https://api.themoviedb.org/3/tv/" + TMDBID +
                                                                "?api_key=1bfdbff05c2698dc917dd28c08d41096&language=" + "<?php echo $config->tmdb_language; ?>",
                                                            dataType: 'json',
                                                            timeout: 0,
                                                            success: function (responseGetSeasion) {
                                                                
                                                                responseGetSeasion.seasons.forEach((season_data, index, array) => {
                                                                    var season_data_index = index;
                                                                    var season_data_array = array;
                                                                    
                                                                    if(season_data.name == "Specials" && season_data.season_number == 0) {
                                                                        
                                                                    } else {

                                                                        var jsonObjects = {
                                                                            "webseries_id": add_web_seriesResponse,
                                                                            "modal_Season_Name": season_data.name,
                                                                            "modal_Order": season_data.season_number,
                                                                            "Modal_Status": 1
                                                                        };
                                                                        $.ajax({
                                                                            type: 'POST',
                                                                            url: '<?= site_url('Admin_api/add_season ') ?>',
                                                                            data: jsonObjects,
                                                                            dataType: 'text',
                                                                            timeout: 0,
                                                                            success: function (add_seasonResponse) {
                                                                                $.ajax({
                                                                                    type: 'GET',
                                                                                    url: "https://api.themoviedb.org/3/tv/" + TMDBID +
                                                                                        "/season/" + season_data.season_number + "?api_key=1bfdbff05c2698dc917dd28c08d41096&language=" + "<?php echo $config->tmdb_language; ?>",
                                                                                    dataType: 'json',
                                                                                    timeout: 0,
                                                                                    success: function (addEpisoadResponse) {
            
                                                                                        var episodes_arr = addEpisoadResponse.episodes;
    
                                                                                        var contentTopCinemaURL = document.getElementById("contentTopCinemaURL").value;
                                                                                        $.ajax({
                                                                                            type: 'GET',
                                                                                            url: "https://cloud.team-dooo.com/Dooo/api/topcinema/?code=" + "<?php echo $config->license_code; ?>" + "&type=series&season="+season_data.season_number+"&url=" + contentTopCinemaURL,
                                                                                            dataType: 'json',
                                                                                            timeout: 0,
                                                                                            success: function (responseSeriesSources) {
                                                                                                var streamLinkType_Txt = document.getElementById("streamLinkType").value;
                                                                                                if (streamLinkType_Txt == "Premium") {
                                                                                                    var streamLinkType = "1";
                                                                                                } else if (streamLinkType_Txt == "Free") {
                                                                                                    var streamLinkType = "0";
                                                                                                }
                    
                                                                                                responseSeriesSources.episoads.forEach((responseEpisoadSource, index, array) => {
                                                                                                    var episoadSource_index = index;
                                                                                                    var episoadSource_array = array;

                                                                                                    var episode_data = episodes_arr[index];
                    
                                                                                                    var jsonObjects = {
                                                                                                        "season_id": add_seasonResponse,
                                                                                                        "modal_Episodes_Name": episode_data.name,
                                                                                                        "modal_Thumbnail": "https://www.themoviedb.org/t/p/original" + episode_data.still_path,
                                                                                                        "modal_Order": episode_data.episode_number,
                                                                                                        "modal_Source": responseEpisoadSource.source_type,
                                                                                                        "modal_Url": responseEpisoadSource.source,
                                                                                                        "modal_Description": episode_data.overview,
                                                                                                        "Downloadable": 1,
                                                                                                        "Type": streamLinkType,
                                                                                                        "Status": 1,
                                                                                                        "add_modal_skip_available_Count": "0",
                                                                                                        "add_modal_intro_start": "",
                                                                                                        "add_modal_intro_end": "",
                                                                                                        "end_credits_marker": "",
                                                                                                        "drm_uuid_addModal": "",
                                                                                                        "drm_license_uri_addModal": "",
                                                                                                    };
                                                                                                    $.ajax({
                                                                                                        type: 'POST',
                                                                                                        url: '<?= site_url('Admin_api/add_episode') ?>',
                                                                                                        data: jsonObjects,
                                                                                                        dataType: 'text',
                                                                                                        timeout: 0,
                                                                                                        success: function (add_episodeResponse) {
                    
                                                                                                            var jsonObjects2 = {
                                                                                                                "EpisodeID": add_episodeResponse,
                                                                                                                "Label": episode_data.name,
                                                                                                                "Order": episode_data.episode_number,
                                                                                                                "Quality": "",
                                                                                                                "Size": "",
                                                                                                                "Source": responseEpisoadSource.source_type,
                                                                                                                "Url": responseEpisoadSource.source,
                                                                                                                "download_type": "Internal",
                                                                                                                "Status": 1
                                                                                                            };
                                                                                                            $.ajax({
                                                                                                                type: 'POST',
                                                                                                                url: '<?= site_url('Admin_api/add_episode_download_link') ?>',
                                                                                                                data: jsonObjects2,
                                                                                                                dataType: 'text',
                                                                                                                timeout: 0,
                                                                                                                success: function (response2) {

                                                                                                                    if(responseGetSeasion.seasons[0].name == "Specials") {
                                                                                                                        if(season_data_array.length-1 == season_data_index) {
                                                                                                                            if(episoadSource_array.length == episoadSource_index+1) {
                                                                                                                                Swal.close();
                                                                                                                            
                                                                                                                                toastr.options = {
                                                                                                                                    "closeButton": false,
                                                                                                                                    "debug": false,
                                                                                                                                    "newestOnTop": true,
                                                                                                                                    "progressBar": false,
                                                                                                                                    "positionClass": "toast-top-right",
                                                                                                                                    "preventDuplicates": false,
                                                                                                                                    "onclick": null,
                                                                                                                                    "showDuration": "300",
                                                                                                                                    "hideDuration": "2000",
                                                                                                                                    "timeOut": "2000",
                                                                                                                                    "extendedTimeOut": "1000",
                                                                                                                                    "showEasing": "swing",
                                                                                                                                    "hideEasing": "linear",
                                                                                                                                    "showMethod": "fadeIn",
                                                                                                                                    "hideMethod": "fadeOut"
                                                                                                                                };
                                                                                                                                toastr.success("Web Series Scraped Successfully!");
                                                                            
                                                                                                                                $('#importBtn').html(` <i class='fas fa-file-import'></i> &nbsp; Imported `)
                                                                                                                                $('#importBtn').removeClass('btn btn-primary dropdown-toggle waves-effect waves-light');
                                                                                                                                $('#importBtn').addClass('btn btn-success dropdown-toggle waves-effect waves-light');
                                                                                                                            }
                                                                                                                        }
                                                                                                                    } else {
                                                                                                                        if(season_data_array.length == season_data_index) {
                                                                                                                            if(episoadSource_array.length == episoadSource_index+1) {
                                                                                                                                Swal.close();
                                                                                                                            
                                                                                                                                toastr.options = {
                                                                                                                                    "closeButton": false,
                                                                                                                                    "debug": false,
                                                                                                                                    "newestOnTop": true,
                                                                                                                                    "progressBar": false,
                                                                                                                                    "positionClass": "toast-top-right",
                                                                                                                                    "preventDuplicates": false,
                                                                                                                                    "onclick": null,
                                                                                                                                    "showDuration": "300",
                                                                                                                                    "hideDuration": "2000",
                                                                                                                                    "timeOut": "2000",
                                                                                                                                    "extendedTimeOut": "1000",
                                                                                                                                    "showEasing": "swing",
                                                                                                                                    "hideEasing": "linear",
                                                                                                                                    "showMethod": "fadeIn",
                                                                                                                                    "hideMethod": "fadeOut"
                                                                                                                                };
                                                                                                                                toastr.success("Web Series Scraped Successfully!");
                                                                            
                                                                                                                                $('#importBtn').html(` <i class='fas fa-file-import'></i> &nbsp; Imported `)
                                                                                                                                $('#importBtn').removeClass('btn btn-primary dropdown-toggle waves-effect waves-light');
                                                                                                                                $('#importBtn').addClass('btn btn-success dropdown-toggle waves-effect waves-light');
                                                                                                                            }
                                                                                                                            
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            });
                                                                                                        }
                                                                                                    });
                                                                                                });
                                                                                            },
                                                                                            error: function (jq, status, message) {
                                                                                                toastr.options = {
                                                                                                    "closeButton": false,
                                                                                                    "debug": false,
                                                                                                    "newestOnTop": true,
                                                                                                    "progressBar": false,
                                                                                                    "positionClass": "toast-top-right",
                                                                                                    "preventDuplicates": false,
                                                                                                    "onclick": null,
                                                                                                    "showDuration": "300",
                                                                                                    "hideDuration": "2000",
                                                                                                    "timeOut": "2000",
                                                                                                    "extendedTimeOut": "1000",
                                                                                                    "showEasing": "swing",
                                                                                                    "hideEasing": "linear",
                                                                                                    "showMethod": "fadeIn",
                                                                                                    "hideMethod": "fadeOut"
                                                                                                };
                                                                                                toastr.warning("No data found in Scrapper Site!");
                                                                                                Swal.close();
                                                                                            }
                                                                                        });
                                                                                    },
                                                                                    error: function (jq, status, message) {
            
                                                                                    }
                                                                                });
                                                                            }
                                                                        });
                                                                        
                                                                    }
                                                                });
        
                                                            },
                                                            error: function (jq, status, message) {
                                                                
                                                            }
                                                        });
                                                    }
                                                }
                                            });

                                    

                                }

                            });
                        }
                    } else {
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "2000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.warning("No data found in database!");
                    }
                },
                error: function (jq, status, message) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.warning("No data found in database!");
                    Swal.close();
                }
            });
        }
        
    </script>