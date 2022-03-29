"""
Generator of pcjs_api's layer
--js
--php
--py
-U "Server"
"""
from os import access
from pcjs_api import PCJsApi
import argparse


def generate_php(js: PCJsApi) -> str:
    return ""


def generate_js(js: PCJsApi) -> str:
    val = [
        "class PcJsApi_Layers {",
        " "*4 + "constructor(url) {",
        " "*8 + "this.rcjs = new RcJsApi(url);",
        " "*4 + "}"
    ]
    for key,value in js.System.items():
        val.append(" " * 4 + key + "(" + ", ".join(value["POST"]) + ") {")
        val.append(" " * 8 + "return this.rcjs.getJsBySystem(")
        val.append(" " * 12 + "\"" + key + "\", {")
        if len(value["POST"]) != 0:
            for i in value["POST"]:
                val.append(" " * 16 + "\"" + i + "\": " + i + ",")
            val[-1] = val[-1][0:-2]
        val.append(" " * 12 + "}")
        val.append(" " * 8 + ");")
        val.append(" " * 4 + "}")
    val.append("}")
    return "\n".join(val)

def generate_py(js: PCJsApi) -> str:
    return ""

parser = argparse.ArgumentParser()
parser.add_argument("--js", help="generator for javascript")
parser.add_argument("--php", help="generator for php")
parser.add_argument("--py", help="generator for python")
parser.add_argument("-U", help="url of the PcJsApi", type=str, required=True)
args = parser.parse_args()

if __name__ == "__main__":
    pcjs = PCJsApi(args.U)
    if args.php is not None:
        open(args.php, "w").write(
            generate_php(pcjs)
        )    
    if args.js is not None:
        open(args.js, "w").write(
            generate_js(pcjs)
        )
    if args.py is not None:
        open(args.py, "w").write(
            generate_php(pcjs)
        )
    