# Smart Solutions



## Notas de instalação / manutenção

TODO - Tam Cargo - zipRanges:load

## Ambiente:

Toda a configuração de ambiente deve ser realizada no arquivo `.env`. Abaixo seguem as configurações possíveis, com suas
descrições. Todas as configurações que tem um valor default, não precisam ser definidas.

### Frete:

#### Retirada no local:
**LOCAL_PICK_NAME (string, default 'Retirada na Smart Solutions.')** - Texto que será apresentado como nome da forma de envio.
**LOCAL_PICK_PRIZE (string)** - Texto que representa o prazo de entrega.

#### Entrega na região:
**LOCAL_SHIPPING_NAME (string, default 'Entrega feita pela Smart Solutions (Grande Rio e Niteroi)')** - Texto que será apresentado como nome da forma de envio.
**LOCAL_SHIPPING_LOWER_ZIP_LIMIT (string, default 20000)** - Menor CEP atendido (5 dígitos)
**LOCAL_SHIPPING_HIGHER_ZIP_LIMIT (string, default 26600)** - Maior CEP atendido (5 dígitos)
**LOCAL_SHIPPING_PRICE (float)** - Preço para entrega na região
**LOCAL_SHIPPING_PRIZE (string)** - Texto que representa o prazo de entrega.

#### Correios
**CORREIOS_NAME (string, default 'Correios | SEDEX')** - Texto que será apresentado como nome da forma de envio.
**CORREIOS_BASE_URL (string, default 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx')** - URL base do webservice dos correios.



#### TAM Cargo
**TAM_CARGO_NAME (string, default 'Transporte aéreo (TAM Cargo)')** - Texto que será apresentado como nome da forma de envio.




