<?php
require_once('endpoints.php');

function wincasa_alarm()
{
    $template = get_template_directory().'/WincasaAlarm.php';
    if (file_exists($template)){
        require_once('WincasaAlarm.php');
    }else{
        require_once( get_stylesheet_directory() . '/WincasaAlarm.php' );
    }
}

function oiw_load_recaptcha_badge_page()
{
    if (!is_page(array('kontakt'))) {
        wp_dequeue_script('google-recaptcha');
        wp_dequeue_script('wpcf7-recaptcha');
    }
}

add_action( 'init', 'wincasa_alarm' );
add_action('wp_enqueue_scripts', 'oiw_load_recaptcha_badge_page');
/**********************API*********************/
function removeData()
{
    $flatArray = get_field('flats', 'option');;
    for ($i = 0; $i < count($flatArray); $i++) {
        delete_row('flats', 1, 'options');
    }

}

add_action('cache_page', 'cachePage');
add_action('acf/save_post', 'cachePage');
function cachePage()
{
    $url_headers_gewerbe = @get_headers(get_site_url() . '/gewerbe/');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/cached-wohnungen.html')) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/cached-wohnungen.html');
    }
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/cached-gewerbe.html')) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/cached-gewerbe.html');
    }
    if (strpos($url_headers_gewerbe[0], '200')) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => get_site_url() . '/gewerbe/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '{
    "device": "desktop"
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer bb6d5a81b31fd1b5daa22a345f9c11f07280a29e',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => get_site_url() . '/wohnungen/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => '{
		"device": "desktop"
	}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer bb6d5a81b31fd1b5daa22a345f9c11f07280a29e',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    do_action('litespeed_purge_all');

}

add_action('add_links', 'addLinks');
function addLinks()
{

    $streets = get_flats_sorted_by_streets();
    $flatsInfo = get_field('flats', 'option');
    $referenceNumbers = [];
    foreach ($streets as $street) {
        foreach ($street['flats'] as $flats) {
            if(get_field('types', 'option')){
                foreach (get_field('types', 'option') as $type) {
                    if ($type['type'] == "PRIVATE") {
                        if($flats['type'] == "PRIVATE"){
                            $referenceNumbers[] = $flats['referenceNumber'];
                        }
                    }
                    if ($type['type'] == "PARKING_SPACE") {
                        if($flats['type'] == "PARKING_SPACE"){
                            $referenceNumbers[] = $flats['referenceNumber'];
                        }
                    }
                    if ($type['type'] == "OTHERS") {
                        if($flats['type'] != "PARKING_SPACE" && $flats['type'] != "PRIVATE"){
                            $referenceNumbers[] = $flats['referenceNumber'];
                        }
                    }
                }
            }else{
                $referenceNumbers[] = $flats['referenceNumber'];
            }
        }

    }
    $founded = false;
    foreach ($referenceNumbers as $referenceNumber) {
        $founded = false;
        foreach ($flatsInfo as $flatInfo) {
            if ($referenceNumber == $flatInfo['flat_no']) {
                $founded = true;
            }

        }
        if (!$founded) {
            $url = "https://api.wincasa.ch/tenant-portal/v1/realestateproperty/id?referenceId=" . $referenceNumber;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);


            $resp = str_replace("\"", "", $resp);

            $row = array(
                'flat_no' => $referenceNumber,
                'pdf' => '',
                'photos' => '',
                'link' => $resp
            );
            add_row('flats', $row, 'options');
        }
    }
}

function setObjektArt($word)
{
    $words = [
        "MISCELLANEOUS_MAIN" => "Lagerraum",
        "OFFICE" => "B??roraum",
        "PARKING_SPACE" => "Einstellplatz",
        "PRIVATE" => "Wohnung",
        "COMMERCIAL" => "Laden",
        "WAREHOUSE" => "Werbefl??che",
        "OTHER" => "Andere",
        "MEDICAL_OFFICE" => "Arztpraxis",
        "GASTRONOMY" => "Gastronomy"
    ];
    return $words[$word];

}

function prefix_gettext_modifications($translation, $text, $domain)
{

    if ('wpcf7-recaptcha' === $domain && false !== strpos($text, 'you are not a robot')) {
        $translation = 'Bitte verifizieren Sie, dass Sie kein Roboter sind.';
    }

    return $translation;

}

add_filter('gettext', 'prefix_gettext_modifications', 10, 3);
function get_buildings($orgIDs)
{
    static $content = [];
    if ($content) {
        return $content;
    }
    foreach ($orgIDs as $orgID) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://wcmultitenant.streamnow.ch/api/buildings?ownerOrganizationId=$orgID&page=0&size=500",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . get_token(),
                "Accept: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($response, true);
        $content[] = [$orgID => $json["content"]];
    }

    return $content;
}

