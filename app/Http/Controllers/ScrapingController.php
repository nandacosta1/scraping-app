<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Models\Produto;
use Illuminate\Http\Request;

class ScrapingController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function scrape(Request $request)
    {
        $url = $request->query('produto');

        // Verifica se a URL foi passada
        if (!$url) {
            return redirect()->route('produtos.index')->with('error', 'URL do produto não encontrada.');
        }

        $client = new Client();

        try {
            
            $rastrear = $client->request('GET', $url);

            $nome = $rastrear->filterXPath('//h1[@class="ui-pdp-title"]')->text();
            $preco = $rastrear->filterXPath('//span[contains(@class, "andes-money-amount__fraction")]')->text();
            $descricao = $rastrear->filterXPath('//div[contains(@class, "ui-pdp-description")]/p')->text();
            $urlImagem = $rastrear->filterXPath('//img[@class="ui-pdp-image ui-pdp-gallery__figure__image"]/@src')->text();
                        
            $produtoExistente = Produto::where('nome', $nome)->get();

            if (count($produtoExistente) == 0) {
                Produto::create([
                    'nome' => $nome,
                    'preco' => str_replace('.', '', $preco),
                    'descricao' => $descricao,
                    'url_imagem' => $urlImagem,
                ]);

                return redirect()->route('produtos.index')->with('success', 'Scraping realizado com sucesso!');
            } else {
                return redirect()->route('produtos.index')->with('info', 'O produto já existe no banco de dados.');
            }
        } catch (\Exception $e) {
            return redirect()->route('produtos.index')->with('error', 'Falha ao realizar o scraping do produto.');
        }
    }
}
