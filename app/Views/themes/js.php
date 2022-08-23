<script src=<?= base_url() ?>/assets/js/vendor.min.js></script>
<script src=<?= base_url()?>/assets/libs/parsleyjs/parsley.min.js></script>
<!-- Plugins js Wizard -->
<script src="<?= base_url()?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
<script src="<?= base_url()?>/assets/libs/mohithg-switchery/switchery.min.js"></script>
<script src="<?= base_url()?>/assets/libs/multiselect/js/jquery.multi-select.js"></script>
<script src="<?= base_url()?>/assets/libs/select2/js/select2.min.js"></script>
<script src="<?= base_url()?>/assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
<script src="<?= base_url()?>/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
<script src="<?= base_url()?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?= base_url()?>/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<!-- Form-Pickers js-->
<script src="<?= base_url()?>/assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url()?>/assets/libs/flatpickr/l10n/<?= service('request')->getLocale() . '.js' ?>"></script>
<script src="<?= base_url()?>/assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="<?= base_url()?>/assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="<?= base_url()?>/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- Sweet Alerts js -->
<script src="<?= base_url()?>/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Plugins js-->
<script src="<?= base_url()?>/assets/libs/nestable2/jquery.nestable.min.js"></script>
<!-- js jsTree -->
<script src="<?= base_url()?>/assets/vakata/jstree/dist/jstree.min.js"></script>
<!-- App js-->
<script src="<?= base_url() ?>/assets/js/pages/form-pickers.init.js"></script>
<!-- App js-->
<script src="<?= base_url()?>/assets/chained/chained.js"></script>

<!-- third party js -->
<script src="<?= base_url()?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>

<!-- Intl-->
<script src="<?= base_url()?>/assets/build/js/intlTelInput.js"></script>
<!-- Plugins js -->
<script src="<?= base_url()?>/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="<?= base_url()?>/assets/libs/dropify/js/dropify.min.js"></script>
<!-- Datatables init -->
<script src="<?= base_url()?>/assets/js/pages/datatables.init.js"></script>

<script src="<?= base_url()?>/assets/js/app.js"></script>

<script>
    $(".dropify").dropify({
        messages:{
            default:"Glissez et déposez un fichier ici ou cliquez",
            replace:"Glissez-déposez ou cliquez pour remplacer",
            remove:"Supprimer",
            error:"Oups, quelque chose de mal ajouté."
        },
        error:{
            fileSize:"La taille du fichier est trop grande (1M max)."
        }
    });
    $(function() {
        $("#colAgentId").chained("#colTrajetId");
    });
    $(".datePicker").flatpickr({
        locale: "<?= service('request')->getLocale() ?>",
        dateFormat: "<?= service('request')->getLocale() == 'fr' ? 'd/m/Y' : 'Y-m-d' ?>"
    });
    $('.modal-link-edit').on('click', function() {
        var link = $(this).attr("href");
        $.ajax({
            url: link,
            type: 'get',
		    crossDomain:true,
            dataType: 'html',
            success: function(response) {
                $("#con-close-modal .modal-body").html(response);
                document.getElementById("form-con-close-modal").action = link;
                $("#header_color").spectrum({
                    showSelectionPalette: true,
                    showInitial: true,
                });
                $("#icon_color").spectrum({
                    showInitial: !0
                });
                $("#left_sidebar_color").spectrum({
                    showInitial: !0
                });

                $("#con-close-modal .dateTimePicker").flatpickr({
                    enableTime: true,
                    locale: "<?= service('request')->getLocale() ?>",
                    dateFormat:"Y-m-d H:i"
                });

                $("#con-close-modal .timePicker").flatpickr();
            }, error: function(XMLHttpRequest, textStatus, errorThrown) {
                // Handle error here
                $("#con-close-modal .modal-body").html(XMLHttpRequest.responseText);
               // $('#editor-container').modal('show');
            }
        });
    });
    $(".selectMultiple").selectize();


</script>
<!-- Liste liés -->
<script>
    $("#collectZoneId").on('change',function(){
        var collectZoneId = $("#collectZoneId").val();
        if(collectZoneId!= "") {
            $("#collectSectionId").empty();
            $("#collectSectionId").append('<option label="<?= lang('Holder.section_choice')?>"></option>');
            $.ajax({
                url: "<?= site_url('filtres/section-by-zone')?>",
                type: "post",
                data: "zoneId=" + collectZoneId,
                dataType: "json",
                success: function (data) {
                    if (data.status == true) {
                        var tuples = data.tuples;
                        for (var i = 0; i < tuples.length; i++) {
                            $("#collectSectionId").append("<option value='" + tuples[i].sectionId + "'>" + tuples[i].sectionLabel + "</option>");
                        }
                    }
                }
            });
        }
    });
