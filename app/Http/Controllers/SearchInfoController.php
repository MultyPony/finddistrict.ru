<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchInfoController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $requestAddress = $request->address;

        $res = $this->makeRequest($requestAddress);

        $coords = $this->getCoords($res);
        $res = $this->makeRequest($coords);
        $res = $this->getDistrictFromCoords($res);
//        dd($res);
        return response()->json(mb_convert_encoding($res, "UTF-8"));
    }

    private function getDistrictFromCoords($res)
    {
        $districts = [];
        if($res->response
            && $res->response->GeoObjectCollection
            && $res->response->GeoObjectCollection->featureMember
            && $res->response->GeoObjectCollection->featureMember) {
            foreach ($res->response->GeoObjectCollection->featureMember as $member) {
                foreach($member->GeoObject
                            ->metaDataProperty
                            ->GeocoderMetaData
                            ->Address
                            ->Components as $component) {
                    if ($component->kind && $component->kind == 'district') {
                        $districts[] = $component->name;
                    }
                }
            }
        }
        return $districts;
    }

    private function getCoords($res)
    {
        if($res->response
            && $res->response->GeoObjectCollection
            && $res->response->GeoObjectCollection->featureMember
            && $res->response->GeoObjectCollection->featureMember) {
            foreach ($res->response->GeoObjectCollection->featureMember as $member) {
                if ($member->GeoObject
                    && $member->GeoObject->Point
                    && $member->GeoObject->Point->pos) {
                    return str_replace(' ', ',', $member->GeoObject->Point->pos);
                }
            }
        }
        return null;
    }

    private function makeRequest($address)
    {
        $data = [];
        $data['apikey'] = env('YANDEX_GEOCODER_KEY');
        $data['geocode'] = $address;
        $data['format'] = 'json';
        $data['kind'] = 'district';

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://geocode-maps.yandex.ru/1.x', [
            'http_errors' => false,
            'query' => $data,
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
