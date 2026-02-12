<?php

namespace app\controller;

use app\database\builder\InsertQuery;
use app\database\builder\SelectQuery;

class Sale extends Base
{
    public function cadastro($request, $response)
    {
        $dadosTemplate = [
            'titulo' => 'Página inicial'
        ];
        return $this->getTwig()
            ->render($response, $this->setView('sale'), $dadosTemplate)
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
    }
    public function lista($request, $response)
    {
        $dadosTemplate = [
            'titulo' => 'Página inicial'
        ];
        return $this->getTwig()
            ->render($response, $this->setView('listsale'), $dadosTemplate)
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
    }
    public function insert($request, $response)
    {
        #captura os dados do formulario
        $form = $request->getParsedBody();
        #captura o id do produto
        $id_produto = $form['pesquisa'];
        #verifica se o id do produto esta vazio
        if (empty($id_produto) or is_null ($id_produto)) {
            return $this->SendJson($response,['status'=>false, 'msg'=>'Restrição: o ID do produto é obrigatório!', 'id' =>0 ], 403);
        }
        $customer = SelectQuery::select('id')
            ->from('customer')
            ->order('id', 'asc')
            ->limit(1)
            ->fetch();
        if (!$customer) {
            return $this->SendJson($response, ['status' => false, 'msg' => 'Restrição: Nenhum cliente encontrado!', 'id' =>0 ])
        }
        $id_customer = $customer['id'];
        $FieldAndValue = [
                'id_cliente' => $id_customer,
                'total_bruto' => 0,
                'total_liquido' => 0,
                'desconto' => 0,
                'acrescimo' => 0,
                'observacao' => ''
        ];
        try {
            $IsInsert = InsertQuery::table('sale')->save($FieldAndValue);
            if (!$IsInsert) {
                return $this->SendJson(
                    $response,
                    [
                        'status' => false,
                        'msg' => 'restrição: falha ao inserir a venda!' ,
                        'id' => 0 
                    ]
                )
            }
        }
    }

    Action.value = 'e';
    Id.value = response.id;
    window.history.pushState({}, '', '/venda/alterar/${response.id}');
}