</script>
<?php
    if(currentUrl(uri_string()) === "dashboard/"): ?>
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&language=<?= service('request')->getLocale()?>&key=AIzaSyCkdyai5-p_kXTroX-gSz_mz-xeQ8Ht1iY"></script>
        <script>
            var markerList = <?= isset($terminusList) && is_array($terminusList) && count($terminusList)>0 ? json_encode($terminusList):json_encode([])?>;
            var markerBusList = <?= isset($geoList) && is_array($geoList) && count($geoList)>0 ? json_encode($geoList):json_encode([])?>;
            var terminusIcon = "<?= base_url().'/assets/maps/images/terminus_4_3.png'?>";
            var busIcon = "<?= base_url().'/assets/maps/images/bus_5.png'?>";
            var traceBus = <?= isset($trace) && is_array($trace) && count($trace)>0 ? json_encode($trace):json_encode([])?>;
            var directionsDisplay;
            var directionsService;
            var stepDisplay;
            var mapDakar;
            var map,origin,destination;
            function initMap(){
                mapDakar = {
                    lat:14.716677,
                    lng:-17.467686
                };
                mapOptions = {
                    zoom: 13,
                    center: mapDakar,
                    //mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('map'), mapOptions);
                var icon = {
                    url: terminusIcon, // url
                    scaledSize: new google.maps.Size(25, 25), // scaled size
                    origin: new google.maps.Point(0, 0), // origin
                    anchor: new google.maps.Point(0, 0), // anchor,
                    strokeColor: 'red',
                };

                initTerminus(map,icon);
                var iconBus = {
                    url: busIcon, // url
                    scaledSize: new google.maps.Size(22, 22), // scaled size
                    origin: new google.maps.Point(0, 0), // origin
                    anchor: new google.maps.Point(0, 0) // anchor
                };
                initBus(map,iconBus);
                if (traceBus != "") {

                    var lat = parseFloat(traceBus['geoLat']);
                    var lng = parseFloat(traceBus['geoLng']);
                    var title = "Ligne n° " + traceBus['geoLineLabel'] + " \n" + traceBus['geoVehicleMatricule'] + " \nTrajet:" + traceBus['geoTrajetLabel'];
                    new google.maps.Marker({
                        position: {lat: lat, lng: lng},
                        map: map,
                        title: title,
                        optimized: true,
                        icon: iconBus,
                        //label: 'B'
                    });
                    var iPoint = new google.maps.LatLng(lat, lng);
                    var sLat = parseFloat(traceBus['geoTermStartLat']);
                    var sLng = parseFloat(traceBus['geoTermStartLng']);
                    var sPoint = new google.maps.LatLng(sLat, sLng);
                    var fLat = parseFloat(traceBus['geoTermEndLat']);
                    var fLng = parseFloat(traceBus['geoTermEndLng']);
                    var fPoint = new google.maps.LatLng(fLat, fLng);
                    directionsDisplay = new google.maps.DirectionsRenderer({'draggable':true});
                    directionsService = new google.maps.DirectionsService();
                    displayRoute('DRIVING',sPoint,fPoint,directionsService,directionsDisplay);
                }
            }
            function initTerminus(map,icon){
                for (var i = 0; i < markerList.length; i++) {
                    var terminus = markerList[i];
                    var lat = parseFloat(terminus['termLat']);
                    var lng = parseFloat(terminus['termLng']);
                    var title = terminus['termLibelle'];
                    new google.maps.Marker({
                        position: {lat: parseFloat(lat), lng: parseFloat(lng)},
                        map: map,
                        title: title,
                        optimized: true,
                        icon: icon,
                        //label:'T',
                    });
                }
            }
            function initBus(map,icon){
                for (var i = 0; i < markerBusList.length; i++) {
                    var voiture = markerBusList[i];
                    var lat = parseFloat(voiture['geoLat']);
                    var lng = parseFloat(voiture['geoLng']);
                    var title = "Ligne n° " + voiture['geoLineLabel'] + " \n" + voiture['geoVehicleMatricule'] + " \nTrajet:" + voiture['geoTrajetLabel'];
                    new google.maps.Marker({
                        position: {lat: lat, lng: lng},
                        map: map,
                        title: title,
                        optimized: true,
                        icon: icon,
                        //label:'B',

                    });
                }
            }
            function displayRoute(travel_mode,origin,destination,directionsService,directionsDisplay){
                directionsService.route({
                    origin: origin,
                    destination:destination,
                    travelMode:travel_mode,
                    avoidTolls: true
                }, function (response,status){
                   if(status==='OK'){
                       directionsDisplay.setMap(map);
                       directionsDisplay.setDirections(response);
                   }
                   else{
                       directionsDisplay.setMap(null);
                       directionsDisplay.setDirections(null);
                   }
                });
            }
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
        <!--script src="https://maps.googleapis.com/maps/api/js?libraries=places&language=<--?= service('request')->getLocale()?>&key=AIzaSyCkdyai5-p_kXTroX-gSz_mz-xeQ8Ht1iY&callback=initMap"></script>
        <script  async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC62pVK1gSClETTJMwDCT0_vlvjpLbOC5o&callback=initMap"></script-->
        <!--script  async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkdyai5-p_kXTroX-gSz_mz-xeQ8Ht1iY&callback=initMap"></script-->
        <?php
    endif;
    if (isset($nestableList) && is_array($nestableList) && count($nestableList) > 0) : ?>
        <script>
            var nestableList = <?= json_encode($nestableList) ?>;
            var _nestableList = '';
            $.each(nestableList, function(key, value) {
                $("#nestableItem_" + key).jstree({
                    'core': {
                        "check_callback": true,
                        'data': value.data
                    },
                    'checkbox': {
                        "keep_selected_style": false
                    },
                    'plugins': ["checkbox"]
                });
            });
            $('.btnGetCheckedItem').click(function() {
                var result = '';
                $.each(nestableList, function(key, value) {
                    var checked_ids = [];
                    var selectedNodes = $("#nestableItem_" + key).jstree("get_selected", true);
                    $.each(selectedNodes, function() {
                        checked_ids.push(this.id);
                    });
                    for (var i = 0; i < checked_ids.length; i++) {
                        result = result + '-' + checked_ids[i];
                    }
                });
                if (result != "") {
                    var form = $("#form-profile-managers");
                    $("#privileges").val(result);
                    return form.submit();
                } else {
                    $("#jsTreeMessage").html("<?= showMessage('danger', 'Messages.empty_choice_privilege') ?>");
                }
            });

            if (result != "") {
                var form = $("#form-profile-managers");
                $("#privileges").val(result);
                form.submit();
            } else {
                $("#jsTreeMessage").html("<?= showMessage('danger', 'Messages.empty_choice_privilege') ?>");
            }
        });
    </script>
    <script type="text/javascript">
	function THEFUNCTION(i) {
		var paiementBancaire = document.getElementById('paiementBancaire');
		switch(i) {
			case 0 : paiementBancaire.style.display = 'BANK_PAYMENT'; break;
			default: paiementBancaire.style.display = 'none'; break;
		}
	}
