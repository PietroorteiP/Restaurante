<?php

require_once("modelos/Pedido.php");
require_once("modelos/Prato.php");

function listarPedidos($pedidos)
{
    echo "---------------------------------------------PEDIDOS--------------------------------------------- \n";
    if (count($pedidos) > 0) {
        foreach ($pedidos as $pe) {
            echo $pe . "\n";
        }
    } else
        echo "Nenhum pedido cadastrado.\n";
}


function retornaPrato($pratos, $numP)
{
    foreach ($pratos as $p) {
        if ($numP == $p->getnum())
            return $p;
    }

    return null;
}

$pratos = array(
    new Prato(1, "Camarão à Milanesa", 110, 00),
    new Prato(2, "Pizza Margherita", 80, 00),
    new Prato(3, "Macarrão à Carbonara", 60, 00),
    new Prato(4, "Bife à Parmegiana", 75, 00),
    new Prato(5, "Risoto ao Funghi", 70, 00)
);

$pedidos = array();
$totalV = 0;

do {
    echo "\n\n------MENU------\n";
    echo "1- Cadastrar pedido\n";
    echo "2- Excluir pedido\n";
    echo "3- Listar pedidos\n";
    echo "4- Total em vendas\n";
    echo "0- Sair\n";
    $opcao = readline("Informe a opção: ");

    echo "\n";

    switch ($opcao) {
        case 1:
            $p = new Pedido;
            $p->setNomeCliente(readline("Me diga o seu nome: \n"))
                ->setNomeGarcom(readline("Qual o nome do garçom que atendeu vossa senhoria? \n"));

            $pratoEscolhido = null;
            foreach ($pratos as $pr) {
                echo $pr;
            }
            $numP = readline("Me diga o número do prato escolhido: \n");
            if ($numP >= 1 && $numP <= 5) {
                $pratoEscolhido = retornaPrato($pratos, $numP);

                $p->setPrato($pratoEscolhido);

                array_push($pedidos, $p);

                $totalV += $pratoEscolhido->getValor();

                echo "Pedido adicionado a lista";
            } else {
                echo "Não temos um prato com esse número";
            }
            break;

        case 2:
            listarPedidos($pedidos);
            if (count($pedidos) > 0) {
                $del = readline("Informe o número do pedido que será excluido: ");
                if ($del > 0 && $del <= count($pedidos)){
                    array_splice($pedidos, $del - 1, 1);
                    echo "Pedido removido com sucesso";
                }else
                    echo "Esse pedido não foi cadastrado!\n";
            }
            break;

        case 3:
            listarPedidos($pedidos);
            break;

        case 4:
            
            if ($totalV > 0) {
                echo"-----TOTAL EM VENDAS----- \n";
                echo "Total das vendas: R$ " . $totalV . "\n";
            } else {
                echo "Não teve nenhuma venda ainda";
            }
            break;

        case 0:
            echo "Programa encerrado!\n";
            break;

        default:
            echo "Opção inválida!\n";
    }
} while ($opcao != 0);
