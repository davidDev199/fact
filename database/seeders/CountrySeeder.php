<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = json_decode('[
            {
            "Country": "AALAND ISLANDS",
            "A2": "AX",
            "A3": "ALA",
            "Number": 248
            },
            {
            "Country": "AFGHANISTAN",
            "A2": "AF",
            "A3": "AFG",
            "Number": 4
            },
            {
            "Country": "ALBANIA",
            "A2": "AL",
            "A3": "ALB",
            "Number": 8
            },
            {
            "Country": "ALGERIA",
            "A2": "DZ",
            "A3": "DZA",
            "Number": 12
            },
            {
            "Country": "AMERICAN SAMOA",
            "A2": "AS",
            "A3": "ASM",
            "Number": 16
            },
            {
            "Country": "ANDORRA",
            "A2": "AD",
            "A3": "AND",
            "Number": 20
            },
            {
            "Country": "ANGOLA",
            "A2": "AO",
            "A3": "AGO",
            "Number": 24
            },
            {
            "Country": "ANGUILLA",
            "A2": "AI",
            "A3": "AIA",
            "Number": 660
            },
            {
            "Country": "ANTARCTICA",
            "A2": "AQ",
            "A3": "ATA",
            "Number": 10
            },
            {
            "Country": "ANTIGUA AND BARBUDA",
            "A2": "AG",
            "A3": "ATG",
            "Number": 28
            },
            {
            "Country": "ARGENTINA",
            "A2": "AR",
            "A3": "ARG",
            "Number": 32
            },
            {
            "Country": "ARMENIA",
            "A2": "AM",
            "A3": "ARM",
            "Number": 51
            },
            {
            "Country": "ARUBA",
            "A2": "AW",
            "A3": "ABW",
            "Number": 533
            },
            {
            "Country": "AUSTRALIA",
            "A2": "AU",
            "A3": "AUS",
            "Number": 36
            },
            {
            "Country": "AUSTRIA",
            "A2": "AT",
            "A3": "AUT",
            "Number": 40
            },
            {
            "Country": "AZERBAIJAN",
            "A2": "AZ",
            "A3": "AZE",
            "Number": 31
            },
            {
            "Country": "BAHAMAS",
            "A2": "BS",
            "A3": "BHS",
            "Number": 44
            },
            {
            "Country": "BAHRAIN",
            "A2": "BH",
            "A3": "BHR",
            "Number": 48
            },
            {
            "Country": "BANGLADESH",
            "A2": "BD",
            "A3": "BGD",
            "Number": 50
            },
            {
            "Country": "BARBADOS",
            "A2": "BB",
            "A3": "BRB",
            "Number": 52
            },
            {
            "Country": "BELARUS",
            "A2": "BY",
            "A3": "BLR",
            "Number": 112
            },
            {
            "Country": "BELGIUM",
            "A2": "BE",
            "A3": "BEL",
            "Number": 56
            },
            {
            "Country": "BELIZE",
            "A2": "BZ",
            "A3": "BLZ",
            "Number": 84
            },
            {
            "Country": "BENIN",
            "A2": "BJ",
            "A3": "BEN",
            "Number": 204
            },
            {
            "Country": "BERMUDA",
            "A2": "BM",
            "A3": "BMU",
            "Number": 60
            },
            {
            "Country": "BHUTAN",
            "A2": "BT",
            "A3": "BTN",
            "Number": 64
            },
            {
            "Country": "BOLIVIA",
            "A2": "BO",
            "A3": "BOL",
            "Number": 68
            },
            {
            "Country": "BOSNIA AND HERZEGOWINA",
            "A2": "BA",
            "A3": "BIH",
            "Number": 70
            },
            {
            "Country": "BOTSWANA",
            "A2": "BW",
            "A3": "BWA",
            "Number": 72
            },
            {
            "Country": "BOUVET ISLAND",
            "A2": "BV",
            "A3": "BVT",
            "Number": 74
            },
            {
            "Country": "BRAZIL",
            "A2": "BR",
            "A3": "BRA",
            "Number": 76
            },
            {
            "Country": "BRITISH INDIAN OCEAN TERRITORY",
            "A2": "IO",
            "A3": "IOT",
            "Number": 86
            },
            {
            "Country": "BRUNEI DARUSSALAM",
            "A2": "BN",
            "A3": "BRN",
            "Number": 96
            },
            {
            "Country": "BULGARIA",
            "A2": "BG",
            "A3": "BGR",
            "Number": 100
            },
            {
            "Country": "BURKINA FASO",
            "A2": "BF",
            "A3": "BFA",
            "Number": 854
            },
            {
            "Country": "BURUNDI",
            "A2": "BI",
            "A3": "BDI",
            "Number": 108
            },
            {
            "Country": "CAMBODIA",
            "A2": "KH",
            "A3": "KHM",
            "Number": 116
            },
            {
            "Country": "CAMEROON",
            "A2": "CM",
            "A3": "CMR",
            "Number": 120
            },
            {
            "Country": "CANADA",
            "A2": "CA",
            "A3": "CAN",
            "Number": 124
            },
            {
            "Country": "CAPE VERDE",
            "A2": "CV",
            "A3": "CPV",
            "Number": 132
            },
            {
            "Country": "CAYMAN ISLANDS",
            "A2": "KY",
            "A3": "CYM",
            "Number": 136
            },
            {
            "Country": "CENTRAL AFRICAN REPUBLIC",
            "A2": "CF",
            "A3": "CAF",
            "Number": 140
            },
            {
            "Country": "CHAD",
            "A2": "TD",
            "A3": "TCD",
            "Number": 148
            },
            {
            "Country": "CHILE",
            "A2": "CL",
            "A3": "CHL",
            "Number": 152
            },
            {
            "Country": "CHINA",
            "A2": "CN",
            "A3": "CHN",
            "Number": 156
            },
            {
            "Country": "CHRISTMAS ISLAND",
            "A2": "CX",
            "A3": "CXR",
            "Number": 162
            },
            {
            "Country": "COCOS (KEELING) ISLANDS",
            "A2": "CC",
            "A3": "CCK",
            "Number": 166
            },
            {
            "Country": "COLOMBIA",
            "A2": "CO",
            "A3": "COL",
            "Number": 170
            },
            {
            "Country": "COMOROS",
            "A2": "KM",
            "A3": "COM",
            "Number": 174
            },
            {
            "Country": "CONGO, Democratic Republic of (was Zaire)",
            "A2": "CD",
            "A3": "COD",
            "Number": 180
            },
            {
            "Country": "CONGO, Republic of",
            "A2": "CG",
            "A3": "COG",
            "Number": 178
            },
            {
            "Country": "COOK ISLANDS",
            "A2": "CK",
            "A3": "COK",
            "Number": 184
            },
            {
            "Country": "COSTA RICA",
            "A2": "CR",
            "A3": "CRI",
            "Number": 188
            },
            {
            "Country": "COTE DIVOIRE",
            "A2": "CI",
            "A3": "CIV",
            "Number": 384
            },
            {
            "Country": "CROATIA (local name: Hrvatska)",
            "A2": "HR",
            "A3": "HRV",
            "Number": 191
            },
            {
            "Country": "CUBA",
            "A2": "CU",
            "A3": "CUB",
            "Number": 192
            },
            {
            "Country": "CYPRUS",
            "A2": "CY",
            "A3": "CYP",
            "Number": 196
            },
            {
            "Country": "CZECH REPUBLIC",
            "A2": "CZ",
            "A3": "CZE",
            "Number": 203
            },
            {
            "Country": "DENMARK",
            "A2": "DK",
            "A3": "DNK",
            "Number": 208
            },
            {
            "Country": "DJIBOUTI",
            "A2": "DJ",
            "A3": "DJI",
            "Number": 262
            },
            {
            "Country": "DOMINICA",
            "A2": "DM",
            "A3": "DMA",
            "Number": 212
            },
            {
            "Country": "DOMINICAN REPUBLIC",
            "A2": "DO",
            "A3": "DOM",
            "Number": 214
            },
            {
            "Country": "ECUADOR",
            "A2": "EC",
            "A3": "ECU",
            "Number": 218
            },
            {
            "Country": "EGYPT",
            "A2": "EG",
            "A3": "EGY",
            "Number": 818
            },
            {
            "Country": "EL SALVADOR",
            "A2": "SV",
            "A3": "SLV",
            "Number": 222
            },
            {
            "Country": "EQUATORIAL GUINEA",
            "A2": "GQ",
            "A3": "GNQ",
            "Number": 226
            },
            {
            "Country": "ERITREA",
            "A2": "ER",
            "A3": "ERI",
            "Number": 232
            },
            {
            "Country": "ESTONIA",
            "A2": "EE",
            "A3": "EST",
            "Number": 233
            },
            {
            "Country": "ETHIOPIA",
            "A2": "ET",
            "A3": "ETH",
            "Number": 231
            },
            {
            "Country": "FALKLAND ISLANDS (MALVINAS)",
            "A2": "FK",
            "A3": "FLK",
            "Number": 238
            },
            {
            "Country": "FAROE ISLANDS",
            "A2": "FO",
            "A3": "FRO",
            "Number": 234
            },
            {
            "Country": "FIJI",
            "A2": "FJ",
            "A3": "FJI",
            "Number": 242
            },
            {
            "Country": "FINLAND",
            "A2": "FI",
            "A3": "FIN",
            "Number": 246
            },
            {
            "Country": "FRANCE",
            "A2": "FR",
            "A3": "FRA",
            "Number": 250
            },
            {
            "Country": "FRENCH GUIANA",
            "A2": "GF",
            "A3": "GUF",
            "Number": 254
            },
            {
            "Country": "FRENCH POLYNESIA",
            "A2": "PF",
            "A3": "PYF",
            "Number": 258
            },
            {
            "Country": "FRENCH SOUTHERN TERRITORIES",
            "A2": "TF",
            "A3": "ATF",
            "Number": 260
            },
            {
            "Country": "GABON",
            "A2": "GA",
            "A3": "GAB",
            "Number": 266
            },
            {
            "Country": "GAMBIA",
            "A2": "GM",
            "A3": "GMB",
            "Number": 270
            },
            {
            "Country": "GEORGIA",
            "A2": "GE",
            "A3": "GEO",
            "Number": 268
            },
            {
            "Country": "GERMANY",
            "A2": "DE",
            "A3": "DEU",
            "Number": 276
            },
            {
            "Country": "GHANA",
            "A2": "GH",
            "A3": "GHA",
            "Number": 288
            },
            {
            "Country": "GIBRALTAR",
            "A2": "GI",
            "A3": "GIB",
            "Number": 292
            },
            {
            "Country": "GREECE",
            "A2": "GR",
            "A3": "GRC",
            "Number": 300
            },
            {
            "Country": "GREENLAND",
            "A2": "GL",
            "A3": "GRL",
            "Number": 304
            },
            {
            "Country": "GRENADA",
            "A2": "GD",
            "A3": "GRD",
            "Number": 308
            },
            {
            "Country": "GUADELOUPE",
            "A2": "GP",
            "A3": "GLP",
            "Number": 312
            },
            {
            "Country": "GUAM",
            "A2": "GU",
            "A3": "GUM",
            "Number": 316
            },
            {
            "Country": "GUATEMALA",
            "A2": "GT",
            "A3": "GTM",
            "Number": 320
            },
            {
            "Country": "GUINEA",
            "A2": "GN",
            "A3": "GIN",
            "Number": 324
            },
            {
            "Country": "GUINEA-BISSAU",
            "A2": "GW",
            "A3": "GNB",
            "Number": 624
            },
            {
            "Country": "GUYANA",
            "A2": "GY",
            "A3": "GUY",
            "Number": 328
            },
            {
            "Country": "HAITI",
            "A2": "HT",
            "A3": "HTI",
            "Number": 332
            },
            {
            "Country": "HEARD AND MC DONALD ISLANDS",
            "A2": "HM",
            "A3": "HMD",
            "Number": 334
            },
            {
            "Country": "HONDURAS",
            "A2": "HN",
            "A3": "HND",
            "Number": 340
            },
            {
            "Country": "HONG KONG",
            "A2": "HK",
            "A3": "HKG",
            "Number": 344
            },
            {
            "Country": "HUNGARY",
            "A2": "HU",
            "A3": "HUN",
            "Number": 348
            },
            {
            "Country": "ICELAND",
            "A2": "IS",
            "A3": "ISL",
            "Number": 352
            },
            {
            "Country": "INDIA",
            "A2": "IN",
            "A3": "IND",
            "Number": 356
            },
            {
            "Country": "INDONESIA",
            "A2": "ID",
            "A3": "IDN",
            "Number": 360
            },
            {
            "Country": "IRAN (ISLAMIC REPUBLIC OF)",
            "A2": "IR",
            "A3": "IRN",
            "Number": 364
            },
            {
            "Country": "IRAQ",
            "A2": "IQ",
            "A3": "IRQ",
            "Number": 368
            },
            {
            "Country": "IRELAND",
            "A2": "IE",
            "A3": "IRL",
            "Number": 372
            },
            {
            "Country": "ISRAEL",
            "A2": "IL",
            "A3": "ISR",
            "Number": 376
            },
            {
            "Country": "ITALY",
            "A2": "IT",
            "A3": "ITA",
            "Number": 380
            },
            {
            "Country": "JAMAICA",
            "A2": "JM",
            "A3": "JAM",
            "Number": 388
            },
            {
            "Country": "JAPAN",
            "A2": "JP",
            "A3": "JPN",
            "Number": 392
            },
            {
            "Country": "JORDAN",
            "A2": "JO",
            "A3": "JOR",
            "Number": 400
            },
            {
            "Country": "KAZAKHSTAN",
            "A2": "KZ",
            "A3": "KAZ",
            "Number": 398
            },
            {
            "Country": "KENYA",
            "A2": "KE",
            "A3": "KEN",
            "Number": 404
            },
            {
            "Country": "KIRIBATI",
            "A2": "KI",
            "A3": "KIR",
            "Number": 296
            },
            {
            "Country": "KOREA, DEMOCRATIC PEOPLES REPUBLIC OF",
            "A2": "KP",
            "A3": "PRK",
            "Number": 408
            },
            {
            "Country": "KOREA, REPUBLIC OF",
            "A2": "KR",
            "A3": "KOR",
            "Number": 410
            },
            {
            "Country": "KUWAIT",
            "A2": "KW",
            "A3": "KWT",
            "Number": 414
            },
            {
            "Country": "KYRGYZSTAN",
            "A2": "KG",
            "A3": "KGZ",
            "Number": 417
            },
            {
            "Country": "LAO PEOPLES DEMOCRATIC REPUBLIC",
            "A2": "LA",
            "A3": "LAO",
            "Number": 418
            },
            {
            "Country": "LATVIA",
            "A2": "LV",
            "A3": "LVA",
            "Number": 428
            },
            {
            "Country": "LEBANON",
            "A2": "LB",
            "A3": "LBN",
            "Number": 422
            },
            {
            "Country": "LESOTHO",
            "A2": "LS",
            "A3": "LSO",
            "Number": 426
            },
            {
            "Country": "LIBERIA",
            "A2": "LR",
            "A3": "LBR",
            "Number": 430
            },
            {
            "Country": "LIBYAN ARAB JAMAHIRIYA",
            "A2": "LY",
            "A3": "LBY",
            "Number": 434
            },
            {
            "Country": "LIECHTENSTEIN",
            "A2": "LI",
            "A3": "LIE",
            "Number": 438
            },
            {
            "Country": "LITHUANIA",
            "A2": "LT",
            "A3": "LTU",
            "Number": 440
            },
            {
            "Country": "LUXEMBOURG",
            "A2": "LU",
            "A3": "LUX",
            "Number": 442
            },
            {
            "Country": "MACAU",
            "A2": "MO",
            "A3": "MAC",
            "Number": 446
            },
            {
            "Country": "MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF",
            "A2": "MK",
            "A3": "MKD",
            "Number": 807
            },
            {
            "Country": "MADAGASCAR",
            "A2": "MG",
            "A3": "MDG",
            "Number": 450
            },
            {
            "Country": "MALAWI",
            "A2": "MW",
            "A3": "MWI",
            "Number": 454
            },
            {
            "Country": "MALAYSIA",
            "A2": "MY",
            "A3": "MYS",
            "Number": 458
            },
            {
            "Country": "MALDIVES",
            "A2": "MV",
            "A3": "MDV",
            "Number": 462
            },
            {
            "Country": "MALI",
            "A2": "ML",
            "A3": "MLI",
            "Number": 466
            },
            {
            "Country": "MALTA",
            "A2": "MT",
            "A3": "MLT",
            "Number": 470
            },
            {
            "Country": "MARSHALL ISLANDS",
            "A2": "MH",
            "A3": "MHL",
            "Number": 584
            },
            {
            "Country": "MARTINIQUE",
            "A2": "MQ",
            "A3": "MTQ",
            "Number": 474
            },
            {
            "Country": "MAURITANIA",
            "A2": "MR",
            "A3": "MRT",
            "Number": 478
            },
            {
            "Country": "MAURITIUS",
            "A2": "MU",
            "A3": "MUS",
            "Number": 480
            },
            {
            "Country": "MAYOTTE",
            "A2": "YT",
            "A3": "MYT",
            "Number": 175
            },
            {
            "Country": "MEXICO",
            "A2": "MX",
            "A3": "MEX",
            "Number": 484
            },
            {
            "Country": "MICRONESIA, FEDERATED STATES OF",
            "A2": "FM",
            "A3": "FSM",
            "Number": 583
            },
            {
            "Country": "MOLDOVA, REPUBLIC OF",
            "A2": "MD",
            "A3": "MDA",
            "Number": 498
            },
            {
            "Country": "MONACO",
            "A2": "MC",
            "A3": "MCO",
            "Number": 492
            },
            {
            "Country": "MONGOLIA",
            "A2": "MN",
            "A3": "MNG",
            "Number": 496
            },
            {
            "Country": "MONTSERRAT",
            "A2": "MS",
            "A3": "MSR",
            "Number": 500
            },
            {
            "Country": "MOROCCO",
            "A2": "MA",
            "A3": "MAR",
            "Number": 504
            },
            {
            "Country": "MOZAMBIQUE",
            "A2": "MZ",
            "A3": "MOZ",
            "Number": 508
            },
            {
            "Country": "MYANMAR",
            "A2": "MM",
            "A3": "MMR",
            "Number": 104
            },
            {
            "Country": "NAMIBIA",
            "A2": "NA",
            "A3": "NAM",
            "Number": 516
            },
            {
            "Country": "NAURU",
            "A2": "NR",
            "A3": "NRU",
            "Number": 520
            },
            {
            "Country": "NEPAL",
            "A2": "NP",
            "A3": "NPL",
            "Number": 524
            },
            {
            "Country": "NETHERLANDS",
            "A2": "NL",
            "A3": "NLD",
            "Number": 528
            },
            {
            "Country": "NETHERLANDS ANTILLES",
            "A2": "AN",
            "A3": "ANT",
            "Number": 530
            },
            {
            "Country": "NEW CALEDONIA",
            "A2": "NC",
            "A3": "NCL",
            "Number": 540
            },
            {
            "Country": "NEW ZEALAND",
            "A2": "NZ",
            "A3": "NZL",
            "Number": 554
            },
            {
            "Country": "NICARAGUA",
            "A2": "NI",
            "A3": "NIC",
            "Number": 558
            },
            {
            "Country": "NIGER",
            "A2": "NE",
            "A3": "NER",
            "Number": 562
            },
            {
            "Country": "NIGERIA",
            "A2": "NG",
            "A3": "NGA",
            "Number": 566
            },
            {
            "Country": "NIUE",
            "A2": "NU",
            "A3": "NIU",
            "Number": 570
            },
            {
            "Country": "NORFOLK ISLAND",
            "A2": "NF",
            "A3": "NFK",
            "Number": 574
            },
            {
            "Country": "NORTHERN MARIANA ISLANDS",
            "A2": "MP",
            "A3": "MNP",
            "Number": 580
            },
            {
            "Country": "NORWAY",
            "A2": "NO",
            "A3": "NOR",
            "Number": 578
            },
            {
            "Country": "OMAN",
            "A2": "OM",
            "A3": "OMN",
            "Number": 512
            },
            {
            "Country": "PAKISTAN",
            "A2": "PK",
            "A3": "PAK",
            "Number": 586
            },
            {
            "Country": "PALAU",
            "A2": "PW",
            "A3": "PLW",
            "Number": 585
            },
            {
            "Country": "PALESTINIAN TERRITORY, Occupied",
            "A2": "PS",
            "A3": "PSE",
            "Number": 275
            },
            {
            "Country": "PANAMA",
            "A2": "PA",
            "A3": "PAN",
            "Number": 591
            },
            {
            "Country": "PAPUA NEW GUINEA",
            "A2": "PG",
            "A3": "PNG",
            "Number": 598
            },
            {
            "Country": "PARAGUAY",
            "A2": "PY",
            "A3": "PRY",
            "Number": 600
            },
            {
            "Country": "PERU",
            "A2": "PE",
            "A3": "PER",
            "Number": 604
            },
            {
            "Country": "PHILIPPINES",
            "A2": "PH",
            "A3": "PHL",
            "Number": 608
            },
            {
            "Country": "PITCAIRN",
            "A2": "PN",
            "A3": "PCN",
            "Number": 612
            },
            {
            "Country": "POLAND",
            "A2": "PL",
            "A3": "POL",
            "Number": 616
            },
            {
            "Country": "PORTUGAL",
            "A2": "PT",
            "A3": "PRT",
            "Number": 620
            },
            {
            "Country": "PUERTO RICO",
            "A2": "PR",
            "A3": "PRI",
            "Number": 630
            },
            {
            "Country": "QATAR",
            "A2": "QA",
            "A3": "QAT",
            "Number": 634
            },
            {
            "Country": "REUNION",
            "A2": "RE",
            "A3": "REU",
            "Number": 638
            },
            {
            "Country": "ROMANIA",
            "A2": "RO",
            "A3": "ROU",
            "Number": 642
            },
            {
            "Country": "RUSSIAN FEDERATION",
            "A2": "RU",
            "A3": "RUS",
            "Number": 643
            },
            {
            "Country": "RWANDA",
            "A2": "RW",
            "A3": "RWA",
            "Number": 646
            },
            {
            "Country": "SAINT HELENA",
            "A2": "SH",
            "A3": "SHN",
            "Number": 654
            },
            {
            "Country": "SAINT KITTS AND NEVIS",
            "A2": "KN",
            "A3": "KNA",
            "Number": 659
            },
            {
            "Country": "SAINT LUCIA",
            "A2": "LC",
            "A3": "LCA",
            "Number": 662
            },
            {
            "Country": "SAINT PIERRE AND MIQUELON",
            "A2": "PM",
            "A3": "SPM",
            "Number": 666
            },
            {
            "Country": "SAINT VINCENT AND THE GRENADINES",
            "A2": "VC",
            "A3": "VCT",
            "Number": 670
            },
            {
            "Country": "SAMOA",
            "A2": "WS",
            "A3": "WSM",
            "Number": 882
            },
            {
            "Country": "SAN MARINO",
            "A2": "SM",
            "A3": "SMR",
            "Number": 674
            },
            {
            "Country": "SAO TOME AND PRINCIPE",
            "A2": "ST",
            "A3": "STP",
            "Number": 678
            },
            {
            "Country": "SAUDI ARABIA",
            "A2": "SA",
            "A3": "SAU",
            "Number": 682
            },
            {
            "Country": "SENEGAL",
            "A2": "SN",
            "A3": "SEN",
            "Number": 686
            },
            {
            "Country": "SERBIA AND MONTENEGRO",
            "A2": "CS",
            "A3": "SCG",
            "Number": 891
            },
            {
            "Country": "SEYCHELLES",
            "A2": "SC",
            "A3": "SYC",
            "Number": 690
            },
            {
            "Country": "SIERRA LEONE",
            "A2": "SL",
            "A3": "SLE",
            "Number": 694
            },
            {
            "Country": "SINGAPORE",
            "A2": "SG",
            "A3": "SGP",
            "Number": 702
            },
            {
            "Country": "SLOVAKIA",
            "A2": "SK",
            "A3": "SVK",
            "Number": 703
            },
            {
            "Country": "SLOVENIA",
            "A2": "SI",
            "A3": "SVN",
            "Number": 705
            },
            {
            "Country": "SOLOMON ISLANDS",
            "A2": "SB",
            "A3": "SLB",
            "Number": 90
            },
            {
            "Country": "SOMALIA",
            "A2": "SO",
            "A3": "SOM",
            "Number": 706
            },
            {
            "Country": "SOUTH AFRICA",
            "A2": "ZA",
            "A3": "ZAF",
            "Number": 710
            },
            {
            "Country": "SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS",
            "A2": "GS",
            "A3": "SGS",
            "Number": 239
            },
            {
            "Country": "SPAIN",
            "A2": "ES",
            "A3": "ESP",
            "Number": 724
            },
            {
            "Country": "SRI LANKA",
            "A2": "LK",
            "A3": "LKA",
            "Number": 144
            },
            {
            "Country": "SUDAN",
            "A2": "SD",
            "A3": "SDN",
            "Number": 736
            },
            {
            "Country": "SURINAME",
            "A2": "SR",
            "A3": "SUR",
            "Number": 740
            },
            {
            "Country": "SVALBARD AND JAN MAYEN ISLANDS",
            "A2": "SJ",
            "A3": "SJM",
            "Number": 744
            },
            {
            "Country": "SWAZILAND",
            "A2": "SZ",
            "A3": "SWZ",
            "Number": 748
            },
            {
            "Country": "SWEDEN",
            "A2": "SE",
            "A3": "SWE",
            "Number": 752
            },
            {
            "Country": "SWITZERLAND",
            "A2": "CH",
            "A3": "CHE",
            "Number": 756
            },
            {
            "Country": "SYRIAN ARAB REPUBLIC",
            "A2": "SY",
            "A3": "SYR",
            "Number": 760
            },
            {
            "Country": "TAIWAN",
            "A2": "TW",
            "A3": "TWN",
            "Number": 158
            },
            {
            "Country": "TAJIKISTAN",
            "A2": "TJ",
            "A3": "TJK",
            "Number": 762
            },
            {
            "Country": "TANZANIA, UNITED REPUBLIC OF",
            "A2": "TZ",
            "A3": "TZA",
            "Number": 834
            },
            {
            "Country": "THAILAND",
            "A2": "TH",
            "A3": "THA",
            "Number": 764
            },
            {
            "Country": "TIMOR-LESTE",
            "A2": "TL",
            "A3": "TLS",
            "Number": 626
            },
            {
            "Country": "TOGO",
            "A2": "TG",
            "A3": "TGO",
            "Number": 768
            },
            {
            "Country": "TOKELAU",
            "A2": "TK",
            "A3": "TKL",
            "Number": 772
            },
            {
            "Country": "TONGA",
            "A2": "TO",
            "A3": "TON",
            "Number": 776
            },
            {
            "Country": "TRINIDAD AND TOBAGO",
            "A2": "TT",
            "A3": "TTO",
            "Number": 780
            },
            {
            "Country": "TUNISIA",
            "A2": "TN",
            "A3": "TUN",
            "Number": 788
            },
            {
            "Country": "TURKEY",
            "A2": "TR",
            "A3": "TUR",
            "Number": 792
            },
            {
            "Country": "TURKMENISTAN",
            "A2": "TM",
            "A3": "TKM",
            "Number": 795
            },
            {
            "Country": "TURKS AND CAICOS ISLANDS",
            "A2": "TC",
            "A3": "TCA",
            "Number": 796
            },
            {
            "Country": "TUVALU",
            "A2": "TV",
            "A3": "TUV",
            "Number": 798
            },
            {
            "Country": "UGANDA",
            "A2": "UG",
            "A3": "UGA",
            "Number": 800
            },
            {
            "Country": "UKRAINE",
            "A2": "UA",
            "A3": "UKR",
            "Number": 804
            },
            {
            "Country": "UNITED ARAB EMIRATES",
            "A2": "AE",
            "A3": "ARE",
            "Number": 784
            },
            {
            "Country": "UNITED KINGDOM",
            "A2": "GB",
            "A3": "GBR",
            "Number": 826
            },
            {
            "Country": "UNITED STATES",
            "A2": "US",
            "A3": "USA",
            "Number": 840
            },
            {
            "Country": "UNITED STATES MINOR OUTLYING ISLANDS",
            "A2": "UM",
            "A3": "UMI",
            "Number": 581
            },
            {
            "Country": "URUGUAY",
            "A2": "UY",
            "A3": "URY",
            "Number": 858
            },
            {
            "Country": "UZBEKISTAN",
            "A2": "UZ",
            "A3": "UZB",
            "Number": 860
            },
            {
            "Country": "VANUATU",
            "A2": "VU",
            "A3": "VUT",
            "Number": 548
            },
            {
            "Country": "VATICAN CITY STATE (HOLY SEE)",
            "A2": "VA",
            "A3": "VAT",
            "Number": 336
            },
            {
            "Country": "VENEZUELA",
            "A2": "VE",
            "A3": "VEN",
            "Number": 862
            },
            {
            "Country": "VIET NAM",
            "A2": "VN",
            "A3": "VNM",
            "Number": 704
            },
            {
            "Country": "VIRGIN ISLANDS (BRITISH)",
            "A2": "VG",
            "A3": "VGB",
            "Number": 92
            },
            {
            "Country": "VIRGIN ISLANDS (U.S.)",
            "A2": "VI",
            "A3": "VIR",
            "Number": 850
            },
            {
            "Country": "WALLIS AND FUTUNA ISLANDS",
            "A2": "WF",
            "A3": "WLF",
            "Number": 876
            },
            {
            "Country": "WESTERN SAHARA",
            "A2": "EH",
            "A3": "ESH",
            "Number": 732
            },
            {
            "Country": "YEMEN",
            "A2": "YE",
            "A3": "YEM",
            "Number": 887
            },
            {
            "Country": "ZAMBIA",
            "A2": "ZM",
            "A3": "ZMB",
            "Number": 894
            },
            {
            "Country": "ZIMBABWE",
            "A2": "ZW",
            "A3": "ZWE",
            "Number": 716
            }
        ]', true);

        foreach ($countries as $country) {
            Country::create([
                'id' => $country['A2'],
                'description' => $country['Country'],
            ]);
        }
    }
}
