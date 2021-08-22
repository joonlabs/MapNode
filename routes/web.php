<?php

use Curfle\FileSystem\FileSystem;
use Curfle\Http\Request;
use Curfle\Http\Response;
use Curfle\Support\Exceptions\Http\NotFoundHttpException;
use Curfle\Support\Facades\Route;

/**
 * Here the default web routes can be registered. All routes in this directory get
 * will receive the web middleware stack. Now start creating something awesome!
 */

/**
 * MapNode application serving.
 */
Route::get("/mapnode/{mandant}/{token}", function (Request $request) {
    return view("application", [
        "mandant" => $request->input("mandant"),
        "token" => $request->input("token"),
    ]);
})->where("mandant", "[0-9]+")
    ->where("token", "([a-z]|[A-Z]|[0-9])+");

/**
 * Confirming entries, which were created by the GraphQL api.
 */
Route::get("/confirm/eintrag/{id}", function (Request $request) {
    // obtain entry
    $eintrag = \App\Models\Eintrag::get($request->input("id"));

    // check if entry exists
    if ($eintrag === null)
        abort(404, "Not found");

    // update entry
    $eintrag->bestaetigt = true;
    $eintrag->update();

    // return view
    return view("confirmed", [
        "subject" => "Ihr Eintrag"
    ]);
})->where("id", "[0-9]+");

/**
 * Confirming messages, which were created by the GraphQL api.
 */
Route::get("/confirm/nachricht/{id}", function (Request $request) {
    // obtain entry
    $nachricht = \App\Models\Nachricht::get($request->input("id"));

    // check if entry exists
    if ($nachricht === null)
        abort(404, "Not found");

    // update entry
    $nachricht->bestaetigt = true;
    $nachricht->update();

    // return view
    return view("confirmed", [
        "subject" => "Ihre Nachricht"
    ]);
})->where("id", "[0-9]+");

/**
 * Serving route for the vue project. All requests are catched
 * and redirected by this route. After trying to resolve the request
 * it either returns the according file content, or throws a 404 HTTP
 * dispatchable exception.
 */
Route::get('/{uri}', function (Request $request, Response $response, FileSystem $files) {

    // determine uri
    $uri = $request->input("uri");
    if (in_array($uri, ["", "/"]))
        $uri = "index.html";

    // obtain real path in file system
    $file = __DIR__ . "/../public/vue/dist/$uri";

    // load the file if exists, or throw new 404 error
    if ($files->exists($file)) {
        $content = $files->get($file);
        $response->setHeader("Content-Type", $files->contentType($file));
        return $content;
    } else {
        throw new NotFoundHttpException("Not found", 404);
    }

})->where("uri", ".*");