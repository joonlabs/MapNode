<?php

use Curfle\Http\Request;
use Curfle\Http\Response;
use Curfle\Support\Facades\Auth;
use Curfle\Support\Facades\Route;

error_reporting(E_ALL ^ E_DEPRECATED);

/**
 * Here the api routes can be registered. All routes in this directory
 * will receive the "api" middleware group. Also, they will get the
 * "/api" prefix. Enjoy building your api!
 */
Route::methods([Route::POST, Route::OPTIONS], '/', function (Request $request) {
    $server = new \GraphQL\Servers\Server(\App\GraphQL\Schema::get());
    $server->setInternalServerErrorPrint(config("app.debug"));
    return $server->handle();
});

Route::get("/download/{mandant}/{token}", function (Request $request, Response $response) {
    // get parameters
    $mandant = intval($request->input("mandant"));
    $token = $request->input("token");

    // validate request
    $request->setHeaders(array_merge($request->headers(), ["Authorization" => "Bearer $token"]));
    if (!Auth::validate($request))
        abort(403, "Access denied");

    // get data and download as json
    $server = new \GraphQL\Servers\Server(\App\GraphQL\Schema::get());
    $server->setInternalServerErrorPrint(config("app.debug"));
    $filename = "mandant_{$mandant}_" . time();
    $data = $server->handle("
        {
            mandant(id:$mandant){
                eintraege{
                    id
                    name
                    inhalt
                    upvotes
                    latitude
                    longitude
                    kategorie{
                        name
                        farbe
                    }
                    buerger{
                        vorname
                        nachname
                        email
                    }
                    nachrichten{
                        inhalt
                        buerger{
                            vorname
                            nachname
                            email
                        }
                        bestaetigt
                        erstellt
                        namen_veroeffentlichen
                    }
                    bestaetigt
                    erstellt
                }
            }
        }
    ");
    //var_dump($data);
    //exit();
    $response->setHeader("Content-disposition", "attachment; filename=$filename.csv");
    $response->setHeader("Content-Type", "text/csv");

    $eintraege = [];
    foreach ($data["data"]["mandant"]["eintraege"] as $eintrag) {
        $eintrag["anzahl_nachrichten"] = array_reduce($eintrag["nachrichten"], fn($c, $n) => $c + $n["bestaetigt"] ? 1 : 0, 0);
        $eintraege[] = flatten($eintrag);

        // add Nachrichten entries
        foreach ($eintrag["nachrichten"] as $nachricht) {
            $nachricht = [
                "id" => "",
                "name" => "",
                "inhalt" => $nachricht["inhalt"],
                "latitude" => "",
                "longitude" => "",
                "kategorie_name" => "",
                "kategorie_farbe" => "",
                "buerger_vorname" => $nachricht["buerger"]["vorname"],
                "buerger_nachname" => $nachricht["buerger"]["nachname"],
                "buerger_email" => $nachricht["buerger"]["email"],
                "bestaetigt" => $nachricht["bestaetigt"],
                "erstellt" => $nachricht["erstellt"],
                "anzahl_nachrichten" => "",
            ];
            $eintraege[] = flatten($nachricht);
        }
    }

    return buildCSV($eintraege);
})->where("mandant", "[0-9]+")
    ->where("token", "([a-z]|[A-Z]|[0-9]|\.|\_|\-)+");

/**
 * Flattens a data array for csv export.
 *
 * @param array $array
 * @return array
 */
function flatten(array $array): array
{
    unset($array["nachrichten"]);
    $return = [];
    array_walk($array, function ($item, $key) use (&$return) {
        if (!is_array($item))
            $return[$key] = $item;
        else {
            $inner = flatten($item);
            foreach ($inner as $innerKey => $innerItem) {
                $return["{$key}_$innerKey"] = $innerItem;
            }
        }
    });
    return $return;
}

function buildCSV(array $array): string
{
    $csv = "";
    $csv .= implode(",", array_keys(reset($array)));
    foreach ($array as $value) {
        array_walk($value, function(&$val){
            $val = str_replace('"', '""', $val);
        });
        $csv .= "\n\"" . implode('","', $value)."\"";
    }
    return $csv;
}