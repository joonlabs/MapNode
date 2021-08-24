<?php

use Curfle\Http\Request;
use Curfle\Http\Response;
use Curfle\Support\Facades\Auth;
use Curfle\Support\Facades\Route;

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
    $response->setHeader("Content-disposition", "attachment; filename=$filename.xml");
    $response->setHeader("Content-Type", "text/xml");
    echo array2xml($data["data"]["mandant"]);
})->where("mandant", "[0-9]+")
    ->where("token", "([a-z]|[A-Z]|[0-9]|\.|\_|\-)+");

function array2xml($array, $xml = false): bool|string
{

    if ($xml === false) {
        $xml = new SimpleXMLElement('<mandant/>');
    }

    foreach ($array as $key => $value) {
        if(is_int($key))
            $key = "eintrag$key";
        if (is_array($value)) {
            array2xml($value, $xml->addChild($key));
        } else {
            $xml->addChild($key, $value);
        }
    }

    return $xml->asXML();
}