function get_token()
{
    static $token = [];

    if ($token) {
        return $token;
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://wcmultitenant.streamnow.ch/oauth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "Accept: application/json",
            "Authorization: Basic d2luY2FzYV9vYmplY3Rfd2ViX3BhZ2VzOndpbmNhc2Ffb2JqZWN0X3dlYl9wYWdlcw=="
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($response, true);
    $token = $json['access_token'];
    return $token;
}

function get_flat($buildingID, $organizationID)
{
    static $flat = [];

    if (isset($flat[$buildingID])) {
        return $flat[$buildingID];
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://wcmultitenant.streamnow.ch/api/flats?ownerOrganizationId=$organizationID&buildingId=$buildingID&page=0&size=500",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . get_token(),
            "Accept: application/json"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $json = json_decode($response, true);
    return $flat[$buildingID] = $json["content"];
}


function get_flats()
{
    static $flats = [];

    if ($flats) {
        return $flats;
    }
    $niz = [];
    $orgIDs = get_field('organization_ids', 'option');
    foreach ($orgIDs as $orgID) {
        $niz[] = array_values($orgID)[0];
    }
    $allBuildings = get_buildings($niz);
    $arr = [];

    foreach ($allBuildings as $buildings) {
        $orgID = array_keys($buildings)[0];
        $buildings = array_values($buildings)[0];

        foreach ($buildings as $building) {
            //array_push($arr, get_flat($building["id"], 546))
            $arr = array_merge($arr, get_flat($building["id"], $orgID));
        }
    }
    return $flats = get_flats_by_type(get_field('types', 'option'), $arr);

}

function get_flats_by_type($types, $arr)
{
    $flatsArr = [];
    $private = 0;
    $parking = 0;
    $others = 0;
    if (count($types) > 0) {
        foreach ($types as $type) {
            if ($type['type'] == "PRIVATE" && $private == 0) {
                $private++;
                $flatsArr[] = array_filter(
                    $arr,
                    function ($items) {
                        if ($items['type'] == "PRIVATE") {

                            return $items;
                        }

                    },);
            }
            if ($type['type'] == "PARKING_SPACE" && $parking == 0) {
                $parking++;
                $flatsArr[] = array_filter(
                    $arr,
                    function ($items) {
                        if ($items['type'] == "PARKING_SPACE") {
                            return $items;
                        }

                    },);
            }
            if ($type['type'] == "OTHERS" && $others == 0) {
                $others++;
                $flatsArr[] = array_filter(
                    $arr,
                    function ($items) {
                        if ($items['type'] != "PARKING_SPACE" && $items['type'] != "PRIVATE") {

                            return $items;
                        }

                    },);
            }
        }
        return $flatsArr;
    } else {
        return $arr;
    }
}

function sort_flats($building)
{
    for ($i = 0; $i < count($building); $i++) {
        for ($j = 0; $j < count($building); $j++) {
            preg_match('/(\d+).(\d+).(\d+)(\d\d)/', $building[$i]['referenceNumber'], $id1);
            preg_match('/(\d+).(\d+).(\d+)(\d\d)/', $building[$j]['referenceNumber'], $id2);
            if ($id1[4] < $id2[4]) {
                $pom = $building[$i];
                $building[$i] = $building[$j];
                $building[$j] = $pom;
            }
        }
    }
    return $building;
}

function have_type_of_flats($type, $flats)
{
    foreach ($flats as $flat) {
        if ($flat['type'] == $type) {
            return true;
        }
    }
    return false;
}

function get_all_streets($allFlats)
{
    $streets = [];
    foreach ($allFlats as $flats) {
        $streets[] = $flats[0]["building"]["street"];
        $haveStreet = false;
        foreach ($flats as $flat) {
            foreach ($streets as $street) {
                if ($flat["building"]["street"] == $street) {
                    $haveStreet = true;
                }
            }
            if (!$haveStreet) {
                $streets[] = $flat["building"]["street"];
            }
            $haveStreet = false;
        }
    }
    return $streets;
}

function get_all_free_flats()
{
    $flatArrays = get_flats();
    $flatArray = [];
    foreach ($flatArrays as $flats) {
        foreach ($flats as $flat) {
            $flatArray[] = $flat;
        }
    }
    return $flatArray;
}

function get_flats_sorted_by_streets()
{
    static $flatsArray = [];
    if ($flatsArray) {
        return $flatsArray;
    }
    $arr = [];
    $orgIDs = get_field('organization_ids', 'option');
    foreach ($orgIDs as $orgID) {
        $arr[] = array_values($orgID)[0];
    }
    $allBuildings = get_buildings($arr);
    $buildings = [];

    foreach ($allBuildings as $value) {
        $buildings[array_keys($value)[0]] = array_values($value)[0];
    }
    $streets = [];
    $names = '';
    $found = false;
    $streets1 = [];

    foreach ($buildings as $key => $value) {
        foreach ($value as $building) {


            foreach ($streets as $street) {
                if ($building['street'] == $street) {
                    $found = true;
                }
            }
            if (!$found) {
                $names = $building['street'];
            }
            $found = false;

            $flats = get_flat($building["id"], $key);
            $sortedFlats = [];
            foreach ($flats as $flat) {
                if ($building['street'] == $flat['building']['street']) {
                    $sortedFlats[] = $flat;
                }
            }

            $streets[] = ['name' => $names, 'flats' => $sortedFlats];
        }
    }
    for ($j = 0; $j < count($streets); $j++) {
        for ($k = $j + 1; $k < count($streets); $k++) {
            preg_match('/\w+.(\d+)\w/', str_replace('.', '', str_replace('??', 'u', $streets[$j]['name'])) . "a", $number1);
            preg_match('/\w+.(\d+)\w/', str_replace('.', '', str_replace('??', 'u', $streets[$k]['name'])) . "a", $number2);
            if ($number1[1] < '10') {

                $number1[0] = str_replace($number1[1], '0' . $number1[1], $number1[0]);
            }
            if ($number2[1] < '10') {
                $number2[0] = str_replace($number2[1], '0' . $number2[1], $number2[0]);
            }
            if ($number1[0] > $number2[0]) {
                $pom = $streets[$j];
                $streets[$j] = $streets[$k];
                $streets[$k] = $pom;
            }
        }
    }
    foreach ($streets as $i => $street) {
        for ($j = 0; $j < count($street['flats']); $j++) {
            for ($k = $j + 1; $k < count($street['flats']); $k++) {
                if ($streets[$i]['flats'][$j]['referenceNumber'] > $streets[$i]['flats'][$k]['referenceNumber']) {
                    $pom = $streets[$i]['flats'][$j];
                    $streets[$i]['flats'][$j] = $streets[$i]['flats'][$k];
                    $streets[$i]['flats'][$k] = $pom;
                }
            }
        }
    }
    return $flatsArray = $streets;

}

function generate_wohnungen_free_table()
{
    ob_start();
    $empty = true;
    $streets = get_flats_sorted_by_streets();
    foreach ($streets as $street) {
        foreach ($street['flats'] as $flats) {
            if ($flats['type'] == "PRIVATE" && isset($flats['available'])) {
                $empty = false;
                break;
            }
        }
    }
    $counter = 1;
    if ($empty != true):
        ?>
        <!-- <h4 class="mt-5 red-text text-center wohnungen-heading">Freie Wohnungen im ??berblick</h4>-->
        <table class="table table-striped mb-0" id="freieWohnungenTable">
        <thead>
        <tr>
            <th>Adresse</th>
            <th>Grundriss</th>
            <th>Bilder</th>
            <th>Objekt-Nr.</th>
            <th>Objekt-Art</th>
            <th>Geschoss</th>
            <th>Zimmer</th>
            <th>Fl??che</th>
            <th>Miete Netto/Mt.</th>
            <th>+ NK/Mt.</th>
            <th>Status</th>
            <th style='text-align:center;'>Bewerben</th>
        </tr>
        </thead>
        <tbody>

    <?php endif;

    foreach ($streets as $street) {
        foreach ($street['flats'] as $flats) {
            if ($flats['type'] == "PRIVATE" && isset($flats['available'])) {
                $empty = false;
                ?>
                <?php
                if ($flats["type"] == "PRIVATE") {
                    ?>

                    <?php
                    $flatInfo = get_flat_info($flats['referenceNumber']);
                    $flatPdfUrl = $flatInfo[0];
                    $flatPhotos = $flatInfo[1];
                    $flatLink = $flatInfo[2];
                    ?>
                    <tr class="vermietet">
                        <td><?php echo $flats['building']['street']; ?></td>
                        <td>
                            <?php if (!empty($flatPdfUrl) && isset($flats["available"])) : ?>
                                <a href="<?php echo $flatPdfUrl; ?>" target="_blank"> <img
                                            src="<?php bloginfo('template_directory'); ?>/images/pdf.svg" alt="PDF"
                                            style="width: 24px; margin-left:17px;"></a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($flatPhotos)) : ?>
                                <a id="modal" href="#" data-toggle="modal"
                                   data-number="<?php echo $flats["referenceNumber"] ?>"
                                   data-target="#modal-<?php echo $flats['id']; ?>">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg" alt=""
                                         style="width: 24px;">
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>  <?php echo $flats["referenceNumber"] ?></td>
                        <td><?= setObjektArt($flats['type']); ?>
                        </td>
                        <td><?php if ($flats['floor'] == 'EG') {
                                echo 'EG';
                            } else {
                                echo $flats['floor'];
                                echo '. Stock';
                            } ?></td>
                        <td><?php if (isset($flats["numberOfRooms"])) {
                                echo $flats["numberOfRooms"];
                            } else {
                                echo "-";
                            } ?></td>
                        <td class="right"><?php if (isset($flats["size"])) {
                                echo $flats["size"] . "m&#178;";
                            } ?></td>
                        <td><span class="anzeige"><?php if (isset($flats["netRent"])) {
                                    echo "CHF  $flats[netRent].-";
                                } ?></span></td>
                        <td><span class="anzeige"><?php if (isset($flats["ancillaryCosts"])) {
                                    echo "CHF $flats[ancillaryCosts].-";
                                } ?></span></td>
                        <td><?php if (isset($flats["available"])) {
                                echo 'Frei';
                            } else {
                                echo 'Vermietet';
                            } ?></td>
                        <td style='text-align:center;'><?php if (isset($flats['available'])): ?>    <a
                                    href="https://www.mywincasa.ch/<?php echo $lang ?>/candidate/<?php echo $flatLink; ?>"
                                    class="btn btn-sm bewerbe mb-0" target="_blank">Bewerben</a><?php endif; ?></td>
                    </tr>


                <?php }
            }

        }
        $counter++;
    } ?>
    </tbody>
    </table>

    <?php
    if ($empty) {
        ?>
        <div id="freieWohnungenTable" class="no-free-flats white-text pl-0"> Zur Zeit sind alle Wohnungen
            vermietet. Aktivieren Sie den <a
                    href="#wincasa-alarm">Wincasa Alarm</a> - so benachrichtigen wir Sie umgehend, sobald in dieser
            Liegenschaft eine Wohnung verf??gbar wird.
        </div>
        <?php

    }
    return ob_get_clean();
}

function generate_wohnungen_all_table()
{
    $streets = get_flats_sorted_by_streets();
    $counter = 1;
    foreach ($streets as $street) {
        if (have_type_of_flats("PRIVATE", $street['flats'])) {
            ?>
            <div class="accordion mb-4 " id="accordionExample-<?php echo $counter; ?>">
                <div class="card no-border">
                    <div class="card-header white-block p-0" id="heading-<?php echo $counter; ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed red-background btn-block text-left d-flex justify-content-between align-items-center collapsed"
                                    type="button" data-toggle="collapse" data-target="#collapse-<?php echo $counter; ?>"
                                    aria-expanded="true"
                                    aria-controls="collapse-<?php echo $counter; ?>">
                                <div class="d-flex align-items-center">
                                    <div class="accordion-circle mr-4">
                                        <span class="horisontal-line"></span>
                                        <span class="vertical-line"></span>
                                    </div>
                                    <div class="card-heading"><?php echo $street['name'] ?></div>
                                </div>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-<?php echo $counter; ?>" class="collapse  gray-block"
                         aria-labelledby="heading-<?php echo $counter; ?>"
                         data-parent="#accordionExample-<?php echo $counter; ?>">
                        <div class="card-body">
                            <div class="scrollcontainer">
                                <div class="inner">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Grundriss</th>
                                            <th>Bilder</th>
                                            <th>Objekt-Nr.</th>
                                            <th>Objekt-Art</th>
                                            <th>Geschoss</th>
                                            <th>Zimmer</th>
                                            <th>Fl??che</th>
                                            <th>Miete Netto/Mt.</th>
                                            <th>+ NK/Mt.</th>
                                            <th>Status</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($street['flats'] as $flats) {
                                            if ($flats["type"] == "PRIVATE") {
                                                ?>

                                                <?php
                                                $flatInfo = get_flat_info($flats['referenceNumber']);
                                                $flatPdfUrl = $flatInfo[0];
                                                $flatPhotos = $flatInfo[1];
                                                $flatLink = $flatInfo[2];
                                                ?>
                                                <tr class="vermietet">
                                                    <td>
                                                        <?php if (!empty($flatPdfUrl) && isset($flats["available"])) : ?>
                                                            <a href="<?php echo $flatPdfUrl; ?>" target="_blank"> <img
                                                                        src="<?php bloginfo('template_directory'); ?>/images/pdf.svg"
                                                                        alt="PDF"
                                                                        style="width: 24px; margin-left:17px;"></a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($flatPhotos)) : ?>
                                                            <a id="modal" href="#"
                                                               data-number="<?php echo $flats["referenceNumber"] ?>"
                                                               data-toggle="modal"
                                                               data-target="#modal-<?php echo $flats['id']; ?>">
                                                                <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg"
                                                                     alt="" style="width: 24px;">
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>  <?php echo $flats["referenceNumber"] ?></td>
                                                    <td><?= setObjektArt($flats['type']); ?>
                                                    </td>
                                                    <td><?php if ($flats['floor'] == 'EG') {
                                                            echo 'EG';
                                                        } else {
                                                            echo $flats['floor'];
                                                            echo '. Stock';
                                                        } ?></td>
                                                    <td><?php if (isset($flats["numberOfRooms"])) {
                                                            echo $flats["numberOfRooms"];
                                                        } else {
                                                            echo "-";
                                                        } ?></td>
                                                    <td class="right"><?php if (isset($flats["size"])) {
                                                            echo $flats["size"] . "m&#178;";
                                                        } ?></td>
                                                    <td><span class="anzeige"><?php if (isset($flats["netRent"])) {
                                                                echo "CHF  $flats[netRent].-";
                                                            } ?></span></td>
                                                    <td><span class="anzeige"><?php if (isset($flats["ancillaryCosts"])) {
                                                                echo "CHF $flats[ancillaryCosts].-";
                                                            } ?></span></td>
                                                    <td><?php if (isset($flats["available"])) {
                                                            echo 'Frei';
                                                        } else {
                                                            echo 'Vermietet';
                                                        } ?></td>

                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        $counter++;
    }
    get_popups();
}

function generate_gewerbe_free_table()
{
    ob_start();
    $empty = true;
    $streets = get_flats_sorted_by_streets();
    foreach ($streets as $street) {
        foreach ($street['flats'] as $flats) {
            if ($flats['type'] != "PRIVATE" && $flats['type'] != "PARKING_SPACE" && isset($flats['available'])) {
                $empty = false;
                break;
            }
        }
    }
    $counter = 1;
    if ($empty != true):
        ?>
        <!-- <h4 class="mt-5 red-text text-center wohnungen-heading">Freie Wohnungen im ??berblick</h4>-->
        <div id="freieWohnungenTable">
            <?php foreach ($streets as $street) { ?>
                <?php if (check_offices($street['flats'])): ?>
                    <div class="free-flats-container">
                        <h2 class="my-0"><?php echo $street['name'] ?></h2>
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Grundriss</th>
                                <th>Bilder</th>
                                <th>Objekt-Nr.</th>
                                <th>Objekt-Art</th>
                                <th>Geschoss</th>
                                <th>Zimmer</th>
                                <th>Fl??che</th>
                                <th>Miete Netto/Mt.</th>
                                <th>+ NK/Mt.</th>
                                <th>Status</th>
                                <th style='text-align:center;'>Bewerben</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            foreach ($street['flats'] as $flats) {
                                if ($flats['type'] != "PRIVATE" && $flats['type'] != "PARKING_SPACE" && isset($flats['available'])) {
                                    $empty = false;
                                    ?>
                                    <?php
                                    if ($flats['type'] != "PRIVATE" && $flats['type'] != "PARKING_SPACE") {
                                        ?>

                                        <?php
                                        $flatInfo = get_flat_info($flats['referenceNumber']);
                                        $flatPdfUrl = $flatInfo[0];
                                        $flatPhotos = $flatInfo[1];
                                        ?>
                                        <tr class="vermietet">
                                            <td>
                                                <?php if (!empty($flatPdfUrl)) : ?>
                                                    <a href="<?php echo $flatPdfUrl; ?>" target="_blank"> <img
                                                                src="<?php bloginfo('template_directory'); ?>/images/pdf.svg"
                                                                alt="PDF"
                                                                style="width: 24px; margin-left:17px;"></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($flatPhotos)) : ?>
                                                    <a id="modal" href="#" data-toggle="modal"
                                                       data-number="<?php echo $flats["referenceNumber"] ?>"
                                                       data-target="#modal-<?php echo $flats['id']; ?>">
                                                        <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg"
                                                             alt=""
                                                             style="width: 24px;">
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td>  <?php echo $flats["referenceNumber"] ?></td>
                                            <td><?= setObjektArt($flats['type']); ?>
                                            </td>
                                            <td><?php if ($flats['floor'] == 'EG') {
                                                    echo 'EG';
                                                } elseif ($flats['floor'] >= 1) {
                                                    echo $flats['floor'];
                                                    echo '. Stock';
                                                } else {
                                                    echo $flats['floor'];
                                                }
                                                ?></td>
                                            <td><?php if (isset($flats["numberOfRooms"])) {
                                                    echo $flats["numberOfRooms"];
                                                } else {
                                                    echo "-";
                                                } ?></td>
                                            <td class="right"><?php if (isset($flats["size"])) {
                                                    echo $flats["size"] . "m&#178;";
                                                } ?></td>
                                            <td><span class="anzeige"><?php if (isset($flats["netRent"])) {
                                                        echo "CHF  $flats[netRent].-";
                                                    } ?></span></td>
                                            <td><span class="anzeige"><?php if (isset($flats["ancillaryCosts"])) {
                                                        echo "CHF $flats[ancillaryCosts].-";
                                                    } ?></span></td>
                                            <td><?php if (isset($flats["available"])) {
                                                    echo 'Frei';
                                                } else {
                                                    echo 'Vermietet';
                                                } ?></td>
                                            <td style='text-align:center;'><?php if (isset($flats['available'])): ?>
                                                    <a
                                                            href="https://service.wincasa.ch/Dokumentencenter-Ein-Auszug-Bewerbung_Gewerbe/"
                                                            class="btn btn-sm bewerbe mb-0"
                                                            target="_blank">Bewerben</a><?php endif; ?></td>
                                        </tr>


                                    <?php }
                                }

                            }
                            $counter++;
                            ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <?php
            } ?>
        </div>
    <?php endif;
    if ($empty) {
        ?>
        <div id="freieWohnungenTable" class="no-free-flats white-text pl-0"> Zur Zeit sind alle Gewerbe
            vermietet. Aktivieren Sie den <a
                    href="#wincasa-alarm">Wincasa Alarm</a> - so benachrichtigen wir Sie umgehend, sobald in dieser
            Liegenschaft eine Gewerbe verf??gbar wird.
        </div>
        <?php

    }
    return ob_get_clean();
}

function generate_gewerbe_all_table()
{
    $streets = get_flats_sorted_by_streets();
    $counter = 1;
    $flats = [];
    foreach ($streets as $street) {
        foreach ($street['flats'] as $flat) {
            if ($flat['type'] !== "PRIVATE" && $flat['type'] !== "PARKING_SPACE") {
                $flats[] = $flat;
            }
        }
        if (count($flats) != 0) {
            ?>
            <div class="accordion mb-4 " id="accordionExample-<?php echo $counter; ?>">
                <div class="card no-border">
                    <div class="card-header white-block p-0" id="heading-<?php echo $counter; ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed red-background btn-block text-left d-flex justify-content-between align-items-center collapsed"
                                    type="button" data-toggle="collapse" data-target="#collapse-<?php echo $counter; ?>"
                                    aria-expanded="true"
                                    aria-controls="collapse-<?php echo $counter; ?>">
                                <div class="d-flex align-items-center">
                                    <div class="card-heading"><?php echo $street['name'] ?></div>
                                </div>
                                <div class="accordion-circle">
                                    <span class="horisontal-line"></span>
                                    <span class="vertical-line"></span>
                                </div>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-<?php echo $counter; ?>" class="collapse  gray-block"
                         aria-labelledby="heading-<?php echo $counter; ?>"
                         data-parent="#accordionExample-<?php echo $counter; ?>">
                        <div class="card-body">
                            <div class="scrollcontainer">
                                <div class="inner">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Grundriss</th>
                                            <th>Bilder</th>
                                            <th>Objekt-Nr.</th>
                                            <th>Objekt-Art</th>
                                            <th>Geschoss</th>
                                            <th>Zimmer</th>
                                            <th>Fl??che</th>
                                            <th>Miete Netto/Mt.</th>
                                            <th>+ NK/Mt.</th>
                                            <th>Status</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($street['flats'] as $flats) {
                                            if ($flats['type'] != "PRIVATE" && $flats['type'] != "PARKING_SPACE") {
                                                ?>

                                                <?php
                                                $flatInfo = get_flat_info($flats['referenceNumber']);
                                                $flatPdfUrl = $flatInfo[0];
                                                $flatPhotos = $flatInfo[1];
                                                $flatLink = $flatInfo[2];
                                                ?>
                                                <tr class="vermietet">
                                                    <td>
                                                        <?php if (!empty($flatPdfUrl) && isset($flats["available"])) : ?>
                                                            <a href="<?php echo $flatPdfUrl; ?>" target="_blank"> <img
                                                                        src="<?php bloginfo('template_directory'); ?>/images/pdf.svg"
                                                                        alt="PDF"
                                                                        style="width: 24px; margin-left:17px;"></a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($flatPhotos)) : ?>
                                                            <a id="modal" href="#"
                                                               data-number="<?php echo $flats["referenceNumber"] ?>"
                                                               data-toggle="modal"
                                                               data-target="#modal-<?php echo $flats['id']; ?>">
                                                                <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg"
                                                                     alt="" style="width: 24px;">
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>  <?php echo $flats["referenceNumber"] ?></td>
                                                    <td><?= setObjektArt($flats['type']); ?>
                                                    </td>
                                                    <td><?php if ($flats['floor'] == 'EG') {
                                                            echo 'EG';
                                                        } elseif ($flats['floor'] >= 1) {
                                                            echo $flats['floor'];
                                                            echo '. Stock';
                                                        } else {
                                                            echo $flats['floor'];
                                                        }
                                                        ?></td>
                                                    <td><?php if (isset($flats["numberOfRooms"])) {
                                                            echo $flats["numberOfRooms"];
                                                        } else {
                                                            echo "-";
                                                        } ?></td>
                                                    <td class="right"><?php if (isset($flats["size"])) {
                                                            echo $flats["size"] . "m&#178;";
                                                        } ?></td>
                                                    <td><span class="anzeige"><?php if (isset($flats["netRent"])) {
                                                                echo "CHF  $flats[netRent].-";
                                                            } ?></span></td>
                                                    <td><span class="anzeige"><?php if (isset($flats["ancillaryCosts"])) {
                                                                echo "CHF $flats[ancillaryCosts].-";
                                                            } ?></span></td>
                                                    <td><?php if (isset($flats["available"])) {
                                                            echo 'Frei';
                                                        } else {
                                                            echo 'Vermietet';
                                                        } ?></td>

                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        $counter++;
        $flats = [];
    }
    get_popups();
}

function generate_park_free_table()
{
    ob_start();
    $empty = true;
    $allFlats = get_flats_sorted_by_streets();
    foreach ($allFlats as $flats) {

        foreach ($flats["flats"] as $flat) {
            if (isset($flat['available']) && $flat['type'] == 'PARKING_SPACE') {
                $empty = false;
                break;
            }
        }
    }
    $counter = 1;
    if ($empty != true):
        ?>
        <h4 class="mt-5 red-text text-center">Freie Parkpl??tze im ??berblick</h4>
        <table class="table table-striped" id="freieWohnungenTable">
        <thead>
        <tr>
            <th>Adresse</th>

            <th>Bilder</th>
            <th>Objekt-Nr.</th>
            <th>Objekt-Art</th>


            <th>Miete Netto/Mt.</th>
            <th>+ NK/Mt.</th>
            <th>Status</th>
            <th style='text-align:center;'>Bewerben</th>
        </tr>
        </thead>
        <tbody>

    <?php endif;
    foreach ($allFlats as $flats) {
        foreach ($flats["flats"] as $flat) {
            if (isset($flat['available']) && $flat['type'] == 'PARKING_SPACE') {
                $empty = false;
                $flatInfo = get_flat_info($flat['referenceNumber']);
                $flatPlan = $flatInfo[0];
                $flatPhotos = $flatInfo[1];
                $flatLink = $flatInfo[2];
                ?>
                <tr class="vermietet">
                    <td><?php echo $flat['building']['street']; ?></td>

                    <td>
                        <?php if (!empty($flatPhotos)) : ?>
                            <a id="modal" href="#" data-toggle="modal"
                               data-number="<?php echo $flat["referenceNumber"] ?>"
                               data-target="#modal-<?php echo $flat['id']; ?>">
                                <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg" alt=""
                                     style="width: 24px;">
                            </a>
                        <?php endif; ?>
                    </td>
                    <td>  <?php echo $flat["referenceNumber"] ?></td>
                    <td><?= setObjektArt($flat['type']); ?></td>


                    <td><span class="anzeige"><?php if (isset($flat["netRent"])) {
                                echo "CHF  $flat[netRent].-";
                            } else {
                                echo "-";
                            } ?></span></td>
                    <td><span class="anzeige"><?php if (isset($flat["ancillaryCosts"])) {
                                echo "CHF $flat[ancillaryCosts].-";
                            } else {
                                echo "-";
                            } ?></span></td>
                    <td><?php if (isset($flat["available"])) {
                            echo 'Frei';
                        } else {
                            echo 'Vermietet';
                        } ?></td>
                    <td style='text-align:center;'><?php if (isset($flat['available'])): ?>    <a
                                href="https://www.mywincasa.ch/<?php echo $lang ?>/candidate/<?php echo $flatLink; ?>"
                                class="btn btn-sm btn-light mb-0" target="_blank">Bewerben</a><?php endif; ?></td>
                </tr>


            <?php }
        }

    }
    $counter++;
    ?>
    </tbody>
    </table>


    <?php
    if ($empty) {
        ?>
        <div class="no-free-flats white-text"> Zur Zeit sind alle Parkpl??tze vermietet. Aktivieren Sie den <a
                    href="#wincasa-alarm">Wincasa Alarm</a> - so benachrichtigen wir Sie umgehend, sobald in dieser
            Liegenschaft ein Parkplatz verf??gbar wird.
        </div>
        <?php
    }
    return ob_get_clean();
}

function generate_park_all_table()
{
    $streets = get_flats_sorted_by_streets();
    $counter = 1;
    foreach ($streets as $street) {
        if (have_type_of_flats("PARKING_SPACE", $street['flats'])) {
            ?>
            <div class="accordion mb-4" id="accordionExample-<?php echo $counter; ?>">
                <div class="card no-border">
                    <div class="card-header white-block p-0" id="heading-<?php echo $counter; ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed red-background btn-block text-left d-flex justify-content-between align-items-center"
                                    type="button" data-toggle="collapse" data-target="#collapse-<?php echo $counter; ?>"
                                    aria-expanded="true"
                                    aria-controls="collapse-<?php echo $counter; ?>">
                                <div><?php echo $street['name'] ?></div>
                                <div class="fas collapse-icon-plus"></div>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse-<?php echo $counter; ?>" class="collapse  gray-block"
                         aria-labelledby="heading-<?php echo $counter; ?>"
                         data-parent="#accordionExample-<?php echo $counter; ?>">
                        <div class="card-body">
                            <div class="scrollcontainer">
                                <div class="inner">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>

                                            <th>Bilder</th>
                                            <th>Objekt-Nr.</th>
                                            <th>Objekt-Art</th>


                                            <th>Miete Netto/Mt.</th>
                                            <th>+ NK/Mt.</th>
                                            <th>Status</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($street['flats'] as $flat) {
                                            if ($flat['type'] == "PARKING_SPACE") {
                                                $flatInfo = get_flat_info($flat['referenceNumber']);
                                                $flatPlan = $flatInfo[0];
                                                $flatPhotos = $flatInfo[1];
                                                ?>
                                                <tr class="vermietet">

                                                    <td>
                                                        <?php if (!empty($flatPhotos)) : ?>
                                                            <a id="modal" href="#" data-toggle="modal"
                                                               data-number="<?php echo $flat["referenceNumber"] ?>"
                                                               data-target="#modal-<?php echo $flat['id']; ?>">
                                                                <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg"
                                                                     alt="" style="width: 24px;">
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>  <?php echo $flat["referenceNumber"] ?></td>
                                                    <td><?= setObjektArt($flat['type']); ?></td>


                                                    <td><span class="anzeige"><?php if (isset($flat["netRent"])) {
                                                                echo "CHF  $flat[netRent].-";
                                                            } else {
                                                                echo "-";
                                                            } ?></span></td>
                                                    <td><span class="anzeige"><?php if (isset($flat["ancillaryCosts"])) {
                                                                echo "CHF $flat[ancillaryCosts].-";
                                                            } else {
                                                                echo "-";
                                                            } ?></span></td>
                                                    <td><?php if (isset($flat["available"])) {
                                                            echo 'Frei';
                                                        } else {
                                                            echo 'Vermietet';
                                                        } ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $counter++;
        }
    }
}

function get_mobile_cards_park()
{
    ob_start();
    $flatArrays = get_flats_sorted_by_streets();
    $privateFlatArray = [];
    foreach ($flatArrays as $street) {
        foreach ($street['flats'] as $flats) {
            if ($flats['type'] == 'PARKING_SPACE' && isset($flats['available'])) {
                $privateFlatArray[] = $flats;
            }
        }
    }
if (count($privateFlatArray) > 0){ ?>
    <h4 class="mt-5  red-text text-center">Freie Parkpl??tze im ??berblick</h4>
    <div class="swiper-container mb-5 cards swiper-container-initialized swiper-container-horizontal"
         id="freieWohnungenSwiper">
        <div class="swiper-wrapper">
            <?php }
            foreach ($privateFlatArray as $flat) { ?>
                <div class="swiper-slide">
                    <?php
                    $flatInfo = get_flat_info($flat['referenceNumber']);
                    $flatPdfUrl = $flatInfo[0];
                    $flatPhotos = $flatInfo[1];
                    $flatLink = $flatInfo[2];
                    ?>
                    <div class="header">
                        <div class="row mb-1">
                        </div>
                        <div class="row">
                            <div class="col-7 pt-1">
                                <?php echo $flat["building"]["street"] ?>
                            </div>
                        </div>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-6">
                                <b>Grundriss</b>
                            </div>
                            <div class="col-6">
                                <?php if (!empty($flatPdfUrl)) : ?>
                                    <a href="<?php echo $flatPdfUrl; ?>" target="_blank"> <img
                                                src="<?php bloginfo('template_directory'); ?>/images/pdf.svg" alt=""
                                                style="width: 24px; margin-left:17px"></a>
                                <?php endif; ?>
                            </div>
                            <div class="col-6">
                                <b>Bilder</b>
                            </div>
                            <div class="col-6">
                                <?php if (!empty($flatPhotos)) : ?>
                                    <a id="modal" href="#" data-toggle="modal"
                                       data-number="<?php echo $flat["referenceNumber"] ?>"
                                       data-target="#modal-<?php echo $flat['id']; ?>">
                                        <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg" alt=""
                                             style="width: 24px; margin-left:17px">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="col-6">
                                <b>Objekt-Nr.</b>
                            </div>
                            <div class="col-6">
                                <?php echo $flat["referenceNumber"] ?>
                            </div>
                            <div class="col-6">
                                <b>Objekt-Art</b>
                            </div>
                            <div class="col-6">
                                <?= setObjektArt($flat['type']); ?>
                            </div>
                            <div class="col-6">
                                <b>Miete Netto/Mt.</b>
                            </div>
                            <div class="col-6">
                                <?php echo "CHF " . $flat["netRent"] . ".-" ?>
                            </div>
                            <div class="col-6">
                                <b>+ NK/Mt.</b>
                            </div>
                            <div class="col-6">
                                <?php echo "CHF " . $flat["ancillaryCosts"] . ".-" ?>
                            </div>
                            <div class="col-6">
                                <b>Bewerben</b>
                            </div>
                            <div class="col-6">
                                <a href="https://www.mywincasa.ch/<?php echo $lang ?>/candidate/<?php echo $flatLink; ?>"
                                   class="btn btn-sm btn-light mb-0">Bewerben </a>
                            </div>
                        </div>
                    </div>

                    <div>
                    </div>

                </div>
                <?php

            }
            if (count($privateFlatArray) > 0){ ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <script src="<?php bloginfo('template_directory'); ?>/js/swiper.min.js" defer></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/plugin_wincasaobjektliste.js" defer></script>
<?php } else {
    ?>
    <div class="no-free-flats white-text"> Zur Zeit sind alle Parkpl??tze vermietet. Aktivieren Sie den <a
                href="#wincasa-alarm">Wincasa Alarm</a> - so benachrichtigen wir Sie umgehend, sobald in dieser
        Liegenschaft ein Parkplatz verf??gbar wird.
    </div>
<?php }
    return ob_get_clean();
}

function get_mobile_cards_wohnungen()
{
    ob_start();
    $flatArrays = get_flats_sorted_by_streets();
    $privateFlatArray = [];
    foreach ($flatArrays as $street) {
        foreach ($street['flats'] as $flats) {
            if ($flats['type'] == 'PRIVATE' && isset($flats['available'])) {
                $privateFlatArray[] = $flats;
            }
        }
    }
    if (count($privateFlatArray) > 0) { ?>
    <?php }
    foreach ($privateFlatArray as $flat) { ?>
        <div class="swiper-slide">
            <?php
            $flatInfo = get_flat_info($flat['referenceNumber']);
            $flatPdfUrl = $flatInfo[0];
            $flatPhotos = $flatInfo[1];
            $flatLink = $flatInfo[2];
            ?>

            <div class="mobile-wohnen-card">
                <h2 class="mb-0 py-4 px-3"><?= $flat['building']['street'] ?></h2>
                <table class="w-100">
                    <tbody>
                    <tr>
                        <td class="card-title-row bold">Grundriss</td>
                        <td class="card-value-row">
                            <?php if (!empty($flatPdfUrl)) : ?>
                                <a href="<?php echo $flatPdfUrl; ?>" target="_blank">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/pdf.svg" alt=""
                                         style="width: 24px; margin-left:17px">
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Bilder</td>
                        <td class="card-value-row">
                            <?php if (!empty($flatPhotos)) : ?>
                                <a id="modal" href="#" data-number="<?php echo $flat["referenceNumber"] ?>"
                                   data-toggle="modal" data-target="#modal-<?php echo $flat['id']; ?>">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg" alt=""
                                         style="width: 24px;">
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Objekt-Nr.</td>
                        <td class="card-value-row"> <?= $flat["referenceNumber"] ?></td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Objekt-Art</td>
                        <td class="card-value-row"> <?= setObjektArt($flat['type']); ?></td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Geschoss</td>
                        <td class="card-value-row">
                            <?php if ($flat['floor'] == 'EG') {
                                echo 'Erdgeschoss';
                            } else if ($flat['floor'] >= 1) {
                                echo $flat['floor'] . ". Stock";
                            } else {
                                echo $flat['floor'];
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Zimmer</td>
                        <td class="card-value-row">
                            <?= $flat['numberOfRooms'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Fl??che</td>
                        <td class="card-value-row">
                            <?php if (isset($flat["size"])) {
                                echo $flat["size"] . "m&#178;";
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Miete Brutto/Mt.</td>
                        <td class="card-value-row">
                            <?php if (isset($flat["netRent"]) && isset($flat["ancillaryCosts"])) {
                                $total = $flat["netRent"] + $flat["ancillaryCosts"];
                                echo "CHF  $total.-";
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">+ NK/Mt.</td>
                        <td class="card-value-row">
                            <?php echo "CHF " . $flat["ancillaryCosts"] . ".-" ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Status</td>
                        <td class="card-value-row">
                            <?php
                            if (!empty($flat['available'])):
                                ?>
                                <a href="https://www.mywincasa.ch/<?php echo $lang ?>/candidate/<?php echo $flatLink; ?>"
                                   class="btn btn-sm bewerbe mb-0">Bewerben </a>
                            <?php
                            endif;
                            ?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
        <?php

    }
    if (count($privateFlatArray) > 0) { ?>
    <?php } else {
        ?>
        <div class="no-free-flats white-text"> Zur Zeit sind alle Wohnungen vermietet. Aktivieren Sie den <a
                    href="#wincasa-alarm">Wincasa Alarm</a> - so benachrichtigen wir Sie umgehend, sobald in dieser
            Liegenschaft eine Wohnung verf??gbar wird.
        </div>
    <?php }
    return ob_get_clean();
}

function get_mobile_cards_gewerbe()
{
    ob_start();
    $flatArrays = get_flats_sorted_by_streets();
    $privateFlatArray = [];
    foreach ($flatArrays as $street) {
        foreach ($street['flats'] as $flats) {
            if ($flats['type'] != 'PRIVATE' && $flats['type'] != "PARKING_SPACE" && isset($flats['available'])) {
                $privateFlatArray[] = $flats;
            }
        }
    }
    if (count($privateFlatArray) > 0) { ?>
    <?php }
    foreach ($privateFlatArray as $flat) { ?>
        <div class="swiper-slide">
            <?php
            $flatInfo = get_flat_info($flat['referenceNumber']);
            $flatPdfUrl = $flatInfo[0];
            $flatPhotos = $flatInfo[1];
            $flatLink = $flatInfo[2];
            ?>

            <div class="mobile-wohnen-card">
                <h2 class="mb-0 py-4 px-3"><?= $flat['building']['street'] ?></h2>
                <table class="w-100">
                    <tbody>
                    <tr>
                        <td class="card-title-row bold">Grundriss</td>
                        <td class="card-value-row">
                            <?php if (!empty($flatPdfUrl)) : ?>
                                <a href="<?php echo $flatPdfUrl; ?>" target="_blank">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/pdf.svg" alt=""
                                         style="width: 24px; margin-left:17px">
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Bilder</td>
                        <td class="card-value-row">
                            <?php if (!empty($flatPhotos)) : ?>
                                <a id="modal" href="#" data-number="<?php echo $flats["referenceNumber"] ?>"
                                   data-toggle="modal" data-target="#modal-<?php echo $flats['id']; ?>">
                                    <img src="<?php bloginfo('template_directory'); ?>/images/gallery.svg" alt=""
                                         style="width: 24px;">
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Objekt-Nr.</td>
                        <td class="card-value-row"> <?= $flat["referenceNumber"] ?></td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Objekt-Art</td>
                        <td class="card-value-row"> <?= setObjektArt($flat['type']); ?></td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Geschoss</td>
                        <td class="card-value-row">
                            <?php if ($flat['floor'] == 'EG') {
                                echo 'Erdgeschoss';
                            } else if ($flat['floor'] >= 1) {
                                echo $flat['floor'] . ". Stock";
                            } else {
                                echo $flat['floor'];
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Zimmer</td>
                        <td class="card-value-row">
                            <?= $flat['numberOfRooms'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Fl??che</td>
                        <td class="card-value-row">
                            <?php if (isset($flat["size"])) {
                                echo $flat["size"] . "m&#178;";
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Miete Netto/Mt.</td>
                        <td class="card-value-row">
                            <?php echo "CHF " . $flat["netRent"] . ".-" ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">+ NK/Mt.</td>
                        <td class="card-value-row">
                            <?php echo "CHF " . $flat["ancillaryCosts"] . ".-" ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="card-title-row bold">Status</td>
                        <td class="card-value-row">
                            <?php
                            if (!empty($flat['available'])):
                                ?>
                                <a href="https://service.wincasa.ch/Dokumentencenter-Ein-Auszug-Bewerbung_Gewerbe/"
                                   class="btn btn-sm bewerbe mb-0">Bewerben </a>
                            <?php
                            endif;
                            ?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
        <?php

    }
    if (count($privateFlatArray) > 0) { ?>
    <?php } else {
        ?>
        <div class="no-free-flats white-text"> Zur Zeit sind alle Wohnungen vermietet. Aktivieren Sie den <a
                    href="#wincasa-alarm">Wincasa Alarm</a> - so benachrichtigen wir Sie umgehend, sobald in dieser
            Liegenschaft eine Wohnung verf??gbar wird.
        </div>
    <?php }
    return ob_get_clean();
}

/****************************
 *          MODAL           *
 * *************************/
function create_park_info_modal($flat)
{
    ?>
    <div class="modal fade" id="modal-<?php echo $flat['id']; ?>" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="red-text">Mehr Informationen</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="red-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-flat-details">
                        <ul class="red-text">
                            <li>
                                <p class="red-text">Referenznummer: <?php echo $flat['referenceNumber']; ?></p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

function create_contact_modal()
{
    ?>
    <div class="modal fade" id="modal-kontakt" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="red-text">Kontakt </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="red-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-flat-details">
                        <ul class="red-text">
                            <li>
                                <a href="mailto:info@wincasa.ch"><img style="height:31px; margin-right:15px"
                                                                      src="<?php bloginfo('template_directory'); ?>/images/ic-bewerben.svg">info@wincasa.ch</a>
                            </li>
                            <li class="mt-4">
                                <a href="tel:0584557777"><img style="height:31px;  margin-right:15px"
                                                              src="<?php bloginfo('template_directory'); ?>/images/ic-kontakt.svg">058
                                    455 77 77</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

function create_modal($flat)
{
    ?>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter-<?php echo $flat['id']; ?>" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="red-text">Mehr Informationen</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="red-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-flat-details">

                        <ul class="red-text">
                            <li><span>Strasse:</span> <?php echo $flat['building']['street']; ?></li>
                            <li><span>Ort:</span> <?php echo $flat['building']['city']; ?></li>
                            <li><span>PLZ:</span> <?php echo $flat['building']['zipCode'] ?></li>
                            <li><span>Stockwerk:</span> <?php echo $flat['floor']; ?></li>
                            <li><span>Gr??sse:</span> <?php echo $flat['size']; ?> m<sup>2</sup></li>
                            <li><span>Referenznummer:</span> <?php echo $flat['referenceNumber']; ?></li>
                            <?php if ($flat['type'] == "PRIVATE") { ?>
                                <li><span>Anzahl Zimmer:</span> <?php echo $flat['numberOfRooms']; ?></li>
                            <?php } ?>
                            <!--<li><span>Typ:</span> PRIVATE</li>-->
                            <li><span>Status:</span> <?php if (isset($flat['available'])) {
                                    echo "Frei";
                                } else {
                                    echo "Vermietet";
                                } ?></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
}

function get_popups()
{
    $streets = get_flats_sorted_by_streets();
    foreach ($streets as $street) {
        foreach ($street['flats'] as $flat) {
            $flatInfo = get_flat_info($flat['referenceNumber']);
            $flatPdfUrl = $flatInfo[0];
            $flatPhotos = $flatInfo[1];
            $flatLink = $flatInfo[2];

            ?>

            <div class="modal fade" id="modal-<?php echo $flat['id']; ?>" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="false">
                <div class="modal-dialog  modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Objekt-Nr. <?= $flat['referenceNumber'] ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="carouselControls-<?php echo $flat['id']; ?>" class="carousel slide"
                                 data-ride="carousel">
                                <div class="carousel-inner">

                                    <?php $p = 0; ?>

                                    <?php foreach ($flatPhotos as $flatPhoto) : ?>
                                        <div class="carousel-item <?php if ($p == 0) echo 'active'; ?>">
                                            <img src="<?= $flatPhoto; ?>" class="d-block w-100" alt="">
                                        </div>
                                        <?php $p++; ?>
                                    <?php endforeach; ?>

                                </div>

                                <?php if ($p > 1) : ?>
                                    <a class="carousel-control-prev" href="#carouselControls-<?php echo $flat['id']; ?>"
                                       role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselControls-<?php echo $flat['id']; ?>"
                                       role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

function get_flat_info($flat_number)
{
    static $flatsInfo = [];
    if (!$flatsInfo) {
        $flatsInfo = get_field('flats', 'option');
    }
    $flatsInfo = get_field('flats', 'option');
    foreach ($flatsInfo as $flatInfo) {
        if ($flat_number == $flatInfo['flat_no']) {

            return array($flatInfo['pdf'], $flatInfo['photos'], $flatInfo['link']);
        }

    }
    return '';
}

add_shortcode('get_mobile_cards_park', 'get_mobile_cards_park');
add_shortcode('get_mobile_cards_gewerbe', 'get_mobile_cards_gewerbe');
add_shortcode('get_mobile_cards_wohnungen', 'get_mobile_cards_wohnungen');
add_shortcode('get_wohnungen_free_table', 'generate_wohnungen_free_table');
add_shortcode('get_wohnungen_all_table', 'generate_wohnungen_all_table');

add_shortcode('get_gewerbe_free_table', 'generate_gewerbe_free_table');
add_shortcode('get_gewerbe_all_table', 'generate_gewerbe_all_table');

add_shortcode('get_park_free_table', 'generate_park_free_table');
add_shortcode('get_park_all_table', 'generate_park_all_table');

if (function_exists('add_image_size')) {
    add_image_size('news', 1030, 1999, false);
    add_image_size('thumb', 690, 690, false);
    add_image_size('gallery', 1080, 1080, false);
    add_image_size('gallery-thumb', 526, 340, true); //(cropped)
    add_image_size('cover', 1352, 540, true); //(cropped)
    add_image_size('cover-mob', 700, 600, true); //(cropped)
    add_image_size('banner', 1920, 440, true); //(cropped)
    add_image_size('banner-mob', 600, 440, true); //(cropped)
    add_image_size('swiper', 580, 317, true);
    add_image_size('swiper-mob', 330, 317, true);
}

add_filter('acf/load_field/name=flat_no', function ($field) {

    $flatArrays = get_flats();
    $flatArray = [];
    foreach ($flatArrays as $flats) {
        $flatArray[] = $flats;
    }
    $choices = [];
    foreach ($flatArray as $content) {
        foreach ($content as $item) {
            $choices[$item['referenceNumber']] = $item['referenceNumber'];
        }
    }
    $field['choices'] = $choices;
    return $field;
});


if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Slider',
        'menu_title' => 'Theme Slider',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
    acf_add_options_page(array(
        'page_title' => 'Data',
        'menu_title' => 'Site Data',
        'menu_slug' => 'theme-general-images',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_page(array(
        'page_title' => 'Flats',
        'menu_title' => 'Flats Info',
        'menu_slug' => 'theme-general-flats',
        'capability' => 'edit_posts',
        'redirect' => false
    ));


}

/**********************END API**************************/
/**************MAIL SENDING WINCASA ALARM********************************/


function wpb_sender_email($original_email_address)
{
    return get_field('mail_sender_mail', 'option');
}

// Function to change sender name
function wpb_sender_name($original_email_from)
{
    return get_field('mail_sender_name', 'option');
}

// Hooking up our functions to WordPress filters 
add_filter('wp_mail_from', 'wpb_sender_email');
add_filter('wp_mail_from_name', 'wpb_sender_name');


/**************END MAIL SENDING********************************/

include 'js/wp_bootstrap_navwalker.php';


function register_my_menus()
{
    register_nav_menus(
        array(
            'primary' => __('Main menu'),
            'footer' => __('Footer meni'),
        )
    );
}

add_action('init', 'register_my_menus');


/****************ULTIMATE MEMBER FIELDS***********************/


