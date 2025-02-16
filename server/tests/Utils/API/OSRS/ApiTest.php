<?php

namespace Tests\Utils\API\OSRS;

use App\Utils\API\OSRS\Api;
use App\Utils\API\OSRS\Endpoints\Accolades;
use App\Utils\API\OSRS\Endpoints\Stats;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    private string $mockSkillData = "107879,1843,67526727\n131761,79,1799002\n122072,79,1898725\n97994,94,7944723\n111115,91,6285311\n110515,88,4601130\n";
    private string $mockAccoladeData = "107880,1843,67526727\n131761,79,1799002\n122072,79,1898725\n97995,94,7944723\n111117,91,6285311\n110517,88,4601130\n108799,72,905616\n101332,89,5181813\n130816,80,2119483\n135621,77,1553564\n132208,74,1127831\n168683,77,1559965\n115136,99,13040695\n93533,86,3600481\n144382,70,792654\n190745,72,943769\n100788,78,1670515\n79620,80,2166354\n169086,72,918334\n97986,86,3714638\n116954,82,2461163\n69275,78,1680779\n173520,70,795670\n124383,70,764512\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n165034,51\n216675,4\n279752,2\n174319,8\n123747,26\n58398,11\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n79194,288\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n98222,78\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n97264,25\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n81187,7\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n-1,-1\n68760,587\n-1,-1\n-1,-1";

    public function testGetStatsForPlayer(): void
    {
        $mock = new MockHandler([
            new Response(200, [], $this->mockSkillData)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $apiMock = $this->getMockBuilder(Api::class)
            ->onlyMethods(['getClient'])
            ->setConstructorArgs([new Stats('Lynx Titan', 1)])
            ->getMock();

        $apiMock->method('getClient')
            ->willReturn($client);

        $result = $apiMock->call();
        $expected = [
            [
                "skill_index" => 0,
                "skill_name" => "Overall",
                "exp" => "67,526,727",
                "level" => null,
                "rank" => "107,879"
            ],
            [
                "skill_index" => 1,
                "skill_name" => "Attack",
                "exp" => "1,799,002",
                "level" => 79,
                "rank" => "131,761"
            ],
            [
                "skill_index" => 2,
                "skill_name" => "Defence",
                "exp" => "1,898,725",
                "level" => 79,
                "rank" => "122,072"
            ],
            [
                "skill_index" => 3,
                "skill_name" => "Strength",
                "exp" => "7,944,723",
                "level" => 94,
                "rank" => "97,994"
            ],
            [
                "skill_index" => 4,
                "skill_name" => "Hitpoints",
                "exp" => "6,285,311",
                "level" => 91,
                "rank" => "111,115"
            ],
            [
                "skill_index" => 5,
                "skill_name" => "Ranged",
                "exp" => "4,601,130",
                "level" => 88,
                "rank" => "110,515"
            ]
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetAccoladesForPlayer(): void
    {
        $mock = new MockHandler([
            new Response(200, [], $this->mockAccoladeData)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $apiMock = $this->getMockBuilder(Api::class)
            ->onlyMethods(['getClient'])
            ->setConstructorArgs([new Accolades('Lynx Titan', 1)])
            ->getMock();

        $apiMock->method('getClient')
            ->willReturn($client);

        $result = $apiMock->call();
        $expected = [
            [
                "accolade_index" => 6,
                "accolade_name" => "Clue Scrolls (all)",
                "score" => "51",
                "rank" => "165,034"
            ],
            [
                "accolade_index" => 7,
                "accolade_name" => "Clue Scrolls (beginner)",
                "score" => "4",
                "rank" => "216,675"
            ],
            [
                "accolade_index" => 8,
                "accolade_name" => "Clue Scrolls (easy)",
                "score" => "2",
                "rank" => "279,752"
            ],
            [
                "accolade_index" => 9,
                "accolade_name" => "Clue Scrolls (medium)",
                "score" => "8",
                "rank" => "174,319"
            ],
            [
                "accolade_index" => 10,
                "accolade_name" => "Clue Scrolls (hard)",
                "score" => "26",
                "rank" => "123,747"
            ],
            [
                "accolade_index" => 11,
                "accolade_name" => "Clue Scrolls (elite)",
                "score" => "11",
                "rank" => "58,398"
            ],
            [
                "accolade_index" => 24,
                "accolade_name" => "Bryophyta",
                "score" => "288",
                "rank" => "79,194"
            ],
            [
                "accolade_index" => 37,
                "accolade_name" => "Dagannoth Supreme",
                "score" => "78",
                "rank" => "98,222"
            ],
            [
                "accolade_index" => 44,
                "accolade_name" => "Kalphite Queen",
                "score" => "25",
                "rank" => "97,264"
            ],
            [
                "accolade_index" => 60,
                "accolade_name" => "Sol Heredit",
                "score" => "7",
                "rank" => "81,187"
            ],
            [
                "accolade_index" => 81,
                "accolade_name" => "Zalcano",
                "score" => "587",
                "rank" => "68,760"
            ]
        ];
        $this->assertEquals($expected, $result);
    }

    public function testGetStatsForPlayerThrowsException(): void
    {
        $mock = new MockHandler([
            new RequestException("Error Communicating with Server", new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $apiMock = $this->getMockBuilder(Api::class)
            ->onlyMethods(['getClient'])
            ->setConstructorArgs([new Stats('Lynx Titan', 1)])
            ->getMock();

        $apiMock->method('getClient')
            ->willReturn($client);

        $result = $apiMock->call();
        $this->assertEquals([], $result);
    }
}