//test for iterating over child elements
var langArray = [];
$('.vodiapicker option').each(function(){
  var img = $(this).attr("data-thumbnail");
  var text = this.innerText;
  var value = $(this).val();
  var item = '<li><img src="'+ img +'" alt="" value="'+value+'"/><span>'+ text +'</span></li>';
  langArray.push(item);
})

$('#a').html(langArray);

//Set the button value to the first el of the array
$('.btn-select').html(langArray[0]);
$('.btn-select').attr('value', 'en');

//change button stuff on click
$('#a li').click(function(){
   var img = $(this).find('img').attr("src");
   var value = $(this).find('img').attr('value');
   var text = this.innerText;
   var item = '<li><img src="'+ img +'" alt="" /><span>'+ text +'</span></li>';
  $('.btn-select').html(item);
  $('.btn-select').attr('value', value);
  $(".b").toggle();
  console.log(value);
});

$(".btn-select").click(function(){
        $(".b").toggle();
    });

//check local storage for the lang
var sessionLang = localStorage.getItem('lang');
if (sessionLang){
  //find an item with value of sessionLang
  var langIndex = langArray.indexOf(sessionLang);
  $('.btn-select').html(langArray[langIndex]);
  $('.btn-select').attr('value', sessionLang);
} else {
   var langIndex = langArray.indexOf('ch');
  console.log(langIndex);
  $('.btn-select').html(langArray[langIndex]);
  //$('.btn-select').attr('value', 'en');
}
</script>
<?php
endif;

