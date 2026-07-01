# Esquema de base de dades — Projecte Fruiter (Laravel)

Migracions, models Eloquent i enums per a la capa de dades de l'ERP del fruiter.
Pensat per a **Laravel 11/12** i **PHP 8.1+**.

## Com fer-ho servir

1. Copia les carpetes dins del teu projecte Laravel respectant l'estructura:
   - `database/migrations/` → les 9 migracions
   - `app/Models/` → els 9 models
   - `app/Enums/` → els 9 enums
2. Configura la connexió a la BD al `.env`.
3. Executa:
   ```bash
   php artisan migrate
   ```

## Taules

| Taula            | Model          | Rol                                             |
|------------------|----------------|-------------------------------------------------|
| `clients`        | `Client`       | Mestre de clients comercials                    |
| `productes`      | `Producte`     | Mestre de productes (fruita/verdura)            |
| `preus_client`   | `PreuClient`   | Preu especial pactat per client i producte      |
| `rutes`          | `Ruta`         | Ruta de repartiment d'un dia                    |
| `comandes`       | `Comanda`      | Comanda d'un client                             |
| `linies_comanda` | `LiniaComanda` | Línies de detall d'una comanda                  |
| `factures`       | `Factura`      | Factura mensual per client                      |
| `albarans`       | `Albara`       | Albarà d'entrega d'una comanda                  |
| `missatges_bot`  | `MissatgeBot`  | Registre de missatges entrants del bot          |

## Decisions de disseny (llegeix això)

**1. Imports amb `decimal`, mai `float`.**
Tots els preus i quantitats són columnes `decimal` amb el cast corresponent
(`decimal:2` per euros, `decimal:3` per quantitats amb fraccions de kg). Mai
guardis diners en `float`: els arrodoniments et faran quadrar malament les factures.

**2. Enums de PHP en lloc de strings solts.**
Els camps de valors fixos (estats, tipus, categories, origen) són `enum`
de PHP 8.1 amb cast automàtic. Així el codi no depèn de strings escrits a mà i
tens autocompletat i seguretat de tipus. A la BD es guarden com a `string`.

**3. La ruta ja NO es guarda com a JSON.**
A l'esquema original, `rutes` tenia un camp `ordre_parades` en JSON amb la llista
de comandes. Ho he fet **relacional**: cada comanda té `ruta_id` (nullable) i
`ordre_ruta`. Motiu: pots consultar, filtrar i marcar entregues per comanda
directament amb Eloquent (`$ruta->comandes` ja et ve ordenat). Amb JSON hauries
de desempaquetar-lo a mà cada cop.

**4. Els albarans s'enllacen a la factura amb una FK, no amb JSON.**
En lloc d'`albarans_inclosos` en JSON dins de `factures`, cada albarà té
`factura_id` (nullable). Una factura mensual → molts albarans
(`$factura->albarans`). Quan generes la factura, assignes la FK als albarans
del mes. Més net i sense taula pivot.

**5. `created_at` fa de "data de creació".**
On l'esquema tenia `data_creacio` (comandes) o `data` (missatges_bot), faig servir
els `timestamps()` estàndard de Laravel. No cal duplicar el camp.

**6. Comportament d'esborrat pensat.**
   - Esborrar un client/producte → s'esborren els seus `preus_client` (cascade).
   - Esborrar una comanda → s'esborren les seves línies (cascade).
   - Esborrar una ruta → les comandes NO s'esborren, només perden `ruta_id`.
   - Esborrar una factura → els albarans NO s'esborren, només perden `factura_id`.
   - No pots esborrar un client si té comandes (restricció per defecte).

   De totes maneres, els clients i productes tenen un flag `actiu`, així que la idea
   és desactivar-los, no esborrar-los.

## Què falta (propers passos naturals)

- **Factories i seeders** per poder provar amb dades falses (`php artisan migrate:fresh --seed`).
- **Càlcul de subtotals/totals** centralitzat (ara la `Comanda::total()` suma línies;
  valdria la pena moure la lògica de preus a un servei).
- **Controllers i rutes** del dashboard (Avui, Comandes, Rutes, Clients, Facturació).
- **Jobs i cues** per a la capa del bot (transcripció Whisper + interpretació LLM).
