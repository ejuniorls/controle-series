<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    /** @var Temporada */
    private $temporada;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $temporada = new Temporada();
        $episodio1 = new Episodio();
        $episodio1->assistido = true;

        $episodio2 = new Episodio();
        $episodio2->assistido = false;

        $episodio3 = new Episodio();
        $episodio3->assistido = true;

        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBuscaEpisodiosAssistidos()
    {
        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();
        $this->assertCount(2, $episodiosAssistidos);

        foreach ($episodiosAssistidos as $episodiosAssistido) {
            $this->assertTrue($episodiosAssistido->assistido);
        }
    }

    public function buscaTodosEpisodios()
    {
        $episodios = $this->temporada;
        $this->assertCount(3, $episodios);

    }
}
