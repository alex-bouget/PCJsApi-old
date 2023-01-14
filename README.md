# PCJsApi


## Summary

- [PCJsApi](#pcjsapi)
  - [Summary](#summary)
  - [Connection to a PCJsApi](#connection-to-a-pcjsapi)
  - [Get data (function)](#get-data-function)
    - [Call a function](#call-a-function)
    - [Get the components](#get-the-components)
    - [Types of parameters](#types-of-parameters)


## Connection to a PCJsApi

Use the url (ex: `http://localhost:8080`) 

Warning: not sur that it will work if php is not launched in the `src` folder

## Get data (function)

Data are the heart of PCJsApi, there is a way to know the components and the functions they carry.

### Call a function

For call a function, you just have to give its name and its parameters

Exemple: the function `Test.count(int number)` can be called with:

`GET: ?entry=Test.count`

`POST: number=1`

### Get the components

This part is not important. normally, there is no need to know the components.

For get the components, you just have to use the function `PcJsApi.get_components`

`GET: ?entry=PcJsApi.get_components`

`POST:`

normally the response is an array of components:
```json
{
    "RealcomponentsName": {
        "name": "LogicComponentsName",
        "parameters": {
            "Entry": "LogicComponentsName",
            ...
        },
        "entries": [
            "LogicComponentsName.entry1",
            "LogicComponentsName.entry2",
            ...
        ]
    },
    ...
}
```

### Get the functions of the api

This part is important, it allows you to know ALL the possible functions of the api.

For get the functions, you just have to use the function `PcJsApi.get_entries`

`GET: ?entry=PcJsApi.get_entries`

`POST:`

normally the response is an array of functions:
normalement la réponse serat un tableau de fonctions:
```json
{
    "LogicComponentsName.entry1": [
        {
            "name": "parameters1",
            "type": "?int"
        },
        ...
    ],
    ...
}
```

### Types of parameters

- `?int` : an integer number that can be null
- `int` : an integer number that can not be null
- `?string` : a string that can be null
- `string` : a string that can not be null
- `?bool` : a boolean that can be null
- `bool` : a boolean that can not be null
- `?float` : a decimal number that can be null
- `float` : a decimal number that can not be null