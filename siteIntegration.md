# Smart Solutions Site Integration 

A integração da listagem de dentistas é feita via um único endpoint REST:

`GET https://sis.smartsolutions3d.com.br/api/dentists`

Esse endpoint sempre retorna um JSON com os dados dos dentistas encontrados.

Não há autenticação (apenas controle de throttling).

Os filtros devem ser passados diretamente na query string, sendo os nomes dos campos 
sempre em caixa baixa. Os valores devem codificados para URL, preferencialmente sem acentos e em 
caixa alta (caso isso não seja feito, a API vai realizar a sanitização de qualquer forma).

Os filtros disponíveis no momento são os de cidade e estado (*city* e *state*). Caso seja necessário 
a inclusão de outros filtros, favor solicitar ao responsável pelo sistema (a viabilidade será analisada
e o filtro incluído). Abaixo há alguns exemplos
de requisições possíveis:

`GET https://sis.smartsolutions3d.com.br/api/dentists?state=sp`
Retorna todos os dentistas do estado de São Paulo.

`GET https://sis.smartsolutions3d.com.br/api/dentists?city=curitiba`
Retorna todos os dentistas da cidade de Curitiba.

`GET https://sis.smartsolutions3d.com.br/api/dentists?state=pr&city=ponta+grossa`
Retorna todos os dentistas da cidade de Ponta Grossa (atenção para o `+` que é o espaço na codificação
para URL)

Nota importante, sempre TODOS os filtros são aplicados, então cuidado para não enviar filtros que não 
fazem sentido, como por exemplo:
`GET https://sis.smartsolutions3d.com.br/api/dentists?state=sp&city=ponta+grossa`

Ponta Grossa não fica em SP, por isso essa consulta vai sempre retornar vazio.

## Formato de retorno (paginação)

O retorno é sempre formatado em JSON, e por padrão é paginado. Exemplo:

```json
{
    "current_page": 1,
    "data": [
        {
            "name": "FREDDIE MERCURY",
            "email": "dentista1@gmail.com",
            "city": "CURITIBA",
            "state": "PR",
            "phone": "41-3333-0001",
            "cellphone": "41-99999-0001"
        },
        {
            "name": "BRIAN MAY",
            "email": "dentista2@gmail.com",
            "city": "LONDRINA",
            "state": "PR",
            "phone": "43-3333-0000",
            "cellphone": "43-99999-0002"
        },
        {
            "name": "JOHN DEACON",
            "email": "dentista3@gmail.com",
            "city": "PONTA GROSSA",
            "state": "PR",
            "phone": "42-3333-0003",
            "cellphone": "42-99999-0003"
        },
        {
            "name": "ROGER TAYLOR",
            "email": "dentista4@gmail.com",
            "city": "MARINGA",
            "state": "PR",
            "phone": "44-3333-0004",
            "cellphone": "44-99999-0004"
        },
        {
            "name": "AABEX MARTINS RIBEIRO",
            "email": "jefersonparanaense@gmail.com",
            "city": "RIO BRANCO",
            "state": "AC",
            "phone": "41-9888-7825",
            "cellphone": null
        },
        {
            "name": "ADELIA MARIA XIMENES LELIS GUERRA",
            "email": "adelia@gmail.com",
            "city": "RIO BRANCO",
            "state": "AC",
            "phone": null,
            "cellphone": null
        },
        {
            "name": "ADELIA MARIA XIMENES LELIS GUERRA",
            "email": "adelia@gmail.com",
            "city": "RIO BRANCO",
            "state": "AC",
            "phone": null,
            "cellphone": null
        },
        {
            "name": "ADELIA MARIA XIMENES LELIS GUERRA",
            "email": "adelia@gmail.com",
            "city": "RIO BRANCO",
            "state": "AC",
            "phone": null,
            "cellphone": null
        },
        {
            "name": "ISABELLA SIMOES HOLZ",
            "email": "asdf@gmail.com",
            "city": "VITORIA",
            "state": "ES",
            "phone": null,
            "cellphone": null
        }
    ],
    "first_page_url": "https://sis.smartsolutions3d.com.br/api/dentists?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://sis.smartsolutions3d.com.br/api/dentists?page=1",
    "next_page_url": null,
    "path": "https://sis.smartsolutions3d.com.br/api/dentists",
    "per_page": "10",
    "prev_page_url": null,
    "to": 9,
    "total": 9
}
```

O formato é auto-exlicativo. Perceba que os dados em si estão no campo `data`, mas são limitados
a um certo número de items.
Os links para outras páginas são enviados na requisição, e podem ser utilizados na interface.

Você ainda pode personalizar o número de registros por página utilizando o campo `perpage` 
(o padrão é 15):

`GET https://sis.smartsolutions3d.com.br/api/dentists?perpage=5&state=pr`

Ou desativar completamente a paginação setando `perpage` para '0' (o que em geral não é uma boa 
ideia):

`GET https://sis.smartsolutions3d.com.br/api/dentists?perpage=0&state=pr`

O retorno nesse caso fica assim:

```json
[
    {
        "name": "FREDDIE MERCURY",
        "email": "dentista1@gmail.com",
        "city": "CURITIBA",
        "state": "PR",
        "phone": "41-3333-0001",
        "cellphone": "41-99999-0001"
    },
    {
        "name": "BRIAN MAY",
        "email": "dentista2@gmail.com",
        "city": "LONDRINA",
        "state": "PR",
        "phone": "43-3333-0000",
        "cellphone": "43-99999-0002"
    },
    {
        "name": "JOHN DEACON",
        "email": "dentista3@gmail.com",
        "city": "PONTA GROSSA",
        "state": "PR",
        "phone": "42-3333-0003",
        "cellphone": "42-99999-0003"
    },
    {
        "name": "ROGER TAYLOR",
        "email": "dentista4@gmail.com",
        "city": "MARINGA",
        "state": "PR",
        "phone": "44-3333-0004",
        "cellphone": "44-99999-0004"
    }
]
```
