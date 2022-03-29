import json
from turtle import st
from typing import Dict
from urllib import request
from requests import get, post, Response


class PCJsApi:
    url: str
    System: dict

    def __init__(self, url: str):
        self.url = url
        self.System = json.loads(get(self.url, {"MM1_jc": "200"}).text)

    def getResolveBySystem(self, name: str, post_data: dict = None) -> request.Response:
        """Get the response of the server with this cursor"""
        if post_data is None:
            post_data = {}

        def getUrl(url: str, get_data: dict):
            """Get the url with GET data"""
            data_get = []
            for key, value in get_data.items():
                data_get.append(key + "=" + value)
            return url + "?" + "&".join(data_get)
        resolve = post(getUrl(self.url, self.System[name]["GET"]), data=post_data)
        return resolve

    def getJsBySystem(self, name: str, post_data: dict = None):
        """Get json response of the server with this cursor"""
        resolve = self.getResolveBySystem(name, post_data)
        return json.loads(resolve.text